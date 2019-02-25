@extends('layouts.dashboard')
@section('content')

<div class="container-fluid">

    <div class="row">

        <div class="col-md-12">
            @include('dashboard.alertas')

            <div class="card">

                <div class="card-body">
                    <h4 class="card-title mb-0 title-section">
                        <span class="lstick"></span> {{ __('Listado de Ofertas')}}
                        <a href="{{ e(route('dashboardOfertasNueva')) }}" class="btn btn-verde btn-sm float-right"><i class="fas fa-plus-circle text-white"></i> {{ __('Nueva')}}</a>
                    </h4>
                </div>

                <hr class="mt-0">

                <div class="card-body">
                    <form method="POST" class="" action="{{ e(route('dashboardOfertas')) }}" id="formSearch">
                        @csrf @method('POST')

                        <input type="hidden" name="search" value="1">


                        <?php
                        use Carbon\Carbon; ?>

                        <div class="table-responsive ">
                            <table class="table table-striped table-hover tabla-usuarios">
                                <thead>
                                    <tr>
                                        <th colspan="2">@sortablelink('name', __('Nombre'),[],['class'=>'text-nowrap'])<br>
                                            <input name="name" id="name" class=" typeahead" type="text" value="{{ (!empty($busqueda)) ? $busqueda->input('name') : '' }}" placeholder="{{ __('Nombre') }}">
                                        </th>
                                        <th>@sortablelink('cif', __('CIF'),[],['class'=>'text-nowrap'])<br>
                                            <input name="cif" id="cif" class="" type="text" value="{{ (!empty($busqueda)) ? $busqueda->input('cif') : '' }}" placeholder="{{ __('CIF') }}">
                                        </th>
                                        <th>
                                            @sortablelink('provincia', __('Provincia'),[],['class'=>'text-nowrap'])<br>
                                            <select name="provincia_id" id="provincia_id" class="">
                                                <option value="">{{ __('Todas') }}</option>
                                                @foreach ($provincias as $provincia)
                                                <option value="{{ $provincia->id }}" @if ( (!empty($busqueda)) && $provincia->id==$busqueda->input('provincia_id'))
                                                    selected
                                                    @endif
                                                    class="">{{$provincia->name }}</option>
                                                @endforeach
                                            </select>
                                        </th>
                                        @if ($isAdmin)
                                        <th>
                                            @sortablelink('asociacion', __('Asociación'),[],['class'=>'text-nowrap'])<br>
                                            <select name="asociacion_id" id="asociacion_id" class="">
                                                <option value="">{{ __('Todas') }}</option>
                                                @foreach ($asociaciones as $asociacion)
                                                <option value="{{ $asociacion->id }}" @if ( (!empty($busqueda)) && $asociacion->id==$busqueda->input('asociacion_id'))
                                                    selected
                                                    @endif
                                                    class="">{{$asociacion->name }}</option>
                                                @endforeach
                                            </select>
                                        </th>
                                        @endif
                                        <th class="text-right">
                                            @sortablelink('created_at', __('Fecha'),[],['class'=>'text-nowrap'])
                                        </th>
                                        <th class="text-right">
                                            @sortablelink('valoracion', __('Precio'),[],['class'=>'text-nowrap'])
                                        </th>
                                        <th>

                                            <div class="btn-group btn-group-toggle">
                                                <button type="submit" class="btn btn-verde-alt  btn-sm">{{ __('Buscar') }}</button>
                                                <button type="button" class="btn btn-secondary btn-sm" id="btnreset">{{ __('Todas') }}</button>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($ofertas->isNotEmpty()) @foreach ($ofertas as $oferta)
                                    <tr>
                                        <td scope="col">
                                            @if ($oferta->approved)
                                            <i class="mdi mdi-check-circle text-success" style="font-size:1.5em;"> </i>
                                            @else <i class="mdi mdi-alert-circle text-danger" style="font-size:1.5em;"></i>
                                            @endif


                                        </td>
                                        <td>
                                            {{ e($oferta->name) }}
                                        </td>
                                        <td>{!! e($oferta->cif) !!}</td>
                                        <td>{!! e($oferta->provincia->name) !!}</td>
                                        @if ($isAdmin)
                                        <td>{!! e($oferta->asociacion->name) !!}</td>
                                        @endif
                                        <td class="text-right  text-nowrap">
                                            {!! e($oferta->created_at->format('d-m-Y')) !!}
                                        </td>
                                        <td class="text-right text-nowrap">
                                            {!! e($oferta->valoracion." €") !!}
                                        </td>
                                        <td class="text-right">
                                            @if (in_array($oferta->id,$notificaciones))
                                            <i class="mdi mdi-star text-warning float-left"></i> @endif
                                            <a href="<?php echo urldecode(route('dashboardOferta',['oferta'=>$oferta])); ?>" class="text-verde" title="{{ __('Ver') }}">
                                                <i class="fas fa-eye text-verde"></i>
                                            </a>
                                            <a href="#" title="{{ __('Eliminar') }}" data-toggle="tooltip" data-original-title="{{ __('Borrar') }}" class="borraroferta" data-toggle="modal" data-url="<?php echo urldecode(route('dashboardOfertaDelete',['oferta'=>$oferta])); ?>" data-id="{{$oferta->id}}" data-name="{{$oferta->name}}" data-target="#custom-width-modal"><i class="fas fa-window-close text-danger"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach @else
                                    <tr>
                                        <td colspan="{{ ($isAdmin)? 8:7 }}">
                                            <p>{{ __('No hay resultados disponibles') }}</p>
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5">{{ $ofertas->appends(request()->query())->links() }}</td>
                                        <td colspan="{{ ($isAdmin)? 3:2 }}" class="text-right">
                                            @if ($ofertas->total()>=1)
                                            <small>
                                                <strong>
                                                    {{ $ofertas->total() }}
                                                </strong>
                                                @if ($ofertas->total()>=1)
                                                {{ __(' Ofertas encontradas') }}
                                                @elseif($ofertas->total()==1)
                                                {{ __(' Oferta encontrada') }}
                                                @endif
                                            </small> @endif
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>

