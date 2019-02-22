@extends('layouts.dashboard')
@section('estilos') {{--
<link href="{{ asset('js/dashboard/plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" /> --}} {{--
<link href="{{ asset('js/dashboard/plugins/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" />
<link href="{{ asset('js/dashboard/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}" rel="stylesheet" />
<link href="{{ asset('js/dashboard/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" /> --}}
<link href="{{ asset('css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

<div class="container-fluid">

    @include('dashboard.alertas')

    <div class="row">
        <!-- Column -->

        <div class="col-lg-4 col-xlg-3 col-md-5">

            <div class="card card-profile">

                <div class="card-body text-center  bg-gray">
                    <span class="round {{ $usuario->getRoleClass() }} roleBig profile-rol">{{ $usuario->roles->first()->name }}</span>
                </div>

                <div class="card-body pro-img text-center pt-5">
                    <h4 class="card-title m-t-10">{{ e($usuario->name." ".$usuario->surname) }}</h4>
                    @if ($usuario->asociaciones)
                    <small class="text-muted">
                    </small> @foreach ($usuario->asociaciones as $asociacion)
                    <h6 class="card-subtitle">{{ e($asociacion->name)}}</h6>
                    @endforeach
                    @endif
                </div>

                <hr class="m-0">

                <div class="card-body ">
                    <small class="text-muted"><i class="ti-email"></i> {{ __('Email') }}</small>
                    <a href="mailto:{{ e($usuario->email) }}" class="link text-muted">
                        <h6>{{ e($usuario->email) }}</h6>
                    </a>
                    <small class="text-muted"><i class="ti-mobile"></i> {{ __('Teléfono') }}</small>
                    <h6>{{ e($usuario->phone) }}</h6>

                    <div class="row ">

                        <div class="col-md-12 ">

                        </div>

                        <div class="col-md-12">

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Column -->

        <div class="col-lg-8 col-xlg-9 col-md-7">


            <div class="card">
                <ul class="nav nav-tabs profile-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link @if($tab=='modificar') active show @endif" data-toggle="tab" href="#modificar" role="tab">{{ __('Modificar') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if($tab=='roles') active show @endif" data-toggle="tab" href="#roles" role="tab">{{ __('Rol') }}</a>
                    </li>
                </ul>
                <!-- Tab panes -->

                <div class="tab-content">

                    <div class="tab-pane  @if($tab=='modificar') active @endif" id="modificar" role="tabpanel">

                        <div class="card-body">
                            <form method="POST" class="form-control-line form-material" action="{{ $action }}">
                                @csrf @method('POST')

                                <div class="form-group {{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="col-md-12 form-control-label" for="error">{{ __('Nombre') }}</label>

                                    <div class="col-md-12">
                                        <input type="text" value="{{ old('name')?old('name'): e($usuario->name) }}" placeholder="{{ e($usuario->name) }}" class="form-control form-control-line {{ $errors->has('name') ? ' form-control-danger' : '' }}" id="name" name="name" required>
                                    </div>
                                    @if ($errors->has('name'))

                                    <div class="col-md-12 form-control-feedback">{{ $errors->first('name') }}</div>
                                    @endif

                                </div>

                                <div class="form-group {{ $errors->has('surname') ? ' has-danger' : '' }}">
                                    <label class="col-md-12 form-control-label" for="error">{{ __('Nombre') }}</label>

                                    <div class="col-md-12">
                                        <input type="text" value="{{ old('surname')?old('surname'): e($usuario->surname) }}" placeholder="{{ e($usuario->surname) }}" class="form-control form-control-line {{ $errors->has('surname') ? ' form-control-danger' : '' }}" id="surname" name="surname" required>
                                    </div>
                                    @if ($errors->has('surname'))

                                    <div class="col-md-12 form-control-feedback">{{ $errors->first('surname') }}</div>
                                    @endif

                                </div>

                                <div class="form-group {{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <label class="col-md-12 form-control-label" for="error">{{ __('Email') }}</label>

                                    <div class="col-md-12">
                                        <input type="text" value="{{ old('email')?old('email'): e($usuario->email) }}" placeholder="{{ e($usuario->email) }}" class="form-control form-control-line {{ $errors->has('email') ? ' form-control-danger' : '' }}" id="email" name="email" required>
                                    </div>
                                    @if ($errors->has('email'))

                                    <div class="col-md-12 form-control-feedback">{{ $errors->first('email') }}</div>
                                    @endif

                                </div>

                                <div class="form-group {{ $errors->has('phone') ? ' has-danger' : '' }}">
                                    <label class="col-md-12 form-control-label" for="error">{{ __('Teléfono') }}</label>

                                    <div class="col-md-12">
                                        <input type="text" value="{{ old('phone')?old('phone'): e($usuario->phone) }}" placeholder="{{ e($usuario->phone) }}" class="form-control form-control-line {{ $errors->has('phone') ? ' form-control-danger' : '' }}" id="phone" name="phone" required>
                                    </div>
                                    @if ($errors->has('phone'))

                                    <div class="col-md-12 form-control-feedback">{{ $errors->first('phone') }}</div>
                                    @endif

                                </div>

                                <div class="form-group">
                                    <input type="checkbox" {{ $usuario->active ? 'checked="checked"' : '' }}" name=" active" id="active" data-on-color="success" data-off-color="muted" data-on-text="Activo" data-off-text="Desactivado">

                                </div>

                                <div class="form-group">

                                    <div class="col-sm-12">
                                        <button class="btn btn-success">{{ __('Actualizar') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="tab-pane  @if($tab=='roles') active @endif" id="roles" role="tabpanel">

                        <div class="card-body">
                            <form method="POST" class="form-control-line form-material" action="{{ action('Dashboard\UsuariosController@updateRol', ['id' => $usuario->id])}}">
                                @csrf @method('POST')

                                <div class="form-group {{ $errors->has('role') ? ' has-danger' : '' }}">
                                    <label for="role" class="col-md-12 col-form-label">{{ __('Role') }}</label>

                                    <div class="col-md-12">
                                        <select name="role" id="role" class="form-control {{ $errors->has('role') ? ' form-control-danger' : '' }}" required>
                                            <option value="0">{{ __('Selecciona Perfil') }}</option>
                                            @foreach ($roles as $role)
                                            <option value="{{ $role->id }}" @if ($usuario->roles->first()->id==$role->id)
                                                selected
                                                @endif>{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    @if ($errors->has('role'))

                                    <div class="col-md-12 form-control-feedback">{{ $errors->first('role') }}</div>
                                    @endif
                                </div>

                                <div class="form-group">

                                    <div class="col-sm-12">
                                        <button class="btn btn-success">{{ __('Actualizar Role') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>

</div>
@endsection

@section('scripts') {{--
<script src="{{ asset('js/dashboard/plugins/select2/dist/js/select2.full.min.js') }}" type="text/javascript"></script> --}} {{--
<script src="{{ asset('js/dashboard/plugins/switchery/dist/switchery.min.js') }}"></script>
<script src="{{ asset('js/dashboard/plugins/bootstrap-select/bootstrap-select.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/dashboard/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{ asset('js/dashboard/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/dashboard/plugins/dff/dff.js') }}" type="text/javascript"></script>
--}}



<script>
    $(function () {
        // For select 2


    });

</script>
@endsection
