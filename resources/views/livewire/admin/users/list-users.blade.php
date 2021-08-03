<div>
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Users</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active">Users</li>
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
                    <button class="btn btn-primary" wire:click.prevent="addNew"><i class="fa fa-plus-circle mr-1"></i> Add New User</button>
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
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Options</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user )
                            
                      <tr>
                        <th scope="row">{{$user->id}}</th>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            <a href="" wire:click.prevent="edit({{ $user }})"><i class="fa fa-edit mr-2"></i></a>
                            <a href="" wire:click.prevent="confirmUserRemoval({{ $user->id }})"><i class="fa fa-trash text-danger"></i></a>
                        </td>
                      </tr>
                      @endforeach

                    </tbody>
                  </table>
                  <div class="mt-2 d-flex justify-content-end">
                    {{$users->links()}}
                  </div>
                </div>
              </div>
              
    
             
              </div>
            </div>
            <!-- /.col-md-6 -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->

        <!-- Modal -->

        
<!-- Modal -->
<div class="modal fade" id="form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog">
    <form wire:submit.prevent="{{$editMode ? 'updateUser': 'createUser'}}">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{$editMode ? 'Edit User' : 'New User'}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
                <div class="form-group">
                  <label for="email">Name</label>
                  <input wire:model.defer="state.name" type="text" class="form-control  @error('name')  is-invalid @enderror" id="name" aria-describedby="nameHelp" placeholder="Enter Full Name" >
                  @error('name')
                  <div class="invalid-feedback">
                    {{$message}}
                  </div>
                  @enderror

                  {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                </div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input wire:model.defer="state.email" placeholder="Enter a valid Email Address"  type="email" class="form-control @error('email')  is-invalid @enderror" id="email" aria-describedby="emailHelp" >
                    @error('name')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                    @enderror
                    {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                  </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input wire:model.defer="state.password"  type="password" class="form-control @error('password')  is-invalid @enderror" id="password" placeholder="Password" >
                  @error('password')
                  <div class="invalid-feedback">
                    {{$message}}
                  </div>
                  @enderror
                </div>

                <div class="form-group">
                    <label for="passwordConfirmation">Confirm Password</label>
                    <input wire:model.defer="state.password_confirmation"  type="password" class="form-control @error('passwordConfirmation')  is-invalid @enderror" id="passwordConfirmation" placeholder="Confirm Password" >
                </div>
             
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-2"></i> Cancel</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-2"></i>{{$editMode ? 'Save changes' : 'Save'}}</button>
        </div>
      </div>
    </form>

    </div>
  </div>




  <!-- Modal -->
 
  <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"> <h5>Delete User</h5></div>
            <div class="modal-body">
                <h4>Are you sure you want to delete this user?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-2"></i> Cancel</button>
                <button type="button" wire:click.prevent="deleteUser" class="btn btn-danger"><i class="fa fa-trash mr-2"></i>Delete User</button>
              </div>
        </div>
    </div>
    </div>
</div>
