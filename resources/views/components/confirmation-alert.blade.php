@push('js')
<!--Sweet Alert-->
<script type="text/javascript" src="{{asset('backend/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<script>
  window.addEventListener('show-delete-confirmation', event=> {
      Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          Livewire.emit('deleteConfirmed')
        }
       else {
        Swal.fire(
          'Cancelled',
          'Your imaginary file is safe :)',
          'error'
        )
      }
      })
  })

  window.addEventListener('change-role-confirmation', event=> {
      Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          Livewire.emit('changeRole')
        }
       else {
        Swal.fire(
          'Cancelled',
          'Your imaginary file is safe :)',
          'error'
        )
      }
      })
  })

  window.addEventListener('show-delete-selected-confirmation', event=> {
      Swal.fire({
      title: 'All selected rows will be deleted. Proceed?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          Livewire.emit('deleteSelectedRows')
        }
       else {
        Swal.fire(
          'Cancelled',
          'Your imaginary file is safe :)',
          'error'
        )
      }
      })
  })
  window.addEventListener('deleted', event => {
            Swal.fire(
              'Deleted!',
              event.detail.message,
              'success'
            )
        })
</script>

@endpush