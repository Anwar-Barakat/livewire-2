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
    public $status = null;
    public $selectedRows = [];
    public $selectPageRows = false;

    protected $queryString = ['status'];

    public function render()
    {
        $appointments = $this->appointments;

        $appointmentsCount          = Appointment::count();
        $scheduledAppointmentCount  = Appointment::where('status', 'SCHEDULED')->count();
        $closedAppointmentsCount    = Appointment::where('status', 'CLOSED')->count();

        return view('livewire.admin.appointment.list-appointment', [
            'appointments'              => $appointments,
            'appointmentsCount'         => $appointmentsCount,
            'scheduledAppointmentCount' => $scheduledAppointmentCount,
            'closedAppointmentsCount'   => $closedAppointmentsCount,
        ]);
    }

    public function filterAppointmentsByStatus($status = null)
    {
        $this->resetPage();
        $this->status = $status;
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

    public function getAppointmentsProperty()
    {
        return Appointment::with('client')
            ->when($this->status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->orderBy('order_position', 'asc')
            ->paginate(10);
    }

    public function updatedSelectPageRows($value)
    {
        if ($value) {
            $this->selectedRows = $this->appointments->pluck('id')->map(function ($id) {
                return (string) $id;
            });
        } else {
            $this->reset(['selectedRows', 'selectPageRows']);
        }
    }
    public function deleteSelectedRows()
    {
        Appointment::whereIn('id', $this->selectedRows)->delete();

        $this->dispatchBrowserEvent('deleted', ['message' => "All Selected Appointment Deleted Successfully"]);

        $this->reset(['selectedRows', 'selectPageRows']);
    }

    public function markAllScheduled()
    {
        Appointment::whereIn('id', $this->selectedRows)->update(['status' => 'SCHEDULED']);

        $this->dispatchBrowserEvent('updated', ['message' => "All Selected Appointment Make Scheduled"]);

        $this->reset(['selectedRows', 'selectPageRows']);
    }

    public function markAllClosed()
    {
        Appointment::whereIn('id', $this->selectedRows)->update(['status' => 'CLOSED']);

        $this->dispatchBrowserEvent('updated', ['message' => "All Selected Appointment Make Closed"]);

        $this->reset(['selectedRows', 'selectPageRows']);
    }

    public function updateAppointmentOrder($items)
    {
        foreach ($items as $item)
            Appointment::find($item['value'])->update(['order_position' => $item['order']]);

        $this->dispatchBrowserEvent('updated', ['message' => "Appointment Ordered Successfully"]);
    }
}