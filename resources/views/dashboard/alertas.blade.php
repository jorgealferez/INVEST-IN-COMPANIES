@if (session()->has('success'))

<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button> {!! session('mensaje') !!}
</div>
@endif @if (session()->has('error'))

<div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button> {!! session('mensaje') !!}
</div>
@endif
