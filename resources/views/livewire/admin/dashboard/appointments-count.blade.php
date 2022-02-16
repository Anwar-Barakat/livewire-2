<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-info">
        <div class="inner">
            <div class="d-flex justify-content-between align-items-center">
                <h3 wire:loading.delay.remove class="flex-1">{{ $appointmentCount }}</h3>
                <div wire:loading.delay>
                    <x-animations.ballbeat />
                </div>
                <div>
                    <select wire:change="getAppointmentCount($event.target.value)" class="form-control">
                        <option value="">All</option>
                        <option value="SCHEDULED">Scheduled</option>
                        <option value="CLOSED">Closed</option>
                    </select>
                </div>
            </div>

            <p>Appointments</p>
        </div>
        <div class="icon">
            <i class="ion ion-bag"></i>
        </div>
        <a href="{{ route('admin.appointments') }}" class="small-box-footer">View Appointments <i
                class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
