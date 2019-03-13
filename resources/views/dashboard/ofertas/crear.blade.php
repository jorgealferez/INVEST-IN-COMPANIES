@extends('layouts.dashboard')
@section('content')

<form class="" action="{{ action('Dashboard\OfertasController@store')}}">

    <div class="container-fluid">

        @include('dashboard.alertas')

        <div class="row">
            @csrf @method('PUT') {{-- SOLO SI ES ADMIN --}}

            <div class="col-lg-8 col-xlg-9 col-md-7">

                <div class="card">

                    <div class="card-body">

                        <h4 class="card-title mb-0 title-section">
                            <i class="mdi mdi-tag-multiple"></i>
                            {{ __('Nueva oferta')}}
                        </h4>
                    </div>
                    <hr class="mt-0">

                    <div class="card-body">
                        @include('dashboard.ofertas.formulario.basico')

                        <h3 class="card-title m-t-40">{{ __('Datos de la empresa') }}</h3>
                        <hr>

                        @include('dashboard.ofertas.formulario.empresa')

                        <div class="row">

                            <div class="col-md-12">

                                <div class="form-group">
                                    <button class="btn btn-verde  waves-effect waves-light">{{ __('Crear Oferta') }}</button>
                                    <a href="{{ e(route('dashboardOfertas')) }}" class="btn btn-inverse waves-effect waves-light">{{ __('Cancelar') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-xlg-3 col-md-5">
                @if($isAdmin || $isAsesor)

                <div class="card">

                    <div class="card-body bg-verde">
                        <h4 class="text-white card-title">{{ __('Gestión de la oferta') }}</h4>
                        <h6 class="card-subtitle text-white m-b-0 op-5">Selecciona el usuario que gestionará la oferta</h6>
                    </div>

                    <div class="card-body">

                        @include ('dashboard.ofertas.formulario.gestor')
                    </div>
                </div>
                @endif

                <div class="card">

                    <div class="card-body bg-verde">
                        <h4 class="text-white card-title">{{ __('Información de contacto') }}</h4>
                        <h6 class="card-subtitle text-white m-b-0 op-5">Información de contacto de la empresa ofertada</h6>
                    </div>

                    <div class="card-body">

                        @include ('dashboard.ofertas.formulario.contacto')
                    </div>
                </div>
            </div>
        </div>

    </div>
</form>
@endsection

@section('scripts')

@if($isAdmin)
<script>
    $('#asociacion_id').on('blur change', function (e) {
        $.ajax({
            url: "{{ route('searchUsuariosByAsociacion') }}",
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                "asociacion": $('#asociacion_id').val()
            },
            success: function (data) {
                var toAppend = '';
                if (data.status && Object.keys(data.usuarios).length > 0) {
                    toAppend += '<option value="">Selecciona usuario</option>';
                    $('#user_id').prop('disabled', false);
                    $.each(data.usuarios, function (i, o) {
                        toAppend += '<option value="' + i + '">' + o + '</option>';
                    });
                } else {
                    toAppend += '<option value="">No hay usuarios</option>';
                    $('#user_id').prop('disabled', true);
                }
                $('#user_id').html(toAppend);
            }
        });
    });

</script>
@endif
<script>
    $('#provincia_id').on('change', function (e) {
        $('#poblacion_id').html('<option>Cargando...</option>');
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
