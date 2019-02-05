@extends('layouts.dashboard')


@section('estilos')
<link href="{{ asset('js/dashboard/plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />

{{-- <link href="{{ asset('js/dashboard/plugins/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" />
<link href="{{ asset('js/dashboard/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}" rel="stylesheet" />
<link href="{{ asset('js/dashboard/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" />
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
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d470029.1604841957!2d72.29955005258641!3d23.019996818380896!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e848aba5bd449%3A0x4fcedd11614f6516!2sAhmedabad%2C+Gujarat!5e0!3m2!1sen!2sin!4v1493204785508" width="100%" height="150" frameborder="0" style="border:0" allowfullscreen=""></iframe>
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
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                        {{ __('Los cambios se han guardado correctamente') }}
                </div>
            </div>
            @endif
            <div class="card">
                
                <!-- Nav tabs -->
                <ul class="nav nav-tabs profile-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link @if($tab=='usuarios') active show @endif" data-toggle="tab" href="#usuarios" role="tab">Usuarios</a>
                    </li>
                    <li class="nav-item"> 
                        <a class="nav-link @if($tab=='modificar') active show @endif" data-toggle="tab" href="#modificar" role="tab">Modificar</a> 
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane  @if($tab=='usuarios') active @endif" id="usuarios" role="tabpanel">
                        <div class="card-body">
                            {{-- {{ dd($asociacion->users) }} --}}
                            <table class="table vm no-th-brd pro-of-month">
                                <thead>
                                    <tr>
                                        <th colspan="2">Assigned</th>
                                        <th>Name</th>
                                        <th>Priority</th>
                                        <th>Budget</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if($asociacion->users->isNotEmpty())
                                    @foreach ($asociacion->users as $usuario_asociacion)
                                    <?php $usuario_asociacionRole= $usuario_asociacion->roles->first()->name; ?>
                                    <tr>
                                        <td style="width:50px;"><span class="round role{{ substr($usuario_asociacionRole,0,2) }}">{{ substr($usuario_asociacionRole,0,1) }}</span></td>
                                        <td>
                                            <h6>{{ e($usuario_asociacion->name." ".$usuario_asociacion->surname) }}</h6>
                                            <small class="text-muted">{{ e($usuario_asociacion->email) }}</small>
                                        </td>
                                        <td>Elite Admin</td>
                                        <td><span class="label label-success label-rounded">Low</span></td>
                                        <td>$3.9K</td>
                                    </tr>

                                    @endforeach
                                @else
                                <tr>
                                    <td colspan="5">
                                        <p>{{ __('No hay usuarios asignados') }}</p>
                                    </td>
                                </tr>
                                @endif
                                </tbody>
                            </table>
                            @if(Auth::user()->hasAnyRole(array('Admin','Asesor')))
                            <h4 class="font-medium m-t-30">Modificar Usuarios</h4>
                                <form method="POST" class="form-control-line form-material" action="{{ action('dashboard\AsociacionesController@updateUsers', ['id' => $asociacion->id])}}">
                                    @csrf
                                    @method('PUT')
                                    
                                <input type="hidden" value="usuarios" name="tab" id="tab_usuarios">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <select class="select2 m-b-10 select2-multiple" style="width: 100%" multiple="multiple" data-placeholder="Choose" name="usuarios[]" id="usuarios">
                                            <?php $roleName=""; ?>
                                            @foreach ($usuarios as $usuario) 
                                                <?php $usuario_asociacionRole= $usuario->roles->first()->name; ?>
                                                @if ($usuario_asociacionRole != $roleName)
                                                <?php $roleName= $usuario->roles->first()->name; ?>
                                                    <optgroup label="{{ e($usuario->roles->first()->name) }}"> 
                                                @endif 
                                                    <option value="{{ e($usuario->id) }}"
                                                    <?php 
                                                        $retVal = (in_array($usuario->id, $usuariosIDs)) ? "selected" : "" ;
                                                        echo $retVal;
                                                    ?> data-style="role{{ substr($usuario_asociacionRole,0,2) }}">
                                                            {{ e($usuario->email) }} 
                                                    
                                                    </option>
                                                </optgroup>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{-- <div class="dropdown bootstrap-select show-tick show">
                                    <select class="selectpicker" multiple="" data-style="form-control btn-info " tabindex="-98">
                                        <option>Mustard</option>
                                        <option>Ketchup</option>
                                        <option>Relish</option>
                                    </select>
                                </div> --}}
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button class="btn btn-success">{{ __('Actualizar Usuarios') }}</button>
                                    </div>
                                </div>
                                
                            </form>
                        @endif
                        </div>
                    </div>
                    <div class="tab-pane  @if($tab=='modificar') active @endif" id="modificar" role="tabpanel">
                        <div class="card-body">
                            <form method="POST" class="form-control-line form-material" action="{{ action('dashboard\AsociacionesController@update', ['id' => $asociacion->id,'tab' => 'modificar'])}}">
                                @csrf
                                @method('PUT')
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
                                        <button class="btn btn-success">{{ __('Actualizar') }}</button>
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


@section('scripts')

<script src="{{ asset('js/dashboard/plugins/select2/dist/js/select2.full.min.js') }}" type="text/javascript"></script>
{{-- <script src="{{ asset('js/dashboard/plugins/switchery/dist/switchery.min.js') }}"></script>
<script src="{{ asset('js/dashboard/plugins/bootstrap-select/bootstrap-select.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/dashboard/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{ asset('js/dashboard/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/dashboard/plugins/dff/dff.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('js/dashboard/plugins/multiselect/js/jquery.multi-select.js') }}"></script> --}}



<script>
$(function() {
        // For select 2
        $(".select2").select2();

        // $('.selectpicker').selectpicker();
    });
</script>
@endsection
