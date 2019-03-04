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

        @include('dashboard.usuarios.tarjeta')
        <!-- Column -->
        @if ($isAdmin || ( !$isAdmin && $usuario->active))

        <div class="col-lg-8 col-xlg-9 col-md-7">
            <ul class="nav nav-tabs profile-tab   listaTabs " role="tablist">
                <li class="nav-item">
                    <a class="nav-link @if($tab=='modificar') active show @endif" data-toggle="tab" href="#modificar" role="tab">{{ __('Modificar') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if($tab=='roles') active show @endif" data-toggle="tab" href="#roles" role="tab">{{ __('Rol') }}</a>
                </li>
                @if ($isAdmin)
                <li class="nav-item">
                    <a class="nav-link @if($tab=='estado') active show @endif" data-toggle="tab" href="#estado" role="tab">
                        {{ __('Estado') }}
                    </a>
                </li>
                @endif
            </ul>

            <div class="card card-tabs">

                <!-- Tab panes -->

                <div class="tab-content">

                    <div class="tab-pane  @if($tab=='modificar') active @endif" id="modificar" role="tabpanel">

                        <div class="card-body bg-info ">
                            <h6 class="card-subtitle text-white m-0">{{ __('Modifica los datos del usuario.') }}</h6>
                        </div>

                        <div class="card-body">
                            <form method="POST" class="form-control-line form-material" action="{{ $action }}">
                                @csrf @method('POST')
                                @include('dashboard.usuarios.formulario')

                                <div class="form-group">
                                    <input type="checkbox" {{ $usuario->active ? 'checked="checked"' : '' }}" name=" active" id="active" data-on-color="success" data-off-color="muted" data-on-text="Activo" data-off-text="Desactivado">

                                </div>

                                <div class="form-group">

                                    <div class="col-sm-12">
                                        <button class="btn btn-verde  waves-effect waves-light">{{ __('Actualizar datos de usuario') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="tab-pane  @if($tab=='roles') active @endif" id="roles" role="tabpanel">

                        <div class="card-body bg-info ">
                            <h6 class="card-subtitle text-white m-0">{{ __('Modifica el perfil del usuario.') }}</h6>
                        </div>

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
                                        <button class="btn btn-verde  waves-effect waves-light">{{ __('Actualizar Role') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    @if ($isAdmin)

                    <div class="tab-pane  @if($tab=='estado') active @endif" id="estado" role="tabpanel">

                        <div class="card-body bg-info ">
                            <h6 class="card-subtitle text-white m-0">{{ __('Cambia el estado del usuario.') }}</h6>
                        </div>

                        <div class="card-body">
                            <form method="POST" class="" action="{{ action('Dashboard\UsuariosController@updateEstado', ['id' => $usuario->id])}}">
                                @csrf @method('PUT')

                                <div class="row">

                                    <div class="col-md-12">

                                        <div class="form-group ">
                                            <label for="active" class=" col-form-label ">{{ __('Estado') }}</label>
                                            <select name="active" id="active" class="form-control form-control-line {{ $errors->has('active') ? ' form-control-danger' : '' }}" required>
                                                <option value="1" @if ( $usuario->active) selected @endif>{{ __('Activo') }}</option>
                                                <option value="0" @if (! $usuario->active) selected @endif>{{ __('Eliminado') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-12">

                                        <div class="form-group">
                                            <button class="btn btn-verde waves-effect waves-light">{{ __('Modificar estado') }}</button>
                                            <a href="{{ e(route('dashboardOfertas')) }}" class="btn btn-inverse waves-effect waves-light">{{ __('Cancelar') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endif
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
