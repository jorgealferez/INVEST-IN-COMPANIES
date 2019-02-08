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
                    <form method="POST" class="" action="" id="formSearch">
                            @csrf
                            @method('POST')
                            <div class="dataTables_filter">
                                <label>{{ __('Buscar') }}
                                    <input type="search" class="form-control typeahead" type="text" value="{{  $busqueda }}">
                                </label>
                            </div>
                            
                    </form>
                    <div class="table-responsive m-t-20 ">
                        <table class="table stylish-table">
                            <thead>
                                <tr>
                                    <th>@sortablelink('id', __('Id'))</th>
                                    <th>@sortablelink('name', __('Asociación'))</th>
                                    <th>{{ __('Ofertas') }}</th>
                                    <th>@sortablelink('created_at', __('Fecha'))</th>
                                    <th>@sortablelink('active', __('Estado'))</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($asociaciones->isNotEmpty())
                                    @foreach ($asociaciones as $asociacion)
                                    <tr>
                                        <td># {!! e($asociacion->id) !!}</td>
                                        <td>
                                            <h6>{{ e($asociacion->name) }}</h6><small class="text-muted">{{ e($asociacion->address) }}</small>
                                        </td>
                                        <td></td>
                                        <td>{{ e($asociacion->created_at->format('d/m/Y')) }}</td>
                                        <td>
                                            @if($asociacion->active)
                                                <span class="badge badge-success">{{ __('Activa') }}</span>
                                            @else
                                                <span class="badge badge-secondary">{{ __('Inactiva') }}</span>
                                            @endif
                                        </td>
                                        <td class="text-nowrap">
                                                <a href="<?php echo urldecode(route('dashboardAsociacion',['asociacion'=>$asociacion])); ?>" data-toggle="tooltip" data-original-title="{{ __('Ver') }}"> <i class="fas fa-pencil-alt text-inverse m-r-10"></i> </a>
                                                <a href="#" data-toggle="tooltip" data-original-title="{{ __('Borrar') }}" class="borrarAsociacion" data-toggle="modal" data-url="<?php echo urldecode(route('dashboardAsociacionDelete',['asociacion'=>$asociacion])); ?>" data-id="{{$asociacion->id}}"  data-name="{{$asociacion->name}}" data-target="#custom-width-modal"> <i class="fas fa-window-close text-danger"></i> </a>
                                            </td>
                                       
                                    </tr>
                                    @endforeach
                                @else
                                <tr>
                                    <td colspan="5">
                                       <p>{{ __('No hay resultados disponibles') }}</p>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                            <tfoot>
                                    <tr>
                                        <td colspan="5" class="text-right">
                                            @if ($asociaciones->count()>1)
                                            <small>
                                                <strong>
                                                    {{ $asociaciones->count() }}
                                                    </strong>
                                                    @if ($asociaciones->count()>1)
                                                        {{ __(' asociaciones encontradas') }}
                                                    @elseif($asociaciones->count()==1)
                                                        {{ __(' asociación encontrada') }}
                                                    @endif
                                                </small>
                                            @endif
                                        </td>
                                    </tr>
                            </tfoot>
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
<script src="{{ asset('js/bootstrap3-typeahead.min.js') }}" type="text/javascript"></script>
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

    var path = "{{ route('searchAsociaciones') }}";
    $('input.typeahead').typeahead({
        autoSelect: false,
        highlight: true,
        source:  function (query, process) {
        return $.get(path, { query: query }, function (data) {
                return process(data);
            });
        }
    }).on('blur change',function(e) {
        // e.preventDefault();
        $('#formSearch').attr('action',"{{ route('dashboardAsociaciones') }}?search="+$(this).val());
        $('#formSearch').submit();
        $form = '';
    });


</script>

@endsection
