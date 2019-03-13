@if ($notifiacionesAsociaciones->count()>0 && Request::is('dashboard/asociaciones'))

<div class="alert alert-warning">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button> {{ __('Hay asociaciones nuevas') }}
</div>
@endif @if ($notifiacionesOfertas->count()>0 && Request::is('dashboard/ofertas'))

<div class="alert alert-warning">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button> {{ __('Hay ofertas nuevas') }}
</div>
@endif @if ($notifiacionesUsuarios->count()>0 && Request::is('dashboard/usuarios'))

<div class="alert alert-warning">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button> {{ __('Hau nuevos usuarios') }}
</div>
@endif @if (session()->has('success'))

<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button> {!! session('mensaje') !!}
</div>
@endif @if (session()->has('errors') || session()->has('error'))

<div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button> {!! (session()->has('errors'))? 'Hay errores, por favor corrígelos.' : session('mensaje') !!}
</div>
@endif @if (session()->has('errors_reset_email') || session()->has('errors_reset_email'))

<div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button> {!! (session()->has('errors_reset_email'))? session('errors_reset_email')['mensaje'] : session('mensaje')
    !!}
</div>
@endif
