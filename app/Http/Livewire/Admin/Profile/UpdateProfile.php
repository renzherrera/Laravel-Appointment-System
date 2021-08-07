<?php

namespace App\Http\Livewire\Admin\Profile;

use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateProfile extends Component
{
    use WithFileUploads;
    public $image;
    public $state = [];
    public function mount()
    {
        $user = auth()->user()->only(['name','email']);
        $this->state =  $user;
    
    }
    public function render()
    {
        return view('livewire.admin.profile.update-profile');
    }
    
   
    public function updatedImage() {

        $previousPath = auth()->user()->avatar;

        $path = $this->image->store('/', 'avatars');

        auth()->user()->update(['avatar' => $path]);

        Storage::disk('avatars')->delete($previousPath);

        $this->dispatchBrowserEvent('updated', ['message' => 'Profile changed successfully!']);
    }
    public function updateProfile(UpdateUserProfileInformation $updater) {

        $updater->update(auth()->user(),
        [
             'name' => $this->state['name'],
             'email' => $this->state['email'],
        ]);
        $this->emit('nameChanged',auth()->user()->name);
 
        $this->dispatchBrowserEvent('updated',['message' => 'Profile updated Successfully']);
     }
 
    public function changePassword(UpdatesUserPasswords $updater) 
    {
        

        $updater->update(auth()->user(),
        $attributes = Arr::only($this->state,[
            'current_password',
            'password',
            'password_confirmation'
        ]));

        collect($attributes)->map(fn ($value, $key) => $this->state[$key] = '' );


        $this->dispatchBrowserEvent('updated',['message' => 'Password successfully changed!']);

    }
}
