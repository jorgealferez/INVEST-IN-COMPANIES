@extends('layouts.dashboard') 
@section('content')

<div class="container-fluid">

	<div class="row">

		<div class="col-md-12">

			<div class="card">

				<div class="card-body card-seccion-ofertas">
					<h4 class="card-title mb-0 title-section">
						<span class="lstick"></span> {{ __('Listado de Inversiones')}}
					</h4>
				</div>

				<hr class="mt-0">

				<div class="card-body">


					<?php
                        use Carbon\Carbon; ?>

						<div class="table-responsive ">
							<table class="table  table-hover table-boder  tabla-inversores">
								<tbody>
									@if($inversiones->total()>0) @foreach ($inversiones->sortByDesc('created_at') as $inversion)

									<tr>
										<td class="p-0">
											<a href="#collapse{{ $inversion->oferta->id }}" class="tab-usuarios-link" role="button" aria-expanded="false" aria-controls="collapse{{ $inversion->oferta->id }}"
											 data-toggle="collapse">
                                            <i class="mdi mdi-tag-text-outline"></i> {{ e( $inversion->oferta->name) }}
                                            <span class="badge estado-{{ $inversion->estado->id }} float-right text-white" style="font-size: 100%"> {{ e( $inversion->estado->name) }}</span>
                                        </a>

											<div class="tab-usuarios-content collapse oferta-detalle" id="collapse{{ $inversion->oferta->id }}">


												<div class="card card-profile">


													<div class="card-body   bg-gray">
														<h4 class="card-title text-white m-0">
															{{ e($inversion->oferta->name) }} @if (!$inversion->oferta->active)
															<span class="badge badge-danger float-right ml-2"> {{ __('Eliminada') }}</span> @endif

														</h4>
													</div>

													<div class="card-body   bg-verde">
														<h6 class="card-subtitle text-white m-0">{{ e($inversion->oferta->descripcion) }}</h6>
													</div>


													<div class="card-body ">

														<div class="row">

															<div class="col-md-12  ">
																<small class=" font-weight-bold verde">{{ __('Forma Jurídica') }}:</small>
																<h6>{{ e($inversion->oferta->forma->name) }}</h6>
															</div>

														</div>

														<div class="row">

															<div class="col-md-4 ">
																<small class=" font-weight-bold verde">{{ __('Socios') }}:</small>
																<h6>{{ e($inversion->oferta->socios) }}</h6>
															</div>

															<div class="col-md-4 ">
																<small class=" font-weight-bold verde">{{ __('Empleados') }}:</small>
																<h6>{{ e($inversion->oferta->empleados) }}</h6>
															</div>

															<div class="col-md-4  text-md-right">
																<small class=" font-weight-bold verde">{{ __('Año') }}:</small>
																<h6>{{ e($inversion->oferta->año) }}</h6>
															</div>

														</div>

														<div class="row">

															<div class="col-md-12">
																<hr class=" verde">
																<small class=" font-weight-bold verde">{{ __('Motivo') }}:</small>
																<h6>{{ e($inversion->oferta->motivo) }}</h6>
															</div>
														</div>
														<div class="row">

															<div class="col-md-12">
																<hr class=" verde">
																<small class=" font-weight-bold verde">{{ __('Sector') }}:</small>
																<h6>{{ e($inversion->oferta->sector->name) }}</h6>
															</div>
														</div>

														<div class="row">

															<div class="col-md-12 ">
																<small class=" font-weight-bold verde">{{ __('Local propio') }}:</small>
																<h6>{{ ($inversion->oferta->local)? 'Si':'No' }}</h6>
															</div>
														</div>

														<div class="row">

															<div class="col-md-12">
																<hr class=" verde">
																<small class=" font-weight-bold verde">{{ __('Provincia') }}:</small>
																<h6>{{ e($inversion->oferta->provincia->name) }}</h6>
															</div>
														</div>



														<div class="row">

															<div class="col-md-12">
																<hr class=" verde">
																<small class=" font-weight-bold verde">{{ __('Valoración de la compañía') }}:</small>
																<h6>{{ number_format($inversion->oferta->valoracion,0,'','.') }} €</h6>
															</div>

														</div>

														<div class="row">

															<div class="col-md-12">
																<small class=" font-weight-bold verde">{{ __('Endeudamiento') }}:</small>
																<h6 class="text-danger">{{ number_format($inversion->oferta->endeudamiento,0,'','.') }} €</h6>
															</div>
														</div>
													</div>



												</div>


											</div>
										</td>

									</tr>

									@endforeach @else
									<tr>
										<td colspan="5" class="text-right">
											<p>{{ __('No has solicitado información aún sobre ninguna empresa.') }}</p>
										</td>
									</tr>
									@endif
								</tbody>
								<tfoot>
									<tr>
										<td colspan="5" class="text-right">
											@if ($inversiones->total()>1)
											<small>
                                            {{ 'Hay ' }}
                                            <strong>
                                                {{ $inversiones->total() }}
                                            </strong>
                                            @if ($inversiones->total()>1)
                                            {{ __(' inversores ') }}
                                            @elseif($inversiones->total()==1)
                                            {{ __('  inversor') }}
                                            @endif
                                            {{ 'en la oferta ' }}
                                        </small> @endif
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
	@include('dashboard.modalBorrar')
@endsection
 
@section('scripts')
<script>
	$(document).ready(function ($) {

        $('.oferta-detalle').on("show.bs.collapse", function (event) {
            $('.oferta-detalle').not(this).collapse('hide');
        });
    });

</script>
@endsection