<?php

namespace App\Http\Livewire\Admin\Appointment;

use App\Models\Appointment;
use App\Models\Client;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class CreateAppointmentForm extends Component
{
    public $state = [
        'status'    => 'SCHEDULED'
    ];

    public function render()
    {
        $clients = Client::all();
        return view('livewire.admin.appointment.create-appointment-form', [
            'clients'   => $clients
        ]);
    }

    public function createAppointment()
    {
        Validator::make($this->state, [
            'client_id'     => 'required',
            'member'        => 'nullable',
            'date'          => 'required',
            'time'          => 'required',
            'note'          => 'nullable',
            'status'        => 'required|in:SCHEDULED,CLOSED',
        ])->validate();
        Appointment::create($this->state);
        $this->dispatchBrowserEvent('alert', ['message' => 'Appointment Added Successfully']);
        return redirect()->back();
    }
}