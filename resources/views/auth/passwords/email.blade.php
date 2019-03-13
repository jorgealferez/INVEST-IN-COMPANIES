@extends('layouts.app')

@section('content')
<section id="wrapper">

    <div class="login-register">

        <div class="col-xs-12">
            <a class="nav-link " href="{{ route('home') }}"> <img class="d-block mx-auto img-fluid p-3" src="{{ asset('images/logo-white.png') }}" alt="{{ __('INVESTin Company') }}" width="400">
            </a>
        </div>

        <div class="login-box card">


            <div class="card-body">

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <h3 class=" mb-3">{{ __('Reiniciar contraseña') }}</h3>
                    <p>Escribe tu email y te enviaremos un correo para reiniciar tu contraseña.</p>

                    <hr class="my-4">

                    <div class="form-group ">

                        <div class="col-xs-12">

                            <label for="email" class="">{{ __('Dirección de correo electrónico') }}:</label>
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group text-center my-3">

                        <div class="col-xs-12 my-3 text-center">
                            <button type="submit" class="btn btn-verde btn-lg btn-block text-uppercase waves-effect waves-light">
                                {{ __('Enviar enlace a mi correo') }}
                            </button>
                        </div>
                    </div>

                    @if (session('status'))

                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</section>

{{-- <div class="container">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card">

                <div class="card-header">{{ __('Reset Password') }}</div>

<div class="card-body">
    @if (session('status'))

    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            </div>
        </div>

        <div class="form-group row mb-0">

            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Send Password Reset Link') }}
                </button>
            </div>
        </div>
    </form>
</div>
</div>
</div>
</div>
</div> --}}
@endsection
