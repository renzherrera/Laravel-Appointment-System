<div>
    <!-- Loader -->
  <x-page-loading-indicator></x-page-loading-indicator>
    <!-- end of loader -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Appointments</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Appointments</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
   

      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
                <div class="d-flex justify-content-between mb-2">
                  <div>
                      <a href="{{route('admin.appointments.create')}}">
                      <button class="btn btn-primary" ><i class="fa fa-plus-circle mr-1"></i> New Appointment</button>
                      </a>
                      @if ($selectedRows)
                    
                      <div class="btn-group ml-2">
                          <button type="button" class="btn btn-default">
                            Bulk Action
                          <small class="ml-1 badge badge-light ">SELECTED <span class="badge badge-pill badge-primary">{{count($selectedRows)}}</span></small>
                          </button>
                          <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <div class="dropdown-menu" role="menu" style="">
                            <a class="dropdown-item" wire:click.prevent = "deleteSelectedRows" href="#">Delete Selected</a>
                            <a class="dropdown-item" wire:click.prevent = "markAllAsScheduled" href="#">Mark as Scheduled</a>
                            <a class="dropdown-item" wire:click.prevent = "markAllAsClosed" href="#">Mark as Closed</a>
                          </div>
                      </div>
                      @endif

                   </div>

                      <div class="btn-group">
                          <button wire:click="filterAppointmentsByStatus()" type="button" class="btn {{!$status ? 'btn-secondary' : 'btn-default'}}">
                            <span class="mr-1">All</span> 
                            <span class="badge badge-pill badge-info">{{$appointmentsCount}}</span>
                          </button>
                        
                          <button wire:click="filterAppointmentsByStatus('SCHEDULED')" type="button" class="btn {{$status == 'SCHEDULED' ? 'btn-secondary' : 'btn-default'}}">
                            <span class="mr-1">Scheduled</span>
                            <span class="badge badge-pill badge-primary">{{$scheduledAppointmentsCount}}</span>
                          </button>
                        
                          <button wire:click="filterAppointmentsByStatus('CLOSED')" type="button" class="btn {{$status == 'CLOSED' ? 'btn-secondary' : 'btn-default'}}">
                            <span class="mr-1">Closed</span>
                            <span class="badge badge-pill badge-success">{{$closedAppointmentsCount}}</span>
                          </button>
                      </div>

                </div>

                <!-- Bootstrap Alert -->
                {{-- @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong><i class="fa fa-check-circle mr-1"></i>{{session('message')}}</strong> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  @endif --}}


              <div class="card">
                <div class="card-body">
                  <div class="card-header"></div>
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>
                          <div class="icheck-primary d-inline ml-2">
                            <input type="checkbox" value="" name="todo2" id="todoCheck2" wire:model="selectPageRows">
                            <label for="todoCheck2"></label>
                          </div>
                       </th>
                        <th scope="col">#</th>
                        <th scope="col">Client Name</th>
                        <th scope="col">Date</th>
                        <th scope="col">Time</th>
                        <th scope="col">Status</th>
                        <th scope="col">Options</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($appointments as $appointment )
                            
                      <tr>
                        <th scope="row"><div class="icheck-primary d-inline ml-2">
                          <input type="checkbox" wire:model = "selectedRows" value="{{ $appointment->id }}" name="todo2" id="{{$appointment->id}}">
                          <label for="{{$appointment->id}}"></label>
                        </div></th>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$appointment->client->name}}</td>
                        <td>{{$appointment->date}}</td>
                        <td>{{$appointment->time}}</td>
                        <td><span class="badge badge-{{$appointment->status_badge}}">{{$appointment->status}}</span></td>
                        <td>
                            <a href="{{route('admin.appointments.edit', $appointment)}}" ><i class="fa fa-edit mr-2"></i></a>
                            <a href="" wire:click.prevent="confirmAppointmentRemoval({{ $appointment->id }})"><i class="fa fa-trash text-danger"></i></a>
                        </td>
                      </tr>
                      @endforeach

                    </tbody>
                  </table>
                  <div class="mt-2 d-flex justify-content-end">
                    {{$appointments->links()}}
                  </div>
                </div>
              </div>
    
             
              </div>
            </div>
            <!-- /.col-md-6 -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->


        <!--Sweet alert confirm component located at components folder-->
        <x-confirmation-alert> </x-confirmation-alert>
  </div>




 