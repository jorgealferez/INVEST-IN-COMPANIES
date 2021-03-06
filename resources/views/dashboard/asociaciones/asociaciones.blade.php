@extends('layouts.dashboard') 
@section('content')


<div class="container-fluid">

	<div class="row">

		<div class="col-md-12">
	@include('dashboard.alertas')

			<div class="card">

				<div class="card-body card-seccion-asociaciones">
					<h4 class="card-title mb-0 title-section">
						<span class="lstick"></span> {{ __('Listado de Entidades')}} @if($isAdmin)
						<a href="{{ e(route('dashboardAsociacionesNueva')) }}" class="btn btn-verde btn-sm float-right"><i class="fas fa-plus-circle text-white"></i> {{ __('Nueva')}}</a>						@endif
					</h4>
				</div>
				<hr class="mt-0">

				<div class="card-body">
					<form method="POST" class="" action="{{ e(route('dashboardAsociaciones')) }}" id="formSearch">
						@csrf @method('POST')
						<input type="hidden" name="search" value="1">

						<div class="table-responsive ">
							<table class="table  table-hover tabla-usuarios">
								<thead>
									<tr>
										<th>
											@sortablelink('name', __('Entidad'),[],['class'=>'text-nowrap'])<br>
											<input name="name" id="name" class=" typeahead" type="text" value="{{ (!empty($busqueda)) ? $busqueda->input('name') : '' }}"
											 placeholder="{{ __('Nombre') }}">
										</th>
										<th>
											@sortablelink('phone', __('Teléfono'),[],['class'=>'text-nowrap'])<br>
											<input name="phone" id="phone" class="" type="text" value="{{ (!empty($busqueda)) ? $busqueda->input('phone') : '' }}" placeholder="{{ __('Teléfono') }}">
										</th>
										<th>
											@sortablelink('email', __('Email'),[],['class'=>'text-nowrap'])<br>
											<input name="email" id="email" class="" type="text" value="{{ (!empty($busqueda)) ? $busqueda->input('email') : '' }}" placeholder="{{ __('Email') }}">
										</th>
										<th>
											@sortablelink('address', __('Dirección'),[],['class'=>'text-nowrap'])<br>
											<input name="address" id="address" class="" type="text" value="{{ (!empty($busqueda)) ? $busqueda->input('address') : '' }}"
											 placeholder="{{ __('Dirección') }}">
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
									@if($asociaciones->isNotEmpty()) @foreach ($asociaciones as $asociacion)
									<tr class="@if(!$asociacion->active) registro-eliminado @endif">
										<td>
											@if (in_array($asociacion->id, $notifiacionesAsociaciones->pluck('data')->pluck('asociacion_id')->toArray()))
											<span class="badge badge-success bg-warning">
                                                                                            {{ __('Nueva') }}</span>											@endif {!! e($asociacion->name) !!}
										</td>
										<td>
											{{ e($asociacion->phone) }}
										</td>
										<td class="text-nowrap">
											{{ e($asociacion->email) }}
										</td>
										<td>
											{{ e($asociacion->address) }}
										</td>
										<td class="text-right">
											@if (in_array($asociacion->id,$notificaciones))
											<i class="mdi mdi-star text-warning float-left"></i> @endif

											<div class="btn-group" role="group" aria-label="...">
												<a href="<?php echo urldecode(route('dashboardAsociacion',['asociacion'=>$asociacion])); ?>" data-toggle="tooltip" data-original-title="{{ __('Ver') }}"
												 class="btn btn-sm btn-secondary">
                                                    {{ __('Ver') }}
                                                </a> @if($asociacion->active && $isAdmin)
												<a href="#" title="{{ __('Eliminar') }}" data-toggle="modal" data-original-title="{{ __('Borrar') }}" class="btn btn-sm btn-danger borrarasociacion "
												 data-url="<?php echo urldecode(route('dashboardAsociacionDelete',['asociacion'=>$asociacion])); ?>" data-id="{{$asociacion->id}}"
												 data-name="{{$asociacion->name}}" data-target="#borrarModal" data-borrar="1">
                                                    <i class="fa fas fa-trash"></i>
                                                </a> @elseif($isAdmin)
												<a href="#" title="{{ __('Restablecer') }}" data-toggle="modal" data-borrar="0" data-original-title="{{ __('Restablecer') }}"
												 class="borrarasociacion btn btn-sm btn-success" data-url="<?php echo urldecode(route('dashboardAsociacionDelete',['asociacion'=>$asociacion])); ?>"
												 data-id="{{$asociacion->id}}" data-name="{{$asociacion->name}}" data-target="#borrarModal">
                                                    <i class="fa  fas fa-undo-alt"></i>
                                                </a> @endif
											</div>
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
										<td colspan="3">{{ $asociaciones->appends(request()->query())->links() }}</td>
										<td colspan="2" class="text-right">
											@if ($asociaciones->total()>1)
											<small>
                                                <strong>
                                                    {{ $asociaciones->total() }}
                                                </strong>
                                                @if ($asociaciones->total()>1)
                                                {{ __(' asociaciones encontradas') }}
                                                @elseif($asociaciones->total()==1)
                                                {{ __(' asociación encontrada') }}
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
 
@section('scripts') {{--
<script src="{{ asset('js/bootstrap3-typeahead.min.js') }}" type="text/javascript"></script> --}}
<script>
	//
    $(document).ready(function ($) {
        $('#borrarModal').on("show.bs.modal", function (event) {
            console.log($(event.relatedTarget).data());
            if (!$(event.relatedTarget).data('borrar')) {
                $('#modalborrar_action').val('1');
                $("#BotonEliminar").removeClass("btn-danger").addClass("btn-success").html('Restablecer');
                $('#texto-modal-borrar').html('Seguro que deseas volver a activar la asociación ' + ' <strong>' + $(event.relatedTarget).data('name') + ' </strong>');
            } else {
                $('#modalborrar_action').val('0');
                $("#BotonEliminar").removeClass("btn-success").addClass("btn-danger").html('Eliminar');
                $('#texto-modal-borrar').html('Seguro que deseas borrar la asociación ' + ' <strong>' + $(event.relatedTarget).data('name') + ' </strong>');
            }

            $('#id_borrar').val($(event.relatedTarget).data('id'));
            $('#BotonEliminar').on('click', function (e) {
                $('#formBorrar').attr('action', "/dashboard/asociaciones/delete/" + $('#id_borrar').val());
                $('#formBorrar').submit();
                $form = '';
            });
        });

    });

    $("#btnreset").click(function () {
        $("#formSearch").trigger("reset");
        $("#formSearch :input,#formSearch select").not('#formSearch input[type="hidden"]').val('');
        $("#formSearch").submit();
    });

    // var path = "{{ route('searchAsociaciones') }}";
    // $('input.typeahead').typeahead({
    //     autoSelect: false,
    //     highlight: true,
    //     source: function (query, process) {
    //         return $.get(path, {
    //             query: query
    //         }, function (data) {
    //             return process(data);
    //         });
    //     }
    // }).on('blur change', function (e) {
    //     // e.preventDefault();
    //     $('#formSearch').attr('action', "{{ route('dashboardAsociaciones') }}?search=" + $(this).val());
    //     $('#formSearch').submit();
    //     $form = '';
    // });

</script>
@endsection