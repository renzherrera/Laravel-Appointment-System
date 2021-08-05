<div wire:loading.delay>
    <div style="display: flex; justify-content:center; align-items:center; background-color: black;
    position: fixed; top:0px; left:0px; z-index:999999; width:100%;height:100%; opacity: 0.5;">
      <div class="la-ball-square-spin la-2x">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
      </div>
    </div>
</div>

@push('styles')
  <link rel="stylesheet" href="{{asset('backend/dist/css/myCss/page-loader.css')}}">
@endpush