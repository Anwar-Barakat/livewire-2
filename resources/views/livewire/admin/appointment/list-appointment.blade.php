<div>
    {{-- <x-loading /> --}}
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{ __('Appointment') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a
                                href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ __('Appointments') }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex justify-content-between">
                            <div class="form-group">
                                <button wire:click="filterAppointmentsByStatus"
                                    class="btn {{ is_null($status) ? 'btn-info' : 'btn-default' }}" type="button">
                                    <span class="mr-1 pr-2">All</span>
                                    <span class="badge {{ is_null($status) ? 'badge-light' : 'badge-info' }}">
                                        {{ $appointmentsCount }}
                                    </span>
                                </button>
                                <button wire:click.prevent="filterAppointmentsByStatus('scheduled')"
                                    class="btn {{ $status == 'scheduled' ? 'btn-info' : 'btn-default' }}"
                                    type="button">
                                    <span class="mr-1 pr-2">Scheduled</span>
                                    <span class="badge {{ $status == 'scheduled' ? 'badge-light' : 'badge-info' }}">
                                        {{ $scheduledAppointmentCount }}
                                    </span>
                                </button>
                                <button wire:click.prevent="filterAppointmentsByStatus('closed')"
                                    class="btn {{ $status == 'closed' ? 'btn-info' : 'btn-default' }}" type="button">
                                    <span class="mr-1 pr-2">Closed</span>
                                    <span class="badge {{ $status == 'closed' ? 'badge-light' : 'badge-info' }}">
                                        {{ $closedAppointmentsCount }}
                                    </span>
                                </button>
                                @if ($selectedRows)
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default">Bulk Actions</button>
                                        <button type="button" class="btn btn-default dropdown-toggle dropdown-icon"
                                            data-toggle="dropdown" aria-expanded="false">
                                            <span class="sr-only">Toggle Dropdown</span>
                                            <div class="dropdown-menu" role="menu" style="">
                                                <a wire:click.prevent="deleteSelectedRows" class="dropdown-item"
                                                    href="#">Delete Selected</a>
                                                <div class="dropdown-divider"></div>
                                                <a wire:click.prevent="markAllScheduled" class="dropdown-item" href="#">Mark as Scheduled</a>
                                                <a wire:click.prevent="markAllClosed" class="dropdown-item" href="#">Mark as Closed</a>
                                            </div>
                                        </button>
                                    </div>
                                    <span class="ml-2">selected {{ count($selectedRows) }}
                                        {{ Str::plural('appointment', count($selectedRows)) }}</span>
                                @endif

                            </div>

                            <a href="{{ route('admin.appointments.create') }}">
                                <button class="btn btn-info mb-2">
                                    <i class="fas fa-plus"></i> Create New Appointment
                                </button>
                            </a>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="icheck-primary d-inline ml-2">
                                                    <input wire:model="selectPageRows" type="checkbox" value=""
                                                        name="todo2" id="todoCheck2">
                                                    <label for="todoCheck2"></label>
                                                </div>
                                            </th>
                                            <th scope="col">#</th>
                                            <th scope="col">Client Name</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Time</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($appointments as $appointment)
                                            <tr>
                                                <td>
                                                    <div class="icheck-primary d-inline ml-2">
                                                        <input wire:model="selectedRows" type="checkbox"
                                                            value="{{ $appointment->id }}" name="todo2"
                                                            id="{{ $appointment->id }}">
                                                        <label for="{{ $appointment->id }}"></label>
                                                    </div>
                                                </td>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $appointment->client->name }}</td>
                                                <td>{{ $appointment->date }}</td>
                                                <td>{{ $appointment->time }}</td>
                                                <td>
                                                    <span class="badge badge-{{ $appointment->status_badge }}">
                                                        {{ $appointment->status }}
                                                    </span>
                                                </td>
                                                <td class="">
                                                    <div class="w-50 d-flex justify-content-around">
                                                        <a href="{{ route('admin.appointments.edit', $appointment) }}"
                                                            class="text-info">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a wire:click.prevent="confirmAppointmentDelettion({{ $appointment->id }})"
                                                            href="" class="text-danger">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr class="text-center">
                                                <td colspan="6">
                                                    <img src="{{ asset('AdminLTE/dist/img/search.png') }}"
                                                        width="300" alt="">
                                                    <p class="mt-3">No Appointments Found !!</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="mt-3 d-flex justify-content-end">
                                    {{ $appointments->links() }}
                                </div>
                            </div>
                        </div>
                        @dump($selectedRows)
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-header -->


    <x-confirmation-alert />
</div>
