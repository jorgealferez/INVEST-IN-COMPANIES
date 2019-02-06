@extends('layouts.dashboard')

@section('content')

<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">
            @if (session()->has('success'))
                <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                        {{ __('La asociación se ha eliminado correctamente') }}
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <div class="d-flex no-block">
                        <div>
                            <h4 class="card-title"><span class="lstick"></span>Listado Asociaciones</h4>
                        </div>
                    </div>
                    <div class="table-responsive m-t-20 no-wrap">
                        <table class="table vm no-th-brd pro-of-month">
                            <thead>
                                <tr>
                                    <th>Asociación</th>
                                    <th>Email</th>
                                    <th>Teléfono</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($asociaciones->isNotEmpty())
                                    @foreach ($asociaciones as $asociacion)
                                    <tr>
                                        <td>
                                            <h6>{{ e($asociacion->name) }}</h6><small class="text-muted">{{ e($asociacion->address) }}</small>
                                        </td>
                                        <td>{!! e($asociacion->email) !!}</td>
                                        <td>{{ e($asociacion->phone) }}</td>
                                        <td>
                                            <a href="<?php echo urldecode(route('dashboardAsociacion',['asociacion'=>$asociacion])); ?>" class="label label-success label-rounded">{{ __('Ver') }}</a>
                                           
                                            <a href="#" class="label label-danger label-rounded borrarAsociacion" data-toggle="modal" data-url="<?php echo urldecode(route('dashboardAsociacionDelete',['asociacion'=>$asociacion])); ?>" data-id="{{$asociacion->id}}"  data-name="{{$asociacion->name}}" data-target="#custom-width-modal">{{ __('Borrar') }}</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                <tr>
                                    <td colspan="4">
                                       <p>{{ __('No hay resultados disponibles') }}</p>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Delete Model -->
<form method="POST" class="form-control-line form-material" action="" id="formBorrar">
        @csrf
        @method('POST')
        <input type="hidden" value="" name="asociacion_id_borrar" id="asociacion_id_borrar">
    <div id="borrar-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" style="width:55%;">
            <div class="modal-content">
                <div class="modal-body">
                    <h4 id="texto-modal-borrar"></h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-dismiss="modal">{{ __('Cerrar') }}</button>
                    <button type="submit" class="btn btn-danger waves-effect waves-light" id="BotonEliminar">{{ __('Eliminar') }}</button>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection


@section('scripts')
<script>
$(document).on('click', '.borrarAsociacion', function (e) {
    e.preventDefault();
    $('#texto-modal-borrar').html('{{ __('Seguro que deseas borrar la asociación') }}'+' <strong>'+ $(this).data('name')+' </strong>');
    $('#asociacion_id_borrar').val($(this).data('id'));
    $('#BotonEliminar').on('click', function(e) {
        e.preventDefault();
        $('#formBorrar').attr('action',"/dashboard/asociaciones/delete/"+$('#asociacion_id_borrar').val());
        $('#formBorrar').submit();
        $form = '';
    });
    $('#borrar-modal').modal('show');
    // do anything else you need here
});

</script>

@endsection
