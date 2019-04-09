@extends('layouts.dashboard')
@section('content')

<form class="" action="{{ action('Dashboard\AsociacionesController@store')}}">

    <div class="container-fluid">

        <div class="row">
            @csrf @method('PUT')

            <div class="col-lg-8 col-xlg-9 col-md-7">

                <div class="card">

                    <div class="card-body">
                        <h4 class="card-title mb-0 title-section">
                            <span class="lstick"></span> <i class="mdi mdi-security-home"></i> {{ __('Nueva entidad')}}

                        </h4>
                    </div>
                    <hr class="mt-0">

                    <div class="card-body">


                        <div class="form-group {{ $errors->has('name') ? ' has-danger' : '' }}">
                            <label class="col-md-12 form-control-label" for="error">{{ __('Nombre') }}(*)</label>

                            <div class="col-md-12">
                                <input type="text" value="{{ old('name') }}" class="form-control form-control-line {{ $errors->has('name') ? ' form-control-danger' : '' }}" id="name" name="name" required>
                            </div>
                            @if ($errors->has('name'))

                            <div class="col-md-12 form-control-feedback">{{ $errors->first('name') }}</div>
                            @endif

                        </div>

                        <div class="form-group {{ $errors->has('address') ? ' has-danger' : '' }}">
                            <label class="col-md-12 form-control-label" for="error">{{ __('Dirección') }}(*)</label>

                            <div class="col-md-12">
                                <input type="text" value="{{ old('address') }}" class="form-control form-control-line {{ $errors->has('address') ? ' form-control-danger' : '' }}" id="address" name="address">
                            </div>
                            @if ($errors->has('address'))

                            <div class="col-md-12 form-control-feedback">{{ $errors->first('address') }}</div>
                            @endif

                        </div>


                        <div class="form-group {{ $errors->has('email') ? ' has-danger' : '' }}">
                            <label class="col-md-12 form-control-label" for="error">{{ __('Email') }}(*)</label>

                            <div class="col-md-12">
                                <input type="text" value="{{ old('email') }}" class="form-control form-control-line {{ $errors->has('email') ? ' form-control-danger' : '' }}" id="email" name="email">
                            </div>
                            @if ($errors->has('email'))

                            <div class="col-md-12 form-control-feedback">{{ $errors->first('email') }}</div>
                            @endif

                        </div>

                        <div class="form-group {{ $errors->has('phone') ? ' has-danger' : '' }}">
                            <label class="col-md-12 form-control-label" for="error">{{ __('Teléfono') }}(*)</label>

                            <div class="col-md-12">
                                <input type="text" value="{{ old('phone') }}" class="form-control form-control-line {{ $errors->has('phone') ? ' form-control-danger' : '' }}" id="phone" name="phone">
                            </div>
                            @if ($errors->has('phone'))

                            <div class="col-md-12 form-control-feedback">{{ $errors->first('phone') }}</div>
                            @endif

                        </div>


                        <div class="form-group">

                            <div class="col-sm-12">
                                <button class="btn btn-verde  waves-effect waves-light">{{ __('Crear Entidad') }}</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-xlg-3 col-md-5">


                <div class="card">

                    <div class="card-body bg-verde">
                        <h4 class="text-white card-title">{{ __('Información de contacto') }}</h4>
                        <h6 class="card-subtitle text-white m-b-0 op-5">Información de contacto de la entidad</h6>
                    </div>

                    <div class="card-body">

                        @include ('dashboard.asociaciones.formulario.contacto')
                    </div>
                </div>
            </div>
        </div>

    </div>
</form>
@endsection

@section('scripts')
@endsection
