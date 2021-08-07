<div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User Profile</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile text-center">
                            <p> <small class=" text-muted text-sm" >Click to change the Image</small></p>
                           
                            <div class="text-center img-circle" style="width: 150px; height: 150px; margin: auto; overflow:hidden; cursor:pointer;border: 3px solid rgba(22, 113, 233);" 
                            x-data="{ imagePreview: '{{auth()->user()->avatar_url}}' }">
                            <input wire:model="image"  type="file" x-ref="image" hidden 
                                x-on:change="const reader = new FileReader();
                                reader.onload = (event) => {
                                    imagePreview = event.target.result;
                                    document.getElementById('profileImage').src = `${imagePreview}`;
                                };
                                reader.readAsDataURL($refs.image.files[0]);
                                "
                            >
                                <img style=" object-fit: cover;width:100%;height: 100%;" x-on:click="$refs.image.click()" 
                                    alt="User profile picture" x-bind:src="imagePreview ? imagePreview : '{{asset('/backend/dist/img/user4-128x128.jpg')}}'">
                            </div>

                            <h3 class="profile-username text-center">{{ucwords(auth()->user()->name)}}</h3>

                            <p class="text-muted text-center">{{ucwords(auth()->user()->role)}}</p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills" wire:ignore>
                                <li class="nav-item"><a class="nav-link active" href="#settings"
                                        data-toggle="tab">Settings</a></li>
                                <li class="nav-item"><a class="nav-link" href="#changePassword" data-toggle="tab">Change
                                        Password</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="settings" wire:ignore.self>
                                    <form class="form-horizontal" wire:submit.prevent= "updateProfile">
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input  wire:model.defer="state.name" type="text" class="form-control @error('name') is-invalid @enderror" id="inputName"
                                                    placeholder="Name">
                                                    @error('name')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                    @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label ">Email</label>
                                            <div class="col-sm-10">
                                                <input wire:model.defer = "state.email" type="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail"
                                                    placeholder="Email">
                                                    @error('email')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                    @enderror
                                            </div>
                                        </div>
                                      
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">Submit</button>
                                            </div>
                                        </div>
                                       
                                    </form>
                                </div>

                                <div class="tab-pane" id="changePassword" wire:ignore.self>
                                    <form class="form-horizontal" wire:submit.prevent="changePassword">
                                        <div class="form-group row">
                                            <label for="currentPassword" class="col-sm-3 col-form-label">Current
                                                Password</label>
                                            <div class="col-sm-9">
                                                <input wire:model.defer="state.current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" id="currentPassword"
                                                    placeholder="Current Password">
                                                    @error('current_password')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                    @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="newPassword" class="col-sm-3 col-form-label">New
                                                Password</label>
                                            <div class="col-sm-9">
                                                <input wire:model.defer="state.password"  type="password" class="form-control @error('password') is-invalid @enderror" id="newPassword"
                                                    placeholder="New Password">
                                                    @error('password')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                    @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="passwordConfirmation" class="col-sm-3 col-form-label">Confirm
                                                New Password</label>
                                            <div class="col-sm-9">
                                                <input wire:model.defer="state.password_confirmation"  type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="passwordConfirmation"
                                                    placeholder="Confirm New Password">
                                                    @error('password')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                    @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-3 col-sm-9">
                                                <button type="submit" class="btn btn-danger">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->


@push('styles')
    {{-- <style>
        .img-circle:hover {
            border-color:rgb(19, 63, 121) !important;
            background-color:darkcyan;
            cursor: pointer;
        }
    </style> --}}
@endpush

@push('js')
    <script>
        $(document).ready(function () {
            Livewire.on('nameChanged',(changedName) => {
               $('[x-ref="username"]').text(changedName);
            });
        });
    </script>
@endpush
</div>
