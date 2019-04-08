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
												<input name="name" id="name" class=" typeahead" type="text" value="{{ (!empty($busqueda)) ? $busqueda->input('name') : '' }}"
												 placeholder="{{ __('Nombre') }}">
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
												@sortablelink('asociacion', __('Entidad'),[],['class'=>'text-nowrap'])<br>
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

											<td class="text-left">
												@if (in_array($oferta->id, $notifiacionesOfertas->pluck('data')->pluck('oferta_id')->toArray()))
												<span class="badge badge-success bg-warning">
                                                {{ __('Nueva') }}</span> @elseif($oferta->approved)
												<span class="badge badge-success bg-success">
                                                {{ __('Aprobada') }}</span> @else
												<span class="badge badge-success bg-danger">
                                                {{ __('No aprobada') }}</span> @endif
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

												<div class="btn-group" role="group" aria-label="...">
													<a href="<?php echo urldecode(route('dashboardOferta',['oferta'=>$oferta])); ?>" data-toggle="tooltip" data-original-title="{{ __('Ver') }}"
													 class="btn btn-sm btn-secondary">
                                                    {{ __('Ver') }}
                                                </a> @if($oferta->active)
													<a href="#" title="{{ __('Eliminar') }}" data-toggle="modal" data-original-title="{{ __('Borrar') }}" class="btn btn-sm btn-danger borraroferta "
													 data-url="<?php echo urldecode(route('dashboardOfertaDelete',['oferta'=>$oferta])); ?>" data-id="{{$oferta->id}}"
													 data-name="{{$oferta->name}}" data-target="#borrarModal" data-borrar="1">
                                                    <i class="fa fas fa-trash"></i>
                                                </a> @else
													<a href="#" title="{{ __('Restablecer') }}" data-toggle="modal" data-borrar="0" data-original-title="{{ __('Restablecer') }}"
													 class="borraroferta btn btn-sm btn-success" data-url="<?php echo urldecode(route('dashboardOfertaDelete',['oferta'=>$oferta])); ?>"
													 data-id="{{$oferta->id}}" data-name="{{$oferta->name}}" data-target="#borrarModal">
                                                    <i class="fa  fas fa-undo-alt"></i>
                                                </a> @endif
												</div>
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

            if (!$(event.relatedTarget).data('borrar')) {
                $('#modalborrar_action').val('1');
                $("#BotonEliminar").removeClass("btn-danger").addClass("btn-success").html('Restablecer');
                $('#texto-modal-borrar').html('Seguro que deseas volver a activar la oferta ' + ' <strong>' + $(event.relatedTarget).data('name') + ' </strong>');
            } else {
                $('#modalborrar_action').val('0');
                $("#BotonEliminar").removeClass("btn-success").addClass("btn-danger").html('Eliminar');
                $('#texto-modal-borrar').html('Seguro que deseas borrar la oferta ' + ' <strong>' + $(event.relatedTarget).data('name') + ' </strong>');
            }

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