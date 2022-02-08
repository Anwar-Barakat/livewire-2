<?php

namespace App\Http\Livewire\Admin\Appointment;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\Appointment;
use Livewire\WithPagination;

class ListAppointment extends AdminComponent
{
    use WithPagination;

    public $appointmentId;
    public $listeners = ['deleteConfirmation' => 'DestroyAppointment'];

    public function render()
    {
        $appointments = Appointment::with('client')->orderBy('id', 'desc')->paginate(10);
        return view('livewire.admin.appointment.list-appointment', [
            'appointments'   => $appointments
        ]);
    }

    public function confirmAppointmentDelettion($id)
    {
        $this->appointmentId = $id;

        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function deleteConfirmation($id)
    {
        $this->appointmentId = $id;

        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function DestroyAppointment()
    {
        $appointment = Appointment::where('id', $this->appointmentId)->delete();

        $this->dispatchBrowserEvent('deleted', ['message' => 'Appointment Deleted Successfully']);
    }
}