@extends('layouts.dashboard')
@section('content')

<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">
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
                <div class="card-body">
                    <div class="d-flex no-block">
                        <div>
                            <h4 class="card-title"><span class="lstick"></span>Listado ofertas</h4>
                        </div>
                    </div>
                    <form method="POST" class="" action="" id="formSearch">
                        @csrf @method('POST')
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
                                    <th>@sortablelink('name', __('Oferta'))</th>
                                    <th>@sortablelink('asociaciones', __('Asociación'))</th>
                                    <th>@sortablelink('inversores_count', __('Inversores'))</th>
                                    <th>@sortablelink('created_at', __('Fecha'))</th>
                                    <th>@sortablelink('active', __('Estado'))</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($ofertas->isNotEmpty()) @foreach ($ofertas as $oferta)
                                <tr>
                                    <td># {!! e($oferta->id) !!}</td>
                                    <td>
                                        <h6>{{ e($oferta->name) }}</h6><small class="text-muted">{{ e($oferta->address) }}</small>
                                    </td>
                                    <td> <span class="badge badge-primary">{{ e($oferta->asociacion->name) }}</span></td>
                                    <td>{{ e($oferta->inversores_count) }}</td>
                                    <td>{{ e($oferta->created_at->format('d/m/Y')) }}</td>
                                    <td>
                                        @if($oferta->active)
                                        <span class="badge badge-success">{{ __('Activa') }}</span> @else
                                        <span class="badge badge-secondary">{{ __('Inactiva') }}</span> @endif
                                    </td>
                                    <td class="text-nowrap">
                                        <a href="<?php echo urldecode(route('dashboardOferta',['oferta'=>$oferta])); ?>" data-toggle="tooltip" data-original-title="{{ __('Ver') }}"> <i class="fas fa-pencil-alt text-inverse m-r-10"></i> </a>
                                        <a href="#" data-toggle="tooltip" data-original-title="{{ __('Borrar') }}" class="borraroferta" data-toggle="modal" data-url="<?php echo urldecode(route('dashboardOfertaDelete',['oferta'=>$oferta])); ?>"
                                            data-id="{{$oferta->id}}" data-name="{{$oferta->name}}" data-target="#custom-width-modal"> <i class="fas fa-window-close text-danger"></i> </a>
                                    </td>

                                </tr>
                                @endforeach @else
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
                                        @if ($ofertas->count()>1)
                                        <small>
                                                <strong>
                                                    {{ $ofertas->total() }}
                                                    </strong>
                                                    @if ($ofertas->total()>1)
                                                        {{ __(' ofertas encontradas') }}
                                                    @elseif($ofertas->total()==1)
                                                        {{ __(' asociación encontrada') }}
                                                    @endif
                                                </small> @endif
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    {{ $ofertas->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Delete Model -->
<form method="POST" class="form-control-line form-material" action="" id="formBorrar">
    @csrf @method('POST')
    <input type="hidden" value="" name="oferta_id_borrar" id="oferta_id_borrar">
    <div id="borrar-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true"
        style="display: none;">
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
    $(document).on('click', '.borraroferta', function (e) {
    e.preventDefault();
    $('#texto-modal-borrar').html('{{ __('Seguro que deseas borrar la asociación') }}'+' <strong>'+ $(this).data('name')+' </strong>');
    $('#oferta_id_borrar').val($(this).data('id'));
    $('#BotonEliminar').on('click', function(e) {
        e.preventDefault();
        $('#formBorrar').attr('action',"/dashboard/ofertas/delete/"+$('#oferta_id_borrar').val());
        $('#formBorrar').submit();
        $form = '';
    });
    $('#borrar-modal').modal('show');
    // do anything else you need here
    });

    var path = "{{ route('searchOfertas') }}";
    $('input.typeahead').typeahead({
        autoSelect: false,
        highlight: true,
        source:  function (query, process) {
        return $.get(path, { query: query }, function (data) {
                return process(data);
            });
        }
    }).on('blur change enterKey',function(e) {
        // e.preventDefault();
        $('#formSearch').attr('action',"{{ route('dashboardOfertas') }}?search="+$(this).val());
        $('#formSearch').submit();
        $form = '';
    });

</script>
@endsection
