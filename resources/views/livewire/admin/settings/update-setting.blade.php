<div>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Settings</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item "><a href="{{route('admin.settings')}}">Settings</a></li>
                    <li class="breadcrumb-item active">Update Settings</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                    <div class="card card-primary ">
                        <div class="card-header">
                        <h3 class="card-title">Settings</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form wire:submit.prevent="updateSetting">
                        <div class="card-body">
                                <div class="form-group">
                                    <label for="siteName">Site Name</label>
                                    <input wire:model.defer="state.site_name" type="text" class="form-control" id="siteName" placeholder="Enter Site Name">
                                </div>
                                <div class="form-group">
                                    <label for="siteEmail">Site Email</label>
                                    <input wire:model.defer="state.site_email" type="email" class="form-control" id="siteEmail" placeholder="Enter Site Email address">
                                </div>
                                <div class="form-group">
                                    <label for="siteTitle">Site Title</label>
                                    <input wire:model.defer="state.site_title" type="text" class="form-control" id="siteTitle" placeholder="Enter Site Title">
                                </div>
                                <div class="form-group">
                                    <label for="footerText">Footer Text</label>
                                    <input wire:model.defer="state.footer_text" type="text" class="form-control" id="footerText" placeholder="Enter footer text">
                                </div>
                                {{-- <div class="form-group">
                                    <label for="siteTitle">Site Logo</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="siteLogo" >
                                            <label class="custom-file-label" for="siteLogo">Choose an Image</label>
                                        </div>
                                    
                                    </div>
                                </div> --}}
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                      <input wire:model.defer="state.sidebar_collapse" type="checkbox" class="custom-control-input" id="sidebar_collapse">
                                      <label class="custom-control-label" for="sidebar_collapse">Sidebar Collapse</label>
                                    </div>
                                  </div>
                                {{-- <div class="form-group">
                                    <label for="sidebar_collapse">Sidebar Collapse</label>
                                    <div class="form-check">
                                        <input wire:model.defer="state.sidebar_collapse"  type="checkbox" class="form-check-input" id="sidebar_collapse">
                                        <label class="form-check-label" for="sidebar_collapse">Sidebar Collapse</label>
                                    </div>
                                </div> --}}
                            
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                        </form>
                    </div>
                </div>
        </div>
    </div>
</section>
@push('js')
    <script>
        $('#sidebar_collapse').on('change', function(){
           $('body').toggleClass('sidebar-collapse');
        });
    </script>
@endpush
</div>