@extends('layouts.dashboard')
@section('estilos') {{--
<link href="{{ asset('js/dashboard/plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" /> --}} {{--
<link href="{{ asset('js/dashboard/plugins/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" />
<link href="{{ asset('js/dashboard/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}" rel="stylesheet" />
<link href="{{ asset('js/dashboard/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" />
<link href="{{ asset('js/dashboard/plugins/multiselect/css/multi-select.css') }}" rel="stylesheet" type="text/css" /> --}}
@endsection

@section('content')

<div class="container-fluid">

    <div class="row">
        <!-- Column -->

        <div class="col-lg-6 col-xlg-5 ">

            <div class="card card-profile">

                <div class="card-body   bg-gray">
                    <h4 class="card-title text-white m-0">
                        {{ e($oferta->name) }}
                        @if ($oferta->approved)
                        <span class="badge badge-success float-right"> <i class="mdi mdi-check-circle"></i> {{ __('Aprobada') }}</span>
                        @else
                        <span class="badge badge-danger float-right"> <i class="mdi mdi-alert-circle"></i> {{ __('Sin Aprobar') }}</span>
                        @endif
                        @if ($nueva)
                        <span class="badge badge-warning float-right mr-2"> <i class="mdi mdi-star text-white "></i> {{ __('Nueva') }}</span>
                        @endif
                    </h4>
                </div>

                <div class="card-body   bg-info">
                    <h6 class="card-subtitle text-white m-b-0 op-5">{{ e($oferta->descripcion) }}</h6>
                </div>

                <div class="card-body row">

                    <div class="col-md-8  ">
                        <small class=" font-weight-bold verde">{{ __('Forma Jurídica') }}:</small>
                        <h6>{{ e($oferta->forma->name) }}</h6>
                    </div>

                    <div class="col-md-4 text-right">
                        <small class="verde font-weight-bold">{{ __('CIF') }}:</small>
                        <h6>{{ e($oferta->cif) }}</h6>
                    </div>


                    <div class="col-md-4 ">
                        <small class=" font-weight-bold verde">{{ __('Socios') }}:</small>
                        <h6>{{ e($oferta->socios) }}</h6>
                    </div>

                    <div class="col-md-4 ">
                        <small class=" font-weight-bold verde">{{ __('Empleados') }}:</small>
                        <h6>{{ e($oferta->empleados) }}</h6>
                    </div>

                    <div class="col-md-4 text-right">
                        <small class=" font-weight-bold verde">{{ __('Año') }}:</small>
                        <h6>{{ e($oferta->año) }}</h6>
                    </div>


                    <div class="col-md-12">
                        <hr class=" verde">
                        <small class=" font-weight-bold verde">{{ __('Motivo') }}:</small>
                        <h6>{{ e($oferta->motivo) }}</h6>
                    </div>

                    <div class="col-md-12">
                        <small class=" font-weight-bold verde">{{ __('Sector') }}:</small>
                        <h6>{{ e($oferta->sector->name) }}</h6>
                    </div>

                    <div class="col-md-12 ">
                        <small class=" font-weight-bold verde">{{ __('Local') }}:</small>
                        <h6>{{ ($oferta->local)? 'Si':'No' }}</h6>
                    </div>

                    <div class="col-md-12">
                        <hr class=" verde">
                        <small class=" font-weight-bold verde">{{ __('Direccion') }}:</small>
                        <h6>{{ e($oferta->address) }}, {{ e($oferta->poblacion->name) }} ({{ e($oferta->provincia->name) }})</h6>
                    </div>

                    <div class="col-md-12">
                        <small class=" font-weight-bold verde">{{ __('Página web') }}:</small>
                        <a href="{{ e($oferta->web) }}" class="link text-muted" target="_blank">
                            <h6>{{ e($oferta->web) }}</h6>
                        </a>
                        <hr class=" verde">
                    </div>

                    <div class="col-md-4 ">
                        <small class=" font-weight-bold verde">{{ __('Explotación 1') }}:</small>
                        <h6>{{ e($oferta->explotacion1) }}</h6>
                    </div>

                    <div class="col-md-4 ">
                        <small class=" font-weight-bold verde">{{ __('Explotación 2') }}:</small>
                        <h6>{{ e($oferta->explotacion2) }}</h6>
                    </div>

                    <div class="col-md-4 ">
                        <small class=" font-weight-bold verde">{{ __('Explotación 3') }}:</small>
                        <h6>{{ e($oferta->explotacion3) }}</h6>
                    </div>

                    <div class="col-md-12">
                        <hr class=" verde">
                        <small class=" font-weight-bold verde">{{ __('Valoracion') }}:</small>
                        <h6>{{ e($oferta->valoracion) }} €</h6>
                    </div>

                    <div class="col-md-12">
                        <small class=" font-weight-bold verde">{{ __('Endeudamiento') }}:</small>
                        <h6 class="text-danger">{{ e($oferta->endeudamiento) }} €</h6>
                    </div>
                </div>
                <hr class="m-0 verde">

                <div class="card-body row">

                    <div class="col-md-12 ">
                        <small class="verde">{{ __('Contacto') }}:</small>
                        <h6><i class="ti-user"></i> {{ e($oferta->contactFullName) }}</h6>
                    </div>

                    <div class="col-md-6 ">
                        <small class="verde">{{ __('Email') }}:</small>
                        <a href="mailto:{{ e($oferta->contactEmail) }}" class="link text-muted" target="_blank">
                            <h6><i class="ti-email"></i> {{ e($oferta->contactEmail) }}</h6>
                        </a>
                    </div>

                    <div class="col-md-6 ">
                        <small class="verde">{{ __('Teléfono') }}:</small>
                        <h6><i class="ti-mobile"></i> {{ e($oferta->contactPhone) }}</h6>
                    </div>
                </div>

                <hr class="m-0">
            </div>

        </div>
        <!-- Column -->
        <!-- Column -->

        <div class="col-lg-6 col-xlg-7 ">

            @include('dashboard.alertas')

            <div class="card">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs profile-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link @if($tab=='modificar') active show @endif" data-toggle="tab" href="#modificar" role="tab">{{ __('Oferta') }}</a>
                    </li>
                    @if ($isAdmin || $isAsesor)
                    <li class="nav-item">
                        <a class="nav-link @if($tab=='asociacion') active show @endif" data-toggle="tab" href="#asociacion" role="tab">
                            {{ ($isAdmin)? __('Asociación') : __('Gestor') }}
                        </a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link @if($tab=='empresa') active show @endif" data-toggle="tab" href="#empresa" role="tab">{{ __('Empresa') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if($tab=='contacto') active show @endif" data-toggle="tab" href="#contacto" role="tab">{{ __('Contacto') }}</a>
                    </li>

                    @if ($oferta->inversores->count()>0)
                    <li class="nav-item">
                        <a class="nav-link @if($tab=='inversores') active show @endif" data-toggle="tab" href="#inversores" role="tab">{{ __('Inversores') }}</a>
                    </li>
                    @endif
                    @if ($isAdmin)
                    <li class="nav-item">
                        <a class="nav-link @if($tab=='estado') active show @endif" data-toggle="tab" href="#estado" role="tab">
                            {{ __('Estado') }}
                        </a>
                    </li>
                    @endif
                </ul>

                <!-- Tab panes -->


                <div class="tab-content">


                    <div class="tab-pane  @if($tab=='modificar') active @endif" id="modificar" role="tabpanel">

                        <div class="card-body bg-info mt-3">
                            <h4 class="text-white card-title">{{ __('Datos de la oferta') }}</h4>
                            <h6 class="card-subtitle text-white m-b-0 op-5">{{ __('Modifica los datos de la oferta') }}</h6>
                        </div>

                        <div class="card-body">

                            <form method="POST" class="" action="{{ action('Dashboard\OfertasController@update', ['id' => $oferta->id,'tab'=>'modificar'])}}">
                                @csrf @method('PUT')
                                <input type="hidden" name="tab" value="modificar">
                                @include('dashboard.ofertas.formulario.basico')

                                <div class="row">

                                    <div class="col-md-12">

                                        <div class="form-group">
                                            <button class="btn btn-verde waves-effect waves-light">{{ __('Modificar Oferta') }}</button>
                                            <a href="{{ e(route('dashboardOfertas')) }}" class="btn btn-inverse waves-effect waves-light">{{ __('Cancelar') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="tab-pane  @if($tab=='empresa') active @endif" id="empresa" role="tabpanel">

                        <div class="card-body bg-info mt-3">
                            <h4 class="text-white card-title">{{ __('Datos de la empresa') }}</h4>
                            <h6 class="card-subtitle text-white m-b-0 op-5">{{ __('Modifica los datos de la empresa') }}</h6>
                        </div>

                        <div class="card-body">
                            <form method="POST" class="" action="{{ action('Dashboard\OfertasController@update', ['id' => $oferta->id])}}">
                                @csrf @method('PUT')
                                <input type="hidden" name="tab" value="empresa">
                                @include('dashboard.ofertas.formulario.empresa')

                                <div class="row">

                                    <div class="col-md-12">

                                        <div class="form-group">
                                            <button class="btn btn-verde waves-effect waves-light">{{ __('Modificar datos de Empresa') }}</button>
                                            <a href="{{ e(route('dashboardOfertas')) }}" class="btn btn-inverse waves-effect waves-light">{{ __('Cancelar') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    @if ($isAdmin || $isAsesor)

                    <div class="tab-pane  @if($tab=='asociacion') active @endif" id="asociacion" role="tabpanel">

                        <div class="card-body bg-info mt-3">
                            <h4 class="text-white card-title">{{ __('Gestor de la oferta') }}</h4>
                            <h6 class="card-subtitle text-white m-b-0 op-5">{{ __('Modifica la persona encargada de gestionar la oferta') }}</h6>
                        </div>

                        <div class="card-body">
                            <form method="POST" class="" action="{{ action('Dashboard\OfertasController@update', ['id' => $oferta->id])}}">
                                @csrf @method('PUT')
                                <input type="hidden" name="tab" value="asociacion">
                                @include('dashboard.ofertas.formulario.gestor')

                                <div class="row">

                                    <div class="col-md-12">

                                        <div class="form-group">
                                            <button class="btn btn-verde waves-effect waves-light">{{ __('Modificar Gestor') }}</button>
                                            <a href="{{ e(route('dashboardOfertas')) }}" class="btn btn-inverse waves-effect waves-light">{{ __('Cancelar') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endif

                    <div class="tab-pane  @if($tab=='contacto') active @endif" id="contacto" role="tabpanel">

                        <div class="card-body bg-info mt-3">
                            <h4 class="text-white card-title">{{ __('Datos de contacto') }}</h4>
                            <h6 class="card-subtitle text-white m-b-0 op-5">{{ __('Modifica los datos de la persona de contacto de la empresa') }}</h6>
                        </div>

                        <div class="card-body">
                            <form method="POST" class="" action="{{ action('Dashboard\OfertasController@update', ['id' => $oferta->id,'tab'=>'contacto'])}}">
                                @csrf @method('PUT')
                                <input type="hidden" name="tab" value="contacto">
                                @include('dashboard.ofertas.formulario.contacto')

                                <div class="row">

                                    <div class="col-md-12">

                                        <div class="form-group">
                                            <button class="btn btn-verde waves-effect waves-light">{{ __('Modificar datos de Contacto') }}</button>
                                            <a href="{{ e(route('dashboardOfertas')) }}" class="btn btn-inverse waves-effect waves-light">{{ __('Cancelar') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>

                    @if ($isAdmin)

                    <div class="tab-pane  @if($tab=='estado') active @endif" id="estado" role="tabpanel">

                        <div class="card-body bg-info mt-3">
                            <h4 class="text-white card-title">{{ __('Estado de la oferta') }}</h4>
                            <h6 class="card-subtitle text-white m-b-0 op-5">{{ __('Activa o desactiva el estado de la oferta para que aparezca en listado') }}</h6>
                        </div>

                        <div class="card-body">
                            <form method="POST" class="" action="{{ action('Dashboard\OfertasController@updateEstado', ['id' => $oferta->id])}}">
                                @csrf @method('PUT')

                                <div class="row">

                                    <div class="col-md-12">

                                        <div class="form-group ">
                                            <label for="approved" class=" col-form-label ">{{ __('Estado') }}</label>
                                            <select name="approved" id="approved" class="form-control form-control-line {{ $errors->has('approved') ? ' form-control-danger' : '' }}" required>
                                                <option value="1" @if ( $oferta->approved) selected @endif>{{ __('Aprobada') }}</option>
                                                <option value="0" @if (! $oferta->approved) selected @endif>{{ __('NO Aprobada') }}</option>
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

                    @if ($oferta->inversores->count()>0)

                    <div class="tab-pane  @if($tab=='inversores') active @endif" id="inversores" role="tabpanel">

                        <div class="card">

                            <div class="card-body bg-info mt-3">
                                <h4 class="text-white card-title">{{ __('Inversores') }}</h4>
                                <h6 class="card-subtitle text-white m-b-0 op-5">{{ __('Los inversores de la asociación') }}</h6>
                            </div>

                            <div class="card-body">

                                <div class="message-box contact-box">

                                    <div class="message-widget contact-widget">
                                        @foreach ($oferta->inversores as $inversor)
                                        <?php
                                                $usuarioRole= $inversor->roles->first()->name;
                                            ?>

                                        <div class="card m-b-0">
                                            <a href="#collapse{{ $inversor->id }}" class="card-header text-decoration-none" id="heading11" role="button" aria-expanded="false" aria-controls="collapse{{ $inversor->id }}" data-toggle="collapse" data-target="#collapse{{ $inversor->id }}">

                                                <div class="user-img">
                                                    <h6>
                                                        <span class="round role{{ substr($usuarioRole,0,2) }}">{{ substr($usuarioRole,0,1) }}</span>
                                                        <span class="profile-status {{ $inversor->statusClass() }} pull-right"></span>
                                                    </h6>
                                                    </span>
                                                </div>

                                                <div class="mail-contnet">
                                                    <h5>{{ e( $inversor->name.' '. $inversor->surname) }} </h5> <span class="mail-desc">{{ e( $inversor->email) }}</span>
                                                </div>

                                            </a>

                                            <div id="collapse{{ $inversor->id }}" class="collapse" aria-labelledby="heading11" style=" ">

                                                <div class="card-body ">

                                                    <div class="row">

                                                        <div class="col-md-6">
                                                            <small class="text-muted">{{ __('Nombre') }}</small>
                                                            <h6>{{ e( $inversor->name.' '. $inversor->surname) }}</h6>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <small class="text-muted">{{ __('Email') }}</small>
                                                            <h6>{{ e( $inversor->email) }}</h6>
                                                        </div>
                                                    </div>

                                                    <div class="row">

                                                        <div class="col-md-6">
                                                            <small class="text-muted p-t-30 db">{{ __('Teléfono') }}</small>
                                                            <h6>{{ e( $inversor->phone) }}</h6>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <small class="text-muted p-t-30 db">{{ __('Estado') }}</small>
                                                            <span class=" badge {{ $inversor->statusClass() }} text-white">{{ $inversor->statusName() }}</span>
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
                    </div>
                    @endif
                </div>


            </div>
        </div>
    </div>
    <!-- Column -->
</div>

</div>
@endsection

@section('scripts') {{--
<script src="{{ asset( 'js/dashboard/plugins/select2/dist/js/select2.full.min.js') }} " type="text/javascript "></script> --}} {{--
<script src="{{ asset( 'js/dashboard/plugins/switchery/dist/switchery.min.js') }} "></script>
<script src="{{ asset( 'js/dashboard/plugins/bootstrap-select/bootstrap-select.min.js') }} " type="text/javascript "></script>
<script src="{{ asset( 'js/dashboard/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }} "></script>
<script src="{{ asset( 'js/dashboard/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js') }} " type="text/javascript "></script>
<script src="{{ asset( 'js/dashboard/plugins/dff/dff.js') }} " type="text/javascript "></script>
<script type="text/javascript " src="{{ asset( 'js/dashboard/plugins/multiselect/js/jquery.multi-select.js') }} "></script> --}}


<script>
    $(function () {
        // For select 2
        $(".alert-success ").fadeTo(5000, 500).slideUp(500, function () {
            $(".alert-success ").slideUp(500);
        });
        // $('.selectpicker').selectpicker();
    });

</script>
@if($isAdmin)
<script>
    $('#asociacion_id').on('blur change load', function (e) {
        $.ajax({
            url: "{{ route( 'searchUsuariosByAsociacion') }} ",
            type: 'POST',
            data: {
                "_token ": "{{ csrf_token() }} ",
                "asociacion ": $('#asociacion_id').val()
            },
            success: function (data) {
                var toAppend = '';
                if (data.status && Object.keys(data.usuarios).length > 0) {
                    toAppend += '<option value=" ">Selecciona Usuario</option>';
                    $('#user_id').prop('disabled', false);
                    $.each(data.usuarios, function (i, o) {
                        toAppend += '<option value=" ' + i + ' ">' + o + '</option>';
                    });
                } else {
                    toAppend += '<option value=" ">No hay usuarios</option>';
                    $('#user_id').prop('disabled', true);
                }

                $('#user_id').html(toAppend);
            }
        });
    });

</script>
@endif
<script>
    $('#provincia_id').on('blur change', function (e) {
        $.ajax({
            url: "{{ route('searchpoblacionesbyprovincia') }}",
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                "provincia_id": $('#provincia_id').val()
            },
            success: function (data) {
                var toAppend = '';
                if (data.status && Object.keys(data.poblaciones).length > 0) {
                    toAppend += '<option value="">Selecciona población</option>';
                    $('#poblacion_id').prop('disabled', false);
                    $.each(data.poblaciones, function (i, o) {
                        toAppend += '<option value="' + i + '">' + o + '</option>';
                    });
                } else {
                    toAppend += '<option value="">No hay poblaciones</option>';
                    $('#poblacion_id').prop('disabled', true);
                }

                $('#poblacion_id').html(toAppend);
            }
        });
    });

</script>
@endsection
