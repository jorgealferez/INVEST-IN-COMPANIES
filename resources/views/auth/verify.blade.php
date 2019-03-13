@extends('layouts.app')

@section('content')

<section id="wrapper">

    <div class="login-register">

        <div class="login-box card">

            <div class="card-body">


                <h3 class="box-title m-b-20">{{ __('Verificación de email') }}</h3>
                @if (session('resent'))

                <div class="alert alert-success" role="alert">
                    {{ __('Un nuevo enlace se ha enviado a tu correo electrónico.') }}
                </div>
                @endif

                <p>{{ __('Antes de continuar, por favor verifica tu correo electrónico, puede que haya llegado a tu carpeta de Spam o Correo No deseado.') }}</p>
                <p> {{ __('Si no has recibido ningún email') }}:
                    <a href="{{ route('verification.resend') }}" class="btn btn-verde btn-lg btn-block text-uppercase waves-effect waves-light">{{ __('Envíame otra confirmación') }}</a></p>

            </div>
        </div>
    </div>
</section>


@endsection


{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

<div class="card-body">
    @if (session('resent'))

    <div class="alert alert-success" role="alert">
        {{ __('A fresh verification link has been sent to your email address.') }}
    </div>
    @endif

    {{ __('Before proceeding, please check your email for a verification link.') }}
    {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
</div>
</div>
</div>
</div>
</div>
@endsection --}}