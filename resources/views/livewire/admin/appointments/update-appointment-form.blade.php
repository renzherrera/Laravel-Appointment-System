<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <!-- <h1 class="m-0 text-dark">Appointments</h1> -->
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="{{route('admin.appointments')}}">Appointments</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form wire:submit.prevent="updateAppointment" autocomplete="off">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Edit Appointment</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="client">Client:</label>
                                            <select class="form-control @error('client_id') is-invalid @enderror" wire:model.defer="state.client_id">
                                                <option value="">Select Client</option>
                                                @foreach ($clients as $client)
                                                <option value="{{$client->id}}">{{$client->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('client_id')
                                                <div class="invalid-feedback">
                                                   {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Appointment Date:</label>
                                                 <div class="input-group mb-3 ">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                                    </div>
                                                    <x-datepicker wire:model.defer="state.date" id="appointmentDate" :error="'date'"> </x-datepicker>
                                                    @error('date')
                                                        <div class="invalid-feedback">
                                                        {{$message}}
                                                        </div>
                                                    @enderror
                                                </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Appointment Time:</label>
                                                 <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                                    </div>
                                                    <x-timepicker wire:model.defer="state.time" id="appointmentTime" :error="'time'"> </x-timepicker>
                                                    @error('time')
                                                    <div class="invalid-feedback">
                                                       {{$message}}
                                                    </div>
                                                    @enderror
                                                </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group" wire:ignore>
                                            <label for="note">Note:</label>
                                            <textarea id="note"  data-note="@this" class="form-control"  data-target="#note" wire:model.defer="state.note">{{ $state['note']}}</textarea>
                                          
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="client">Status:</label>
                                            <select class="form-control @error('note') is-invalid @enderror" wire:model.defer="state.status">
                                                <option value="" disabled>Select Status</option>
                                                <option value="SCHEDULED">Scheduled</option>
                                                <option value="CLOSED">Closed</option>
                                            </select>
                                            @error('status')
                                            <div class="invalid-feedback">
                                               {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer d-flex justify-content-end">
                                <a href="{{route('admin.appointments')}}">
                                <button type="button" class="btn btn-secondary px-5 mr-2">Back</button>
                               </a>
                                <button id="submit" type="submit" class="btn btn-primary px-5"><i class="fa fa-save mr-2"></i> Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('js')
    
    <script src="https://cdn.ckeditor.com/ckeditor5/29.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
                .create( document.querySelector( '#note' ) )
                .then( editor => {
                //     editor.model.document.on('change:data',() =>{
                //         let note = $('#note').data('note');
                //         console.log(note);
                // eval(note).set('state.note',editor.getData());
    
                //     })
                    document.getElementById('submit').addEventListener('click',() => {
                        let note = $('#note').data('note');
                eval(note).set('state.note',editor.getData());
                    })
                } )
                .catch( error => {
                        console.error( error );
                } );
    </script>
    @endpush
</div>