@extends('layouts.dashboard')
@section('content')

<div class="container-fluid">

    <div class="row">

        <div class="col-md-12">
            @include('dashboard.alertas')

            <div class="card">

                <div class="card-body card-seccion-ofertas">
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
                            <table class="table  table-hover tabla-usuarios">
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
                                    <tr class="@if(!$oferta->active) registro-eliminado @endif">
                                        <td>
                                            @if (in_array($oferta->id,$notificaciones))
                                            <span class="badge badge-success bg-warning" style="width:80px">
                                                {{ __('Nueva') }}</span>
                                            @elseif($oferta->approved)
                                            <span class="badge badge-success bg-success" style="width:80px">
                                                {{ __('Aprobada') }}</span>
                                            @else
                                            <span class="badge badge-success bg-danger" style="width:80px">
                                                {{ __('No aprobada') }}</span>
                                            @endif
                                        </td>
                                        <td>{{ e($oferta->name) }}
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

                                            <a href="<?php echo urldecode(route('dashboardOferta',['oferta'=>$oferta])); ?>" class="text-verde" title="{{ __('Ver') }}">
                                                <i class="fa fa-cog text-secondary" style="font-size:150%"></i>
                                            </a>
                                            @if($oferta->active)
                                            <a href="#" title="{{ __('Eliminar') }}" data-toggle="modal" data-original-title="{{ __('Borrar') }}" class="borraroferta " data-url="<?php echo urldecode(route('dashboardOfertaDelete',['oferta'=>$oferta])); ?>" data-id="{{$oferta->id}}" data-name="{{$oferta->name}}"  data-target="#borrarModal"><i class=" mdi mdi-close-circle text-danger" style="font-size:150%"></i></a>
                                            @endif
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

@include('dashboard.modalBorrar')
@endsection

@section('scripts')
<script>
    $(document).ready(function ($) {
        $('#borrarModal').on("show.bs.modal", function (event) {

            $('#texto-modal-borrar').html('Seguro que deseas borrar la oferta ' + ' <strong>' + $(event.relatedTarget).data('name') + ' </strong>');
            $('#id_borrar').val($(event.relatedTarget).data('id'));
            $('#BotonEliminar').on('click', function (e) {
                $('#formBorrar').attr('action', "/dashboard/ofertas/delete/" + $('#id_borrar').val());
                $('#formBorrar').submit();
                $form = '';
            });
        });
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
