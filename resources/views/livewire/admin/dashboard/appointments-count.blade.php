<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-info">
      <div class="inner">
          <div class="d-flex justify-content-between">
            <div wire:loading.delay.remove>
                <h3>{{$appointmentsCount}}</h3>
            </div>
            <div wire:loading.delay >
                <x-animations.ballpulse /> 
            </div>
            <select wire:change= "getAppointmentsCount($event.target.value)" name="" id="" style="height: 2rem; outline:2px solid transparent;" class="px-1 rounded border-0">
                <option value="">All</option>
                <option value="SCHEDULED">Scheduled</option>
                <option value="CLOSED">Closed</option>
            </select>
          </div>

        <p>Appointments</p>
      </div>
      <div class="icon">
        <i class="ion ion-bag"></i>
      </div>
      <a href="{{route('admin.appointments')}}" class="small-box-footer">View Appointments <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>