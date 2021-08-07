<?php

namespace App\Http\Livewire\Admin\Appointments;

use App\Models\Appointment;
use App\Models\Client;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class CreateAppointmentForm extends Component
{
    public $state = [
        'status' => 'SCHEDULED'
    ];
    public function render()
    {
        $clients = Client::select('id','name')->get();
        return view('livewire.admin.appointments.create-appointment-form', compact('clients'));
    }
    public function createAppointment() {

        Validator::make($this->state, [
            'client_id' => 'required',
            'date' => 'required',
            'time' => 'required',
            'note' => 'nullable',
            'members' => 'required',
            'status' => 'required|in:CLOSED,SCHEDULED',
        ],
        [
            'client_id.required' => 'The client field is required.',
            ])->validate();
        Appointment::create($this->state);
        $this->dispatchBrowserEvent('alert',['message'=> 'Appointment created successfully']);

        $this->state = [];
    }
}
 