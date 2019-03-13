@extends('layouts.public')
@section('contenido')

<div class="container my-5">

    <div class="row">

        <div class="col-md-12  text-center p-5">
            <h2 class="text-uppercase">{{ __('Compra una empresa') }}</h2>
        </div>
    </div>

    <div class="row mt-5">

        <div class="col-md-12">
            <p>Puede que alguna o varias de estas razones sean la causa de la venta. En cualquier caso, una vez tomada la decisión,
                lo importante es hacerlo de la forma adecuada, entendiendo y aplicando la normativa vigente en esta materia,<br>
                <strong>¿y qué mejor manera que hacerlo de la mano de CEPYME y >PGS?</strong>.</p>

        </div>
    </div>

    <div class="row">

        <div class="col-md-12  text-center p-5">
            <h3 class="text-uppercase">{{ __('Servicios') }}</h3>
        </div>
    </div>

    <div class="row   text-justify">

        <div class="col-md-6 ">

            <div class="servicio">
                <h4 class="text-center">
                    <i class="icon-cloud-download"></i>Servicio</h4>

                <div class="row">

                    <div class="col-md-12">
                        Integer mollis elit sed tortor scelerisque, at convallis purus pharetra. Vivamus venenatis eget urna in varius. Duis augue
                        turpis, iaculis eu tempor eleifend, vulputate at diam. Vivamus nec interdum purus. Class aptent taciti
                        sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec accumsan tortor sapien,
                        eu luctus diam dapibus non. Quisque et neque ex. Vivamus a purus
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-6 ">

            <div class="servicio">
                <h4 class="text-center">
                    <i class="icon-cloud-download"></i>Servicio</h4>

                <div class="row">

                    <div class="col-md-12">
                        Integer mollis elit sed tortor scelerisque, at convallis purus pharetra. Vivamus venenatis eget urna in varius. Duis augue
                        turpis, iaculis eu tempor eleifend, vulputate at diam. Vivamus nec interdum purus. Class aptent taciti
                        sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec accumsan tortor sapien,
                        eu luctus diam dapibus non. Quisque et neque ex. Vivamus a purus
                    </div>

                </div>
            </div>

        </div>

    </div>
    <a name="formulario"></a>

    <div class="row">

        <div class="col-md-12  text-center p-5">
            <h2 class="text-uppercase">{{ __('Compra una empresa') }}</h2>
        </div>

        <div class="col-md-12 text-white p-5" style="background-color: #495c5d;">
            @if (session()->has('enviado'))

            <div class="row">

                <div class="col-md-12">
                    {{ __('Gracias por ponerte en contacto con nosotros, en breve nos pondremos en contacto contigo.') }}
                </div>
            </div>
            @else

            <div class="row">

                <div class="col-md-12">

                    <div class="card" style="
                    background-color: #495c5d;">

                        <div class="card-header">{{ __('Register') }}</div>

                        <div class="card-body">
                            <form method="POST" action="{{ action('PublicController@registro') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                        @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Apellidos') }}</label>

                                    <div class="col-md-6">
                                        <input id="surname" type="text" class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" name="surname" value="{{ old('surname') }}" required autofocus>

                                        @if ($errors->has('surname'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('surname') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                        @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Teléfono') }}</label>

                                    <div class="col-md-6">
                                        <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required>

                                        @if ($errors->has('phone'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                        @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirma Contraseña') }}</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">

                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-success">
                                            {{ __('Registrarme') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>

    </div>

</div>

<div class="container-fluid">

</div>
@endsection

@section('scripts')
@endsection
