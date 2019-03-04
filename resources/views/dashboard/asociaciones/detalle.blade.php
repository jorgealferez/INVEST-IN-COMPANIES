@extends('layouts.dashboard')
@section('estilos')
@endsection

@section('content')

<div class="container-fluid">

    <div class="row">

        <div class="col-lg-5 col-xlg-4 ">

            <div class="card card-profile">

                <div class="card-body   bg-gray">
                    <h4 class="card-title text-white m-0">
                        {{ e($asociacion->name) }}
                        @if ($nueva)
                        <span class="badge badge-warning float-right mr-2">
                            <i class="mdi mdi-star text-white "></i>
                            {{ __('Nueva') }}
                        </span>
                        @endif
                    </h4>
                </div>


                <div class="card-body ">

                    <div class="col-md-12  ">
                        <small class=" font-weight-bold verde">{{ __('Email') }}:</small>
                        <a href="mailto:{{ e($asociacion->email) }}" class="link text-muted">
                            <h6>{{ e($asociacion->email) }}</h6>
                        </a>
                    </div>

                    <div class="col-md-12 ">
                        <small class=" font-weight-bold verde">{{ __('Teléfono') }}:</small>
                        <h6>{{ e($asociacion->phone) }}</h6>
                    </div>

                    <div class="col-md-12">
                        <small class=font-weight-bold verde ">{{ __('Direccion') }}:</small>
                        <h6>{{ e($asociacion->address) }}</h6>
                    </div>

                </div>

                <hr class=" m-0">

                            <div class=" card-body ">
                                <small class=" text-muted ">
                                    <i class=" ti-user "></i>
                                    {{ __('Persona de contacto') }}
                                </small>
                                <h6>{{ e($asociacion->contact) }}</h6>
                                <small class=" text-muted ">
                                    <i class=" ti-email "></i>
                                    {{ __('Email') }}
                                </small>
                                <a href=" mailto:{{ e($asociacion->contactEmail) }}" class="link text-muted">
                                    {{ e($asociacion->contactEmail) }}
                                </a>
                                <small class="text-muted ">
                                    <i class="ti-mobile"></i>
                                    {{ __('Teléfono') }}
                                </small>
                                <h6>{{ e($asociacion->contactPhone) }}</h6>


                            </div>
                    </div>
                </div>

                <div class="col-lg-7 col-xlg-8 ">
                    @include('dashboard.alertas')
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs profile-tab listaTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link @if($tab=='usuarios') active show @endif" data-toggle="tab" href="#usuarios" role="tab">Usuarios</a>
                        </li>

                        @if($isAdmin)
                        <li class="nav-item">
                            <a class="nav-link @if($tab=='modificar') active show @endif" data-toggle="tab" href="#modificar" role="tab">Modificar</a>
                        </li>
                        @endif
                    </ul>

                    <div class="card card-tabs">


                        <!-- Tab panes -->

                        <div class=" tab-content">

                            <div class="tab-pane  @if($tab=='usuarios') active @endif" id="usuarios" role="tabpanel">

                                <div class="card-body bg-info ">
                                    <h6 class="card-subtitle text-white m-0 ">{{ __('Listado de usuarios que pertenecen a la asociación.') }}</h6>
                                </div>

                                <div class="card-body ">

                                    <div class="table-responsive ">
                                        <table class="table  table-hover table-boder tabla-inversores">
                                            <tbody>
                                                @if($asociacion->usuarios->isNotEmpty()) @foreach ($asociacion->usuarios as $usuario_asociacion)
                                                <tr>
                                                    <td class="p-0">
                                                        <a href="#collapse{{ $usuario_asociacion->id }}" class="tab-usuarios-link" role="button" aria-expanded="false" aria-controls="collapse{{ $usuario_asociacion->id }}" data-toggle="collapse">

                                                            <span class="mx-1 round roleSmall {{ $usuario_asociacion->getRoleClass() }}"> <i class="mdi mdi-account " style="font-size: 190%"></i>
                                                            </span>
                                                            {{ e( $usuario_asociacion->FullName) }}
                                                        </a>

                                                        <div class="tab-usuarios-content collapse" id="collapse{{ $usuario_asociacion->id }}">

                                                            <div class="p-3 row m-0">

                                                                <div class="col-md-12 my-2">
                                                                    <span class="text-muted"><i class="ti-email"></i> {{ __('Email') }}</span>
                                                                    <h6>{{ e( $usuario_asociacion->email) }}</h6>
                                                                </div>

                                                                <div class="col-md-12 my-2">
                                                                    <span class="text-muted"><i class="ti-mobile"></i> {{ __('Teléfono') }}</span>
                                                                    <h6>{{ e( $usuario_asociacion->phone) }}</h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                @endforeach @else
                                                <tr>
                                                    <td colspan="5">
                                                        <p>{{ __('No hay usuarios en la asociación.') }}</p>
                                                    </td>
                                                </tr>
                                                @endif
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="5" class="text-right">
                                                        @if ($asociacion->usuarios->count()>1)
                                                        <small>
                                                            {{ 'Hay ' }}
                                                            <strong>
                                                                {{ $asociacion->usuarios->count() }}
                                                            </strong>
                                                            @if ($asociacion->usuarios->count()>1)
                                                            {{ __(' usuarios ') }}
                                                            @elseif($asociacion->usuarios->count()==1)
                                                            {{ __('  usuario') }}
                                                            @endif
                                                            {{ 'en la asociación ' }}
                                                        </small> @endif
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                    @if($isAdmin )

                                    <hr>

                                    <h4 class="verde font-medium">
                                        <i class="mdi mdi-account-multiple-plus"></i> {{ __('Añadir') }}/{{ __('Eliminar Usuarios')}}
                                    </h4>
                                    <form method="POST" class="form-control-line form-material" action="{{ action('Dashboard\AsociacionesController@updateUsers', ['id' => $asociacion->id])}}">
                                        @csrf @method('PUT')

                                        <input type="hidden" value="usuarios" name="tab" id="tab_usuarios">

                                        <div class="form-group">

                                            <div class="col-sm-12  mt-1">

                                                <select class="multi" multiple="multiple" name="usuarios[]" id="usuarios">

                                                    @foreach ($rolesLista as $role)
                                                    <optgroup label="{{ e($role->name) }}" data="role">
                                                        @foreach ($role->users as $usuario)
                                                        {{-- MUESTRO SÓLO LOS USUARIOS DE LA ASOCIACION --}}

                                                        <option value="{{ e($usuario->id) }}" <?php $retVal=(in_array($usuario->id, $usuariosIDs)) ? "selected" : "" ;
                                                            echo $retVal;
                                                            ?> data-style="role{{ substr($role->name,0,2) }}">
                                                            {{ e($usuario->email) }}

                                                        </option>
                                                        @endforeach
                                                    </optgroup>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">

                                            <div class="col-sm-12">
                                                <button class="btn btn-verde  waves-effect waves-light">{{ __('Actualizar Usuarios') }}</button>
                                                <a href="{{ e(route('dashboardAsociaciones')) }}" class="btn btn-inverse waves-effect waves-light">{{ __('Cancelar') }}</a>
                                            </div>
                                        </div>

                                    </form>
                                    @endif
                                </div>
                            </div>

                            @if($isAdmin )

                            <div class="tab-pane  @if($tab=='modificar') active @endif" id="modificar" role="tabpanel">

                                <div class="card-body bg-info ">
                                    <h6 class="card-subtitle text-white m-0 ">{{ __('Modifica los datos de la asociación.') }}</h6>
                                </div>

                                <div class="card-body">
                                    <form method="POST" class="" action="{{ action('Dashboard\AsociacionesController@update', ['id' => $asociacion->id])}}">
                                        @csrf @method('PUT')
                                        <input type="hidden" value="{{$asociacion->id}}" name="asociacion_id" id="asociacion_id">
                                        <input type="hidden" value="modificar" name="tab" id="tab_modificar">

                                        <div class="form-group {{ $errors->has('name') ? ' has-danger' : '' }}">
                                            <label class="col-md-12 form-control-label" for="error">{{ __('Nombre') }}</label>

                                            <div class="col-md-12">
                                                <input type="text" value="{{ old('name')?old('name'): e($asociacion->name) }}" placeholder="{{ e($asociacion->name) }}" class="form-control form-control-line {{ $errors->has('name') ? ' form-control-danger' : '' }}" id="name" name="name" required>
                                            </div>
                                            @if ($errors->has('name'))

                                            <div class="col-md-12 form-control-feedback">{{ $errors->first('name') }}</div>
                                            @endif

                                        </div>

                                        <div class="form-group {{ $errors->has('address') ? ' has-danger' : '' }}">
                                            <label class="col-md-12 form-control-label" for="error">{{ __('Dirección') }}</label>

                                            <div class="col-md-12">
                                                <input type="text" value="{{ old('address')?old('address'): e($asociacion->address) }}" placeholder="{{ e($asociacion->address) }}" class="form-control form-control-line {{ $errors->has('address') ? ' form-control-danger' : '' }}" id="address" name="address" required>
                                            </div>
                                            @if ($errors->has('address'))

                                            <div class="col-md-12 form-control-feedback">{{ $errors->first('address') }}</div>
                                            @endif

                                        </div>


                                        <div class="form-group {{ $errors->has('email') ? ' has-danger' : '' }}">
                                            <label class="col-md-12 form-control-label" for="error">{{ __('Email') }}</label>

                                            <div class="col-md-12">
                                                <input type="text" value="{{ old('email')?old('email'): e($asociacion->email) }}" placeholder="{{ e($asociacion->email) }}" class="form-control form-control-line {{ $errors->has('email') ? ' form-control-danger' : '' }}" id="email" name="email" required>
                                            </div>
                                            @if ($errors->has('email'))

                                            <div class="col-md-12 form-control-feedback">{{ $errors->first('email') }}</div>
                                            @endif

                                        </div>

                                        <div class="form-group {{ $errors->has('phone') ? ' has-danger' : '' }}">
                                            <label class="col-md-12 form-control-label" for="error">{{ __('Teléfono') }}</label>

                                            <div class="col-md-12">
                                                <input type="text" value="{{ old('phone')?old('phone'): e($asociacion->phone) }}" placeholder="{{ e($asociacion->phone) }}" class="form-control form-control-line {{ $errors->has('phone') ? ' form-control-danger' : '' }}" id="phone" name="phone" required>
                                            </div>
                                            @if ($errors->has('phone'))

                                            <div class="col-md-12 form-control-feedback">{{ $errors->first('phone') }}</div>
                                            @endif

                                        </div>


                                        <div class="form-group">

                                            <div class="col-sm-12">
                                                <button class="btn btn-verde  waves-effect waves-light">{{ __('Actualizar') }}</button>
                                                <a href="{{ e(route('dashboardAsociaciones')) }}" class="btn btn-inverse waves-effect waves-light">{{ __('Cancelar') }}</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection

        @section('scripts')

        <script>
            $(function () {

                $(".alert-success").fadeTo(5000, 500).slideUp(500, function () {
                    $(".alert-success").slideUp(500);
                });
            });

        </script>

        @if($isAdmin || $isAsesor)

        <script src="{{ asset('/js/dashboard/jquery.multi-select.js') }}" type="text/javascript"></script>

        <link href="{{ asset('css/multi-select.css') }}" rel="stylesheet" type="text/css" />
        <script>
            $(document).ready(function () {

                $('.multi').multiSelect({
                    selectableOptgroup: true,
                    selectableHeader: "<div class='custom-header'>Disponibles:</div>",
                    selectionHeader: "<div class='custom-header'>Seleccionados:</div>",
                });
            });

        </script>

        @endif
        @endsection
