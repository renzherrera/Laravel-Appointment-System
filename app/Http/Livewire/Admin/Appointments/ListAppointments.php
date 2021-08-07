<?php

namespace App\Http\Livewire\Admin\Appointments;

use App\Exports\AppointmentsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Livewire\Admin\AdminComponent;
use App\Models\Appointment;


class ListAppointments extends AdminComponent
{
    public $appointmentIdBeingRemoved = null;
    public $status = null;
    public $editMode = false;

    public $selectedRows = [];

    public $selectPageRows = false;

    protected $listeners = ['deleteConfirmed' => 'deleteAppointment'];
    protected $queryString = ['status'];

    public function render()
    {
        $appointments = $this->appointments;

        $appointmentsCount = Appointment::count();
        $scheduledAppointmentsCount = Appointment::where('status','SCHEDULED')->count();
        $closedAppointmentsCount = Appointment::where('status','CLOSED')->count();
        return view('livewire.admin.appointments.list-appointments',compact('appointments','appointmentsCount','scheduledAppointmentsCount','closedAppointmentsCount'));
    }

    public function confirmAppointmentRemoval($appointmentId)
    {
        $this->appointmentIdBeingRemoved = $appointmentId;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }
    

    public function deleteAppointment() {
       
        $appointment = Appointment::findOrFail($this->appointmentIdBeingRemoved);
        $appointment->delete();

        $this->dispatchBrowserEvent('deleted',['message' => 'Appointment deleted successfully!']);

    }

    public function filterAppointmentsByStatus($status = null)
    {
        $this->status = $status;
        $this->resetPage();
    }
    
    public function updatedSelectPageRows($value)
    {
           if($value){
                $this->selectedRows =  $this->appointments->pluck('id')->map(function($id){
                    return (string) $id;
                });
           } else {
               $this->reset(['selectedRows','selectPageRows']);
           }

    }

    public function getAppointmentsProperty() 
    {
       return Appointment::with('client')
       ->when($this->status, function($query,$status){
           return $query->where('status',$status);
       })
       ->latest()
       ->paginate(5);
    }

    public function deleteSelectedRows() {

        Appointment::whereIn('id',$this->selectedRows)->delete();
        $this->dispatchBrowserEvent('deleted',['message' => 'Selected Appointment successfully deleted!']);
        $this->reset(['selectPageRows','selectedRows']);

    }

    public function markAllAsScheduled() {
        Appointment::whereIn('id',$this->selectedRows)->update(['status'=> 'SCHEDULED']);
        $this->dispatchBrowserEvent('updated',['message' => 'Selected appointment successfully updated!']);
        $this->reset(['selectPageRows','selectedRows']);
    }
    public function markAllAsClosed() {

        Appointment::whereIn('id', $this->selectedRows)->update(['status' => 'CLOSED']);
		$this->dispatchBrowserEvent('updated', ['message' => 'Selected appointments marked as closed.']);
		$this->reset(['selectPageRows', 'selectedRows']);

    }

    public function export() 
    {
        return (new AppointmentsExport($this->selectedRows))->download('appointments.xls');
    }

}
