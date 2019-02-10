@extends('layouts.dashboard')

@section('content')

<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex no-block">
                        <div>
                            <h4 class="card-title"><span class="lstick"></span>{{ __('Crear nueva Oferta') }}</h4>
                        </div>
                    </div>
                    <form  class="form-control-line form-material" action="{{ action('dashboard\OfertasController@store')}}">
                            @csrf
                            @method('PUT')
                            <div class="form-group {{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="col-md-12 form-control-label" for="error">{{ __('Nombre') }}</label>
                                <div class="col-md-12">
                                    <input type="text" value="{{ old('name') }}"  class="form-control form-control-line {{ $errors->has('name') ? ' form-control-danger' : '' }}" id="name" name="name" required>
                                </div>
                                @if ($errors->has('name'))
                                <div class="col-md-12 form-control-feedback">{{ $errors->first('name') }}</div>
                                @endif

                            </div>
                            <div class="form-group {{ $errors->has('cif') ? ' has-danger' : '' }}">
                                <label class="col-md-12 form-control-label" for="error">{{ __('Cif') }}</label>
                                <div class="col-md-12">
                                    <input type="text" value="{{ old('cif') }}"  class="form-control form-control-line {{ $errors->has('cif') ? ' form-control-danger' : '' }}" id="cif" name="cif" required>
                                </div>
                                @if ($errors->has('cif'))
                                <div class="col-md-12 form-control-feedback">{{ $errors->first('cif') }}</div>
                                @endif

                            </div>

                            <div class="form-group {{ $errors->has('address') ? ' has-danger' : '' }}">
                                <label class="col-md-12 form-control-label" for="error">{{ __('Dirección') }}</label>
                                <div class="col-md-12">
                                    <input type="text"  value="{{ old('address') }}"   class="form-control form-control-line {{ $errors->has('address') ? ' form-control-danger' : '' }}" id="address" name="address" required>
                                </div>
                                @if ($errors->has('address'))
                                <div class="col-md-12 form-control-feedback">{{ $errors->first('address') }}</div>
                                @endif

                            </div>


                            <div class="form-group {{ $errors->has('contactEmail') ? ' has-danger' : '' }}">
                                <label class="col-md-12 form-control-label" for="error">{{ __('Email de contacto') }}</label>
                                <div class="col-md-12">
                                    <input type="text" value="{{ old('contactEmail') }}"  class="form-control form-control-line {{ $errors->has('contactEmail') ? ' form-control-danger' : '' }}" id="contactEmail" name="contactEmail" required>
                                </div>
                                @if ($errors->has('email'))
                                <div class="col-md-12 form-control-feedback">{{ $errors->first('email') }}</div>
                                @endif

                            </div>

                            <div class="form-group {{ $errors->has('contactPhone') ? ' has-danger' : '' }}">
                                <label class="col-md-12 form-control-label" for="error">{{ __('Teléfono') }}</label>
                                <div class="col-md-12">
                                    <input type="text"value="{{ old('contactPhone') }}"  class="form-control form-control-line {{ $errors->has('contactPhone') ? ' form-control-danger' : '' }}" id="contactPhone" name="contactPhone" required>
                                </div>
                                @if ($errors->has('phone'))
                                <div class="col-md-12 form-control-feedback">{{ $errors->first('phone') }}</div>
                                @endif

                            </div>


                            <div class="form-group {{ $errors->has('usuario') ? ' has-danger' : '' }}">
                                <label for="role" class="col-md-12 col-form-label ">{{ __('Selecciona Usuario') }}</label>
    
                                <div class="col-md-12">
                                    <select name="usuario" id="usuario" class="form-control form-control-line {{ $errors->has('usuario') ? ' form-control-danger' : '' }}" required>
                                        <option value="0">{{ __('Selecciona Usuario') }}</option>
                                        @foreach ($usuariosAsociacion as $usuariosAsociacion)
                                        <?php $usuariousuariosAsociacion= $usuariosAsociacion->name; ?>
                                        <option value="{{ $usuariosAsociacion->id }}" @if ( old('usuario')==$usuariosAsociacion->id)
                                            selected
                                            @endif  class="">{{$usuariosAsociacion->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                @if ($errors->has('usuario'))
                                <div class="col-md-12 form-control-feedback">{{ $errors->first('usuario') }}</div>
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
