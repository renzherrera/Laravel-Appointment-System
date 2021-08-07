<?php

namespace App\Http\Livewire\Admin\Users;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;
class ListUsers extends AdminComponent
{
    public $state = [];
    public $editMode = false , $user , $userIdBeingRemoved, $searchTerm = null,$photo;
    use WithFileUploads;
    public function render()
    {
        $users = User::query()
        ->where('name','like','%'.$this->searchTerm.'%')
        ->orWhere('email','like','%'.$this->searchTerm.'%')
        ->orWhere('id', $this->searchTerm)
        ->latest()->paginate(5);
        return view('livewire.admin.users.list-users',compact('users'));
    }

    public function addNew() {
        $this->reset();
        $this->dispatchBrowserEvent('show-form');
    }

    public function createUser() {
       $validatedData =  Validator::make($this->state,[
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ])->validate();
        $validatedData['password'] = bcrypt($validatedData['password']);
        if($this->photo) {
             $validatedData['avatar'] = $this->photo->store('/','avatars');
        }
        User::create($validatedData);
        // session()->flash('message','User added successfully');
        $this->dispatchBrowserEvent('hide-form', ['message' => 'User added successfully!']);
    }

    public function edit (User $user)
    {
        $this->reset();

        $this->editMode = true;
        // $this->state['name'] = $user->name;
        // $this->state['email'] = $user->email;
        $this->user = $user;
        $this->state = $user->toArray();
        $this->dispatchBrowserEvent('show-form');
    }

    public function updateUser(){
        $validatedData =  Validator::make($this->state,[
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$this->user->id,
            'password' => 'sometimes|confirmed',
        ])->validate();

        if(!empty($validatedData['password'])){
        $validatedData['password'] = bcrypt($validatedData['password']);
        }
        if($this->photo) {
            $validatedData['avatar'] = $this->photo->store('/','avatars');
            if (Storage::disk('avatars')->exists($this->state['avatar'])) {
                 // unlink("storage/avatars/".$this->state['avatar']);
                 Storage::disk('avatars')->delete($this->state['avatar']);
            }
        }
        
        $this->user->update($validatedData);
        // session()->flash('message','User added successfully');
        $this->dispatchBrowserEvent('hide-form', ['message' => 'User updated successfully!']);
        $this->state = [];

    }
    public function confirmUserRemoval($userId)
    {
        $this->userIdBeingRemoved = $userId;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function deleteUser() 
    {
        $user =  User::findOrFail($this->userIdBeingRemoved);
        $user->delete();
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'User deleted successfully!']);

    }

    public function changeRole(User $user, $role) {
        Validator::make(['role' => $role], [
            'role' => 'required',
            Rule::in(User::ROLE_ADMIN, User::ROLE_USER),
        ])->validate();
        $user->update(['role' => $role]);
        $capsRole = ucwords($role);
        $this->dispatchBrowserEvent('updated', ['message' => "Role successfully updated to {$capsRole}!"]);

    }
   

}
