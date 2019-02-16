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
                    <form class="" action="{{ action('dashboard\OfertasController@store')}}">
                        @csrf @method('PUT') {{-- SOLO SI ES ADMIN --}}
    @include('dashboard.ofertas.formulario')

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button class="btn btn-success">{{ __('Crear Asociación') }}</button>
                                    <a href="{{ e(route('dashboardOfertas')) }}" class="btn btn-inverse waves-effect waves-light">{{ __('Cancelar') }}</a>
                                </div>
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

<script>
    @if(Auth::user()->hasRole(['Admin']))
    $('#asociacion_id').on('blur change',function(e) {
        $.ajax({
            url: "{{ route('searchUsuariosByAsociacion') }}",
            type: 'POST',
            data:{
                "_token": "{{ csrf_token() }}",
                "asociacion": $('#asociacion_id').val()
                },
            success: function ( data) {
                var toAppend = '';
                    if(data.status && Object.keys(data.usuarios).length>0 ){
                        toAppend += '<option value="">{{ __('Selecciona Usuario') }}</option>';
                        $('#user_id').prop('disabled', false);
                        $.each(data.usuarios,function(i,o){
                            toAppend += '<option value="'+i+'">'+o+'</option>';
                        });
                    }else{
                        toAppend += '<option value="">{{ __('No hay usuarios') }}</option>';
                        $('#user_id').prop('disabled', true);
                    }


                $('#user_id').html(toAppend);
            }
        });
    });
    @endif

</script>
@endsection
