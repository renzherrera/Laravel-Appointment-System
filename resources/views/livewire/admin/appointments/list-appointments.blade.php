<div>
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
                <div class="d-flex justify-content-end mb-2">
                    <a href="{{route('admin.appointments.create')}}">
                    <button class="btn btn-primary" ><i class="fa fa-plus-circle mr-1"></i> New Appointment</button>
                    </a>
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
                  <h5 class="card-title">Card title</h5>
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Client Name</th>
                        <th scope="col">Date</th>
                        <th scope="col">Time</th>
                        <th scope="col">Status</th>
                        <th scope="col">Options</th>
                      </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($users as $user )
                            
                      <tr>
                        <th scope="row">{{$user->id}}</th>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            <a href="" wire:click.prevent="edit({{ $user }})"><i class="fa fa-edit mr-2"></i></a>
                            <a href="" wire:click.prevent="confirmUserRemoval({{ $user->id }})"><i class="fa fa-trash text-danger"></i></a>
                        </td>
                      </tr>
                      @endforeach --}}

                    </tbody>
                  </table>
                  <div class="mt-2 d-flex justify-content-end">
                    {{-- {{$users->links()}} --}}
                  </div>
                </div>
              </div>
              
    
             
              </div>
            </div>
            <!-- /.col-md-6 -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->

  </div>




 