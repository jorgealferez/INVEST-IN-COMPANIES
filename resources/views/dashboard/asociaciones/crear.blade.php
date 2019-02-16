@extends('layouts.dashboard')
@section('content')

<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex no-block">
                        <div>
                            <h4 class="card-title"><span class="lstick"></span>{{ __('Crear nueva asociación') }}</h4>
                        </div>
                    </div>
                    <form class="form-control-line form-material" action="{{ action('Dashboard\AsociacionesController@store')}}">
                        @csrf @method('PUT')
                        <div class="form-group {{ $errors->has('name') ? ' has-danger' : '' }}">
                            <label class="col-md-12 form-control-label" for="error">{{ __('Nombre') }}</label>
                            <div class="col-md-12">
                                <input type="text" value="{{ old('name') }}" class="form-control form-control-line {{ $errors->has('name') ? ' form-control-danger' : '' }}"
                                    id="name" name="name" required>
                            </div>
                            @if ($errors->has('name'))
                            <div class="col-md-12 form-control-feedback">{{ $errors->first('name') }}</div>
                            @endif

                        </div>

                        <div class="form-group {{ $errors->has('address') ? ' has-danger' : '' }}">
                            <label class="col-md-12 form-control-label" for="error">{{ __('Dirección') }}</label>
                            <div class="col-md-12">
                                <input type="text" value="{{ old('address') }}" class="form-control form-control-line {{ $errors->has('address') ? ' form-control-danger' : '' }}"
                                    id="address" name="address" required>
                            </div>
                            @if ($errors->has('address'))
                            <div class="col-md-12 form-control-feedback">{{ $errors->first('address') }}</div>
                            @endif

                        </div>


                        <div class="form-group {{ $errors->has('email') ? ' has-danger' : '' }}">
                            <label class="col-md-12 form-control-label" for="error">{{ __('Email') }}</label>
                            <div class="col-md-12">
                                <input type="text" value="{{ old('email') }}" class="form-control form-control-line {{ $errors->has('email') ? ' form-control-danger' : '' }}"
                                    id="email" name="email" required>
                            </div>
                            @if ($errors->has('email'))
                            <div class="col-md-12 form-control-feedback">{{ $errors->first('email') }}</div>
                            @endif

                        </div>

                        <div class="form-group {{ $errors->has('phone') ? ' has-danger' : '' }}">
                            <label class="col-md-12 form-control-label" for="error">{{ __('Teléfono') }}</label>
                            <div class="col-md-12">
                                <input type="text" value="{{ old('phone') }}" class="form-control form-control-line {{ $errors->has('phone') ? ' form-control-danger' : '' }}"
                                    id="phone" name="phone" required>
                            </div>
                            @if ($errors->has('phone'))
                            <div class="col-md-12 form-control-feedback">{{ $errors->first('phone') }}</div>
                            @endif

                        </div>


                        <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-success">{{ __('Crear Asociación') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('scripts')
@endsection
