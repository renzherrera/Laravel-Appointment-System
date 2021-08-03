<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

class ListUsers extends Component
{
    public $state = [];

    public $editMode = false , $user , $userIdBeingRemoved;
    use WithPagination;
    
    
    public function render()
    {
        $users = User::paginate(5);
        return view('livewire.admin.users.list-users',compact('users'));
    }

    public function addNew() {
        $this->dispatchBrowserEvent('show-form');
    }

    public function createUser() {
        $this->state = [];

       $validatedData =  Validator::make($this->state,[
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ])->validate();

        $validatedData['password'] = bcrypt($validatedData['password']);

        User::create($validatedData);
        // session()->flash('message','User added successfully');
        $this->dispatchBrowserEvent('hide-form', ['message' => 'User added successfully!']);


    }
    

    public function edit (User $user)
    {
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
   

}
