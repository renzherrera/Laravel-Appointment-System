<?php

namespace App\Http\Livewire\Admin\Appointments;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\Appointment;

class ListAppointments extends AdminComponent
{
    public $editMode = false;
    public function render()
    {
        $appointments = Appointment::with('client')->latest()->paginate(5);
        return view('livewire.admin.appointments.list-appointments',compact('appointments'));
    }
}
