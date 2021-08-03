<?php

namespace App\Http\Livewire\Admin\Appointments;

use App\Models\Appointment;
use App\Models\Client;
use Livewire\Component;

class CreateAppointmentForm extends Component
{
    public $state = [];
    public function render()
    {
        $clients = Client::select('id','name')->get();
        return view('livewire.admin.appointments.create-appointment-form', compact('clients'));
    }
    public function createAppointment() {
        $this->state['time'] = '00:00:00';
        $this->state['status'] = 'Yah';
        Appointment::create($this->state);
        $this->dispatchBrowserEvent('alert',['message'=> 'Appointment created successfully']);
    }
}
