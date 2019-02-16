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
                        <h4 class="card-title">{{ e($oferta->name) }}</h4>
                        <h6 class="card-subtitle">@jamesandre</h6>
                        <p class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt </p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">

                    <small class="text-muted">Email</small>
                    <h6>{!! e($oferta->email) !!}</h6>

                    <small class="text-muted p-t-30 db">Teléfono</small>
                    <h6>{{ e($oferta->phone) }}</h6>

                    <small class="text-muted p-t-30 db">Dirección</small>
                    <h6>{{ e($oferta->address) }}</h6>

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
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                         <span aria-hidden="true">×</span>
                     </button> {!! session('mensaje') !!}
            </div>
            @endif @if (session()->has('error'))
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                         <span aria-hidden="true">×</span>
                        </button> {!! session('mensaje') !!}
            </div>
            @endif
            <div class="card">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs profile-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link @if($tab=='modificar') active show @endif" data-toggle="tab" href="#modificar" role="tab">Modificar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if($tab=='inversores') active show @endif" data-toggle="tab" href="#inversores" role="tab">Inversores</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane  @if($tab=='modificar') active @endif" id="modificar" role="tabpanel">
                        <div class="card-body">
                            <form method="POST" class="" action="{{ action('dashboard\OfertasController@update', ['id' => $oferta->id])}}">
                                @csrf @method('PUT') {{-- SOLO SI ES ADMIN --}}
    @include('dashboard.ofertas.formulario')

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button class="btn btn-success">{{ __('Modificar Oferta') }}</button>
                                            <a href="{{ e(route('dashboardOfertas')) }}" class="btn btn-inverse waves-effect waves-light">{{ __('Cancelar') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane  @if($tab=='inversores') active @endif" id="inversores" role="tabpanel">
                        <div class="card">
                            <div class="card-body bg-info">
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
                                                <a href="#collapse{{ $inversor->id }}" class="card-header text-decoration-none" id="heading11" role="button" aria-expanded="false"
                                                    aria-controls="collapse{{ $inversor->id }}" data-toggle="collapse" data-target="#collapse{{ $inversor->id }}">
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
    $(function() {
        // For select 2
        $(".select2 ").select2();
        $(".alert-success ").fadeTo(5000, 500).slideUp(500, function(){
            $(".alert-success ").slideUp(500);
        });
        // $('.selectpicker').selectpicker();
    });
    @if(Auth::user()->hasRole(['Admin']))
        $('#asociacion_id').on('blur change load',function(e) {
            $.ajax({
                url: "{{ route( 'searchUsuariosByAsociacion') }} ",
                type: 'POST',
                data:{
                    "_token ": "{{ csrf_token() }} ",
                    "asociacion ": $('#asociacion_id').val()
                    },
                success: function ( data) {
                    var toAppend = '';
                    if(data.status && Object.keys(data.usuarios).length>0 ){
                        toAppend += '<option value=" ">{{ __('Selecciona Usuario') }}</option>';
                        $('#user_id').prop('disabled', false);
                        $.each(data.usuarios,function(i,o){
                            toAppend += '<option value=" '+i+' ">'+o+'</option>';
                        });
                    }else{
                        toAppend += '<option value=" ">{{ __('No hay usuarios') }}</option>';
                        $('#user_id').prop('disabled', true);
                    }

                    $('#user_id').html(toAppend);
                }
            });
        });
        @endif

</script>
@endsection
