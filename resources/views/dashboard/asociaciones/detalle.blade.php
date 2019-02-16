@extends('layouts.dashboard')
@section('estilos') {{--
<link href="{{ asset('js/dashboard/plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" /> --}} {{--
<link href="{{ asset('js/dashboard/plugins/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" />
<link href="{{ asset('js/dashboard/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}" rel="stylesheet" />
<link href="{{ asset('js/dashboard/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet"
/>
<link href="{{ asset('js/dashboard/plugins/multiselect/css/multi-select.css') }}" rel="stylesheet" type="text/css" /> --}}
@endsection

@section('content')

<div class="container-fluid">

    <div class="row">
        <!-- Column -->
        <div class="col-lg-4 col-xlg-3 col-md-5">
            <div class="card"> <img class="card-img" src="{{ asset('/images/background/socialbg.jpg') }}" alt="Card image">
                <div class="card-img-overlay card-inverse social-profile d-flex ">
                    <div class="align-self-center"> <img src="{{ asset('/images/users/1.jpg') }}" class="img-circle" width="100">
                        <h4 class="card-title">{{ e($asociacion->name) }}</h4>
                        <h6 class="card-subtitle">@jamesandre</h6>
                        <p class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt </p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">

                    <small class="text-muted">Email</small>
                    <h6>{!! e($asociacion->email) !!}</h6>

                    <small class="text-muted p-t-30 db">Teléfono</small>
                    <h6>{{ e($asociacion->phone) }}</h6>

                    <small class="text-muted p-t-30 db">Dirección</small>
                    <h6>{{ e($asociacion->address) }}</h6>

                    <div class="map-box">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d470029.1604841957!2d72.29955005258641!3d23.019996818380896!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e848aba5bd449%3A0x4fcedd11614f6516!2sAhmedabad%2C+Gujarat!5e0!3m2!1sen!2sin!4v1493204785508"
                            width="100%" height="150" frameborder="0" style="border:0" allowfullscreen=""></iframe>
                    </div>

                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-8 col-xlg-9 col-md-7">

            @if (session()->has('success'))
            <div class="row">
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>                    {{ __('Los cambios se han guardado correctamente') }}
                </div>
            </div>
            @endif
            <div class="card">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs profile-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link @if($tab=='usuarios') active show @endif" data-toggle="tab" href="#usuarios" role="tab">Usuarios</a>
                    </li>
                    @if(Auth::user()->hasAnyRole(array('Admin','Asesor')))
                    <li class="nav-item">
                        <a class="nav-link @if($tab=='modificar') active show @endif" data-toggle="tab" href="#modificar" role="tab">Modificar</a>
                    </li>
                    @endif
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane  @if($tab=='usuarios') active @endif" id="usuarios" role="tabpanel">
                        <div class="card-body">
                            <div class="card">
                                <div class="card-body">
                                    <div class="message-box contact-box">
                                        <div class="message-widget contact-widget">
                                            @foreach ($asociacion->usuarios as $usuario_asociacion)
                                            <?php
                                                        $usuarioRole= $usuario_asociacion->roles->first()->name;
                                                     ?>
                                                <div class="card m-b-0">
                                                    <a href="#collapse{{ $usuario_asociacion->id }}" class="card-header text-decoration-none" id="heading11" role="button" aria-expanded="false"
                                                        aria-controls="collapse{{ $usuario_asociacion->id }}" data-toggle="collapse"
                                                        data-target="#collapse{{ $usuario_asociacion->id }}">
                                                        <div class="user-img">
                                                            <h6>
                                                                <span class="round role{{ substr($usuarioRole,0,2) }}">{{ substr($usuarioRole,0,1) }}</span>
                                                                <span class="profile-status {{ $usuario_asociacion->statusClass() }} pull-right"></span>
                                                            </h6>
                                                            </span>
                                                        </div>
                                                        <div class="mail-contnet">
                                                            <h5>{{ e( $usuario_asociacion->name.' '. $usuario_asociacion->surname)
                                                                }} </h5>
                                                            <span class="mail-desc">{{ e( $usuario_asociacion->email) }}</span>
                                                        </div>

                                                    </a>
                                                    <div id="collapse{{ $usuario_asociacion->id }}" class="collapse" aria-labelledby="heading11" style=" ">
                                                        <div class="card-body ">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <small class="text-muted">{{ __('Nombre') }}</small>
                                                                    <h6>{{ e( $usuario_asociacion->name.' '. $usuario_asociacion->surname)
                                                                        }}
                                                                    </h6>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <small class="text-muted">{{ __('Email') }}</small>
                                                                    <h6>{{ e( $usuario_asociacion->email) }}</h6>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <small class="text-muted p-t-30 db">{{ __('Teléfono') }}</small>
                                                                    <h6>{{ e( $usuario_asociacion->phone) }}</h6>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <small class="text-muted p-t-30 db">{{ __('Estado') }}</small>
                                                                    <span class=" badge {{ $usuario_asociacion->statusClass() }} text-white">{{ $usuario_asociacion->statusName() }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if(Auth::user()->hasAnyRole(array('Admin','Asesor')))
                            <h4 class="font-medium m-t-30">Modificar Usuarios</h4>
                            <form method="POST" class="form-control-line form-material" action="{{ action('Dashboard\AsociacionesController@updateUsers', ['id' => $asociacion->id])}}">
                                @csrf @method('PUT')

                                <input type="hidden" value="usuarios" name="tab" id="tab_usuarios">

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <select class="select2 m-b-10 select2-multiple" style="width: 100%" multiple="multiple" data-placeholder="Choose" name="usuarios[]"
                                            id="usuarios">

                                            @foreach ($rolesLista as $role)
                                                <optgroup label="{{ e($role->name) }}">
                                                    @foreach ($role->users as $usuario)
                                                    {{-- MUESTRO SÓLO LOS USUARIOS DE LA ASOCIACION --}}
                                                     @if( $role->name="Admin" || $usuario->asociaciones->first()->id == $asociacion->id );
                                                        <option value="{{ e($usuario->id) }}"
                                                            <?php
                                                                $retVal = (in_array($usuario->id, $usuariosIDs)) ? "selected" : "" ;
                                                                echo $retVal;
                                                            ?> data-style="role{{ substr($role->name,0,2) }}">
                                                                {{ e($usuario->email) }}

                                                        </option>
                                                        @endif
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button class="btn btn-success">{{ __('Actualizar Usuarios') }}</button>
                                    </div>
                                </div>

                            </form>
                            @endif
                        </div>
                    </div>

                    @if(Auth::user()->hasAnyRole(array('Admin','Asesor')))
                    <div class="tab-pane  @if($tab=='modificar') active @endif" id="modificar" role="tabpanel">
                        <div class="card-body">
                            <form method="POST" class="form-control-line form-material" action="{{ action('Dashboard\AsociacionesController@update', ['id' => $asociacion->id])}}">
                                @csrf @method('PUT')
                                <input type="hidden" value="{{$asociacion->id}}" name="asociacion_id" id="asociacion_id">
                                <input type="hidden" value="modificar" name="tab" id="tab_modificar">
                                <div class="form-group {{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="col-md-12 form-control-label" for="error">{{ __('Nombre') }}</label>
                                    <div class="col-md-12">
                                        <input type="text" value="{{ old('name')?old('name'): e($asociacion->name) }}" placeholder="{{ e($asociacion->name) }}" class="form-control form-control-line {{ $errors->has('name') ? ' form-control-danger' : '' }}"
                                            id="name" name="name" required>
                                    </div>
                                    @if ($errors->has('name'))
                                    <div class="col-md-12 form-control-feedback">{{ $errors->first('name') }}</div>
                                    @endif

                                </div>

                                <div class="form-group {{ $errors->has('address') ? ' has-danger' : '' }}">
                                    <label class="col-md-12 form-control-label" for="error">{{ __('Dirección') }}</label>
                                    <div class="col-md-12">
                                        <input type="text" value="{{ old('address')?old('address'): e($asociacion->address) }}" placeholder="{{ e($asociacion->address) }}"
                                            class="form-control form-control-line {{ $errors->has('address') ? ' form-control-danger' : '' }}"
                                            id="address" name="address" required>
                                    </div>
                                    @if ($errors->has('address'))
                                    <div class="col-md-12 form-control-feedback">{{ $errors->first('address') }}</div>
                                    @endif

                                </div>


                                <div class="form-group {{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <label class="col-md-12 form-control-label" for="error">{{ __('Email') }}</label>
                                    <div class="col-md-12">
                                        <input type="text" value="{{ old('email')?old('email'): e($asociacion->email) }}" placeholder="{{ e($asociacion->email) }}"
                                            class="form-control form-control-line {{ $errors->has('email') ? ' form-control-danger' : '' }}"
                                            id="email" name="email" required>
                                    </div>
                                    @if ($errors->has('email'))
                                    <div class="col-md-12 form-control-feedback">{{ $errors->first('email') }}</div>
                                    @endif

                                </div>

                                <div class="form-group {{ $errors->has('phone') ? ' has-danger' : '' }}">
                                    <label class="col-md-12 form-control-label" for="error">{{ __('Teléfono') }}</label>
                                    <div class="col-md-12">
                                        <input type="text" value="{{ old('phone')?old('phone'): e($asociacion->phone) }}" placeholder="{{ e($asociacion->phone) }}"
                                            class="form-control form-control-line {{ $errors->has('phone') ? ' form-control-danger' : '' }}"
                                            id="phone" name="phone" required>
                                    </div>
                                    @if ($errors->has('phone'))
                                    <div class="col-md-12 form-control-feedback">{{ $errors->first('phone') }}</div>
                                    @endif

                                </div>


                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button class="btn btn-success">{{ __('Actualizar') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    @endif
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
<script type="text/javascript" src="{{ asset('js/dashboard/plugins/multiselect/js/jquery.multi-select.js') }}"></script> --}}



<script>
    $(function() {

        @if(Auth::user()->hasAnyRole(array('Admin','Asesor')))
            $(".select2").select2();
        @endif
        $(".alert-success").fadeTo(5000, 500).slideUp(500, function(){
            $(".alert-success").slideUp(500);
        });
    });

</script>
@endsection