<!-- Delete Model -->
<form method="POST" class="form-control-line form-material" action="" id="formBorrar">
    @csrf @method('POST')
    <input type="hidden" value="" name="oferta_id_borrar" id="oferta_id_borrar">

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
{{-- <script src="{{ asset('js/bootstrap3-typeahead.min.js') }}" type="text/javascript"></script> --}}
<script>
    $(document).on('click', '.borraroferta', function (e) {
        e.preventDefault();
        $('#texto-modal-borrar').html('Seguro que deseas borrar la asociación' + ' <strong>' + $(this).data('name') + ' </strong>');
        $('#oferta_id_borrar').val($(this).data('id'));
        $('#BotonEliminar').on('click', function (e) {
            e.preventDefault();
            $('#formBorrar').attr('action', "/dashboard/ofertas/delete/" + $('#oferta_id_borrar').val());
            $('#formBorrar').submit();
            $form = '';
        });
        $('#borrar-modal').modal('show');
        // do anything else you need here
    });

    var path = "{{ route('searchOfertas') }}";
    // $('input.typeahead').typeahead({
    //     autoSelect: false,
    //     highlight: true,
    //     source: function (query, process) {
    //         return $.get(path, {
    //             query: query
    //         }, function (data) {
    //             return process(data);
    //             console.log(data, process(data));
    //         });
    //     }
    //     // }).on('blur change enterKey', function (e) {
    // }).on('enterKey', function (e) {
    //     // e.preventDefault();
    //     $('#formSearch').attr('action', "{{ route('dashboardOfertas') }}?search=" + $(this).val());
    //     $('#formSearch').submit();
    //     $form = '';
    // });
    $("#btnreset").click(function () {
        $("#formSearch").trigger("reset");
        $("#formSearch :input,#formSearch select").not('#formSearch input[type="hidden"]').val('');
        $("#formSearch").submit();
    });

</script>
@endsection
