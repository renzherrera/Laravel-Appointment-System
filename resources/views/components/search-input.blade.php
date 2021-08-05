<div class="d-flex justify-content-center align-items-center border bg-white">
    <input {{$attributes}} type="text" class="form-control border-0 " placeholder="Search">
      <div class="" wire:loading.delay wire:target="searchTerm">
        <div style="color: #9b7fe6" class="la-ball-clip-rotate la-sm pr-4" >
          <div></div>
        </div>
      </div>
</div>
@push('styles')
  <link rel="stylesheet" href="{{asset('backend/dist/css/myCss/search-loading.css')}}">
@endpush