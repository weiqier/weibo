{{-- @foreach (['danger', 'warning', 'success', 'info'] as $msg)
@if(session()->has($msg))
<div class="flash-message">
    <p class="alert alert-{{ $msg }}">
{{ session($msg) }}
</p>
<script>
    setInterval(function () {
        $('.alert').remove();
    }, 3000);

</script>
</div>
@endif
@endforeach --}}
@foreach (['danger','warning','success','info'] as $msg)
@if(!empty(session($msg))) 　　
<div class="alert alert-{{ $msg }}" role="alert" style="z-index: 999">
    　　　　{{session($msg)}}
</div>
<script>
    setInterval(function () {
        $('.alert').remove();
    }, 3000);

</script>
@endif
@endforeach
