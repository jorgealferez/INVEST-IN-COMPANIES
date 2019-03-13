@extends('layouts.app')

@section('content')

<section id="wrapper">

    <div class="login-register">

        <div class="login-box card">

            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="col-xs-12">
                        <a class="nav-link " href="{{ route('home') }}"> <img class="d-block mx-auto img-fluid" src="{{ asset('images/logo.png') }}" alt="{{ __('INVESTin Company') }}" width="547" height="85">
                        </a>
                    </div>
                    <hr class="my-4">
                    <h3 class="box-title m-b-20">{{ __('Acceso') }}</h3>

                    <div class="form-group ">

                        <div class="col-xs-12">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">

                        <div class="col-xs-12">

                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                            @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">

                        <div class="row">

                            <div class="col-sm-5">
                                <input class="checkbox-signup" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Recuérdame') }}
                                </label>
                            </div>

                            <div class="col-sm-7 text-sm-right">
                                @if (Route::has('password.request'))
                                <a class="text-muted" href="{{ route('password.request') }}">
                                    <i class="fa fa-lock m-r-5"></i> {{ __('Olvidé mi contraseña') }}
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-center m-t-20">

                        <div class="col-xs-12">
                            <button type="submit" class="btn btn-verde btn-lg btn-block text-uppercase waves-effect waves-light">
                                {{ __('Acceso') }}
                            </button>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>
</section>


@endsection
