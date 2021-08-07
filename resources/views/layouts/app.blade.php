<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{setting('site_name')}}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('backend/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('backend/dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{asset('backend/plugins/toastr/toastr.min.css')}}">
  <link rel="stylesheet" href="{{asset('backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- Sweet Alert -->
  <link rel="stylesheet" href="{{asset('backend/plugins/sweetalert2/sweetalert2.min.css')}}">
  <!-- Checkboxes Styles -->
  <link rel="stylesheet" href="{{asset('backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
<!-- Error validation -->
  <style>
    .custom-error .select2-selecton{
        border:none;
    }
  </style>
@livewireStyles
@stack('styles')
</head>
<body class="hold-transition sidebar-mini {{setting('sidebar_collapse') ? 'sidebar-collapse' : ''}}">
<div class="wrapper">

  <!-- Navbar -->
  @include('layouts.partials.navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('layouts.partials.sidebar')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
   {{-- @yield('content') --}}
   {{$slot}}
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  @include('layouts.partials.footer')
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{asset('backend/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('backend/dist/js/adminlte.min.js')}}"></script>
<!--Moment JS-->
<script type="text/javascript" src="{{asset('backend/plugins/moment/moment.min.js')}}"></script>

<!--Date picker tempus -->
<script type="text/javascript" src="{{asset('backend/plugins/toastr/toastr.min.js')}}"></script>
<!--TOASTR-->
<script type="text/javascript" src="{{asset('backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>

<!-- Alpine JS -->
<script src="//unpkg.com/alpinejs" defer></script>




<script>
  const SwalModal = (icon, title, html) => {
      Swal.fire({
          icon,
          title,
          html
      })
  }
  const SwalConfirm = (icon, title, html, confirmButtonText, method, params, callback) => {
      Swal.fire({
          icon,
          title,
          html,
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText,
          reverseButtons: true,
      }).then(result => {
          if (result.value) {
              return livewire.emit(method, params)
          }
          if (callback) {
              return livewire.emit(callback)
          }
      })
  }
  const SwalAlert = (icon, title, timeout = 7000) => {
      const Toast = Swal.mixin({
          icon,
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: timeout,
          onOpen: toast => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
          }
      })
      Toast.fire({
          icon,
          title
      })
  }
  document.addEventListener('DOMContentLoaded', () => { 
      this.livewire.on('swal:modal', data => {
          SwalModal(data.icon, data.title, data.text)
      })
      this.livewire.on('swal:confirm', data => {
          SwalConfirm(data.icon, data.title, data.text, data.confirmText, data.method, data.params, data.callback)
      })
      this.livewire.on('swal:alert', data => {
          SwalAlert(data.icon, data.title, data.timeout)
      }) 
  })
</script>
<script>
    $(document).ready(function(){
        toastr.options = {
            "positionClass" : "toast-bottom-right",
            "progressBar" : true,
        }
        window.addEventListener('hide-form', event => {
        $('#form').modal('hide');
        toastr.success(event.detail.message, 'Success!');
        })
    });
</script>
<script>
    window.addEventListener('show-form', event => {
        $('#form').modal('show');
    })

    window.addEventListener('show-delete-modal', event => {
        $('#confirmationModal').modal('show');
    })

    window.addEventListener('hide-delete-modal', event => {
        $('#confirmationModal').modal('hide');
        toastr.success(event.detail.message, 'Success!');
    })

    window.addEventListener('alert', event => {
        toastr.success(event.detail.message, 'Success!');
    })

    window.addEventListener('updated', event => {
        toastr.success(event.detail.message, 'Success!');
    })

        
</script>
@stack('js')

@livewireScripts
</body>
</html>
