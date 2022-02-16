<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-info">
        <div class="inner">
            <div class="d-flex justify-content-between align-items-center">
                <h3 wire:loading.delay.remove class="flex-1">{{ $usersCount }}</h3>
                <div wire:loading.delay>
                    <x-animations.ballbeat />
                </div>
                <div>
                    <select wire:change="getUsersCount($event.target.value)" class="form-control">
                        <option value="TODAY">today</option>
                        <option value="30">30 days</option>
                        <option value="60">60 days</option>
                        <option value="360">360 days</option>
                        <option value="MTD">Month to Date</option>
                        <option value="YTD">Year to Date</option>
                    </select>
                </div>
            </div>

            <p>Users</p>
        </div>
        <div class="icon">
            <i class="ion ion-bag"></i>
        </div>
        <a href="{{ route('admin.users') }}" class="small-box-footer">View Users <i
                class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
