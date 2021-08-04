@props(['id','error'])

<input {{$attributes}} onchange="this.dispatchEvent(new InputEvent('input'))" type="text" class="form-control datetimepicker-input @error($error) is-invalid @enderror" id="{{$id}}" data-toggle="datetimepicker" data-target="#{{$id}}"/>
@push('js')
<script type="text/javascript">
    $(function () {
        $('#{{$id}}').datetimepicker({
            format: 'LT'
        });
    });
</script>
@endpush
