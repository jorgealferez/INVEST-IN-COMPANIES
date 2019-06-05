@extends('layouts.dashboard') 
@section('estilos')
@endsection
 
@section('content')

<div class="container-fluid">

	<div class="row">
		<!-- Column -->

		<div class="col-lg-6 col-xlg-5 ">

			<div class="card card-profile">

				<div class="card-body   bg-gray">
					<h4 class="card-title text-white m-0">
						{{ e($oferta->name) }} @if (!$oferta->active)
						<span class="badge badge-danger float-right ml-2"> {{ __('Eliminada') }}</span> @endif @if ($oferta->approved)
						<span class="badge badge-success float-right"> <i class="mdi mdi-check-circle"></i> {{ __('Aprobada') }}</span> @else
						<span class="badge badge-warning float-right"> <i class="mdi mdi-alert-circle"></i> {{ __('Sin Aprobar') }}</span>						@endif @if ($nueva)
						<span class="badge badge-warning float-right mr-2"> <i class="mdi mdi-star text-white "></i> {{ __('Nueva') }}</span>						@endif
					</h4>
				</div>

				<div class="card-body   bg-verde">
					<h6 class="card-subtitle text-white m-0">{{ e($oferta->descripcion) }}</h6>
				</div>

				<div class="card-body row">

					<div class="col-md-8  ">
						<small class=" font-weight-bold verde">{{ __('Forma Jurídica') }}:</small>
						<h6>{{ e($oferta->forma->name) }}</h6>
					</div>

					<div class="col-md-4 text-md-right">
						<small class="verde font-weight-bold">{{ __('CIF') }}:</small>
						<h6>{{ e($oferta->cif) }}</h6>
					</div>

					<div class="col-md-4 ">
						<small class=" font-weight-bold verde">{{ __('Socios') }}:</small>
						<h6>{{ e($oferta->socios) }}</h6>
					</div>

					<div class="col-md-4 ">
						<small class=" font-weight-bold verde">{{ __('Empleados') }}:</small>
						<h6>{{ e($oferta->empleados) }}</h6>
					</div>

					<div class="col-md-4  text-md-right">
						<small class=" font-weight-bold verde">{{ __('Año') }}:</small>
						<h6>{{ e($oferta->año) }}</h6>
					</div>

					<div class="col-md-12">
						<hr class=" verde">
						<small class=" font-weight-bold verde">{{ __('Motivo') }}:</small>
						<h6>{{ e($oferta->motivo) }}</h6>
					</div>

					<div class="col-md-12">
						<small class=" font-weight-bold verde">{{ __('Sector') }}:</small>
						<h6>{{ e($oferta->sector->name) }}</h6>
					</div>

					<div class="col-md-12 ">
						<small class=" font-weight-bold verde">{{ __('Local propio') }}:</small>
						<h6>{{ ($oferta->local)? 'Si':'No' }}</h6>
					</div>

					<div class="col-md-12">
						<hr class=" verde">
						<small class=" font-weight-bold verde">{{ __('Direccion') }}:</small>
						<h6>{{ e($oferta->address) }}, {{ e($oferta->poblacion->name) }} ({{ e($oferta->provincia->name) }})</h6>
					</div>

					<div class="col-md-12">
						<small class=" font-weight-bold verde">{{ __('Página web') }}:</small>
						<a href="{{ e($oferta->web) }}" class="link text-muted" target="_blank">
							<h6>{{ e($oferta->web) }}</h6>
						</a>
						<hr class=" verde">
					</div>

					<div class="col-md-12">
						<hr class=" verde">
						<small class=" font-weight-bold verde">{{ __('Valoración de la compañía') }}:</small>
						<h6>{{ number_format($oferta->valoracion,0,'','.') }} €</h6>
					</div>
                                    
                                        <div class="col-md-12">
						<small class=" font-weight-bold verde">{{ __('Facturación') }}:</small>
						<h6>{{ number_format($oferta->facturacion,0,'','.') }} €</h6>
					</div>

					<div class="col-md-12">
						<small class=" font-weight-bold verde">{{ __('Endeudamiento') }}:</small>
						<h6 class="text-danger">{{ number_format($oferta->endeudamiento,0,'','.') }} €</h6>
					</div>
				</div>
				<hr class="m-0 verde">

				<div class="card-body row">

					<div class="col-md-12 ">
						<small class="verde">{{ __('Contacto') }}:</small>
						<h6><i class="ti-user"></i> {{ e($oferta->contactFullName) }}</h6>
					</div>
					@if($oferta->contactEmail)

					<div class="col-md-12 ">
						<small class="verde">{{ __('Email') }}:</small>
						<a href="mailto:{{ e($oferta->contactEmail) }}" class="link text-muted" target="_blank">
							<h6><i class="ti-email"></i> {{ e($oferta->contactEmail) }}</h6>
						</a>
					</div>
					@endif @if($oferta->contactPhone)

					<div class="col-md-12 ">
						<small class="verde">{{ __('Teléfono') }}:</small>
						<h6><i class="ti-mobile"></i> {{ e($oferta->contactPhone) }}</h6>
					</div>
					@endif
				</div>

				<hr class="m-0">
			</div>

		</div>
		<!-- Column -->
		<!-- Column -->

		<div class="col-lg-6 col-xlg-7 ">
	@include('dashboard.alertas')

			<!-- Nav tabs -->
			<ul class="nav nav-tabs profile-tab  listaTabs tabsOferta" role="tablist">
				<li class="nav-item">
					<a class="nav-link @if($tab=='inversores') active show @endif" data-toggle="tab" href="#inversores" role="tab">{{ __('Inversores') }}</a>
				</li>
				<li class="nav-item">
					<a class="nav-link @if($tab=='modificar') active show @endif" data-toggle="tab" href="#modificar" role="tab">{{ __('Oferta') }}</a>
				</li>
				@if ($isAdmin || $isAsesor)
				<li class="nav-item">
					<a class="nav-link @if($tab=='asociacion') active show @endif" data-toggle="tab" href="#asociacion" role="tab">
                        {{ __('Gestor') }}
                    </a>
				</li>
				@endif
				<li class="nav-item">
					<a class="nav-link @if($tab=='empresa') active show @endif" data-toggle="tab" href="#empresa" role="tab">{{ __('Empresa') }}</a>
				</li>
				<li class="nav-item">
					<a class="nav-link @if($tab=='contacto') active show @endif" data-toggle="tab" href="#contacto" role="tab">{{ __('Contacto') }}</a>
				</li>

				@if ($isAdmin)
				<li class="nav-item">
					<a class="nav-link @if($tab=='estado') active show @endif" data-toggle="tab" href="#estado" role="tab">
                        {{ __('Estado') }}
                    </a>
				</li>
				@endif
			</ul>

			<div class="card card-tabs">
				<!-- Tab panes -->

				<div class="tab-content">

					<div class="tab-pane  @if($tab=='modificar') active @endif" id="modificar" role="tabpanel">

						<div class="card-body bg-verde ">
							<h6 class="card-subtitle text-white m-0">{{ __('Modifica los datos de la oferta') }}</h6>
						</div>

						<div class="card-body">

							<form method="POST" class="" action="{{ action('Dashboard\OfertasController@update', ['id' => $oferta->id,'tab'=>'modificar'])}}">
								@csrf @method('PUT')
								<input type="hidden" name="tab" value="modificar">
	@include('dashboard.ofertas.formulario.basico')

								<div class="row">

									<div class="col-md-12">

										<div class="form-group">
											<button class="btn btn-verde waves-effect waves-light">{{ __('Modificar Oferta') }}</button>
											<a href="{{ e(route('dashboardOfertas')) }}" class="btn btn-inverse waves-effect waves-light">{{ __('Cancelar') }}</a>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>

					<div class="tab-pane  @if($tab=='empresa') active @endif" id="empresa" role="tabpanel">

						<div class="card-body bg-verde ">
							<h6 class="card-subtitle text-white m-0">{{ __('Modifica los datos de la empresa') }}</h6>
						</div>

						<div class="card-body">
							<form method="POST" class="" action="{{ action('Dashboard\OfertasController@update', ['id' => $oferta->id])}}">
								@csrf @method('PUT')
								<input type="hidden" name="tab" value="empresa">
	@include('dashboard.ofertas.formulario.empresa')

								<div class="row">

									<div class="col-md-12">

										<div class="form-group">
											<button class="btn btn-verde waves-effect waves-light">{{ __('Modificar datos de Empresa') }}</button>
											<a href="{{ e(route('dashboardOfertas')) }}" class="btn btn-inverse waves-effect waves-light">{{ __('Cancelar') }}</a>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>

					@if ($isAdmin || $isAsesor)

					<div class="tab-pane  @if($tab=='asociacion') active @endif" id="asociacion" role="tabpanel">

						<div class="card-body bg-verde ">
							<h6 class="card-subtitle text-white m-0">{{ __('Modifica la persona encargada de gestionar la oferta') }}</h6>
						</div>

						<div class="card-body">
							<form method="POST" class="" action="{{ action('Dashboard\OfertasController@update', ['id' => $oferta->id])}}">
								@csrf @method('PUT')
								<input type="hidden" name="tab" value="asociacion">
	@include('dashboard.ofertas.formulario.gestor')

								<div class="row">

									<div class="col-md-12">

										<div class="form-group">
											<button class="btn btn-verde waves-effect waves-light">{{ __('Modificar Gestor') }}</button>
											<a href="{{ e(route('dashboardOfertas')) }}" class="btn btn-inverse waves-effect waves-light">{{ __('Cancelar') }}</a>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
					@endif

					<div class="tab-pane  @if($tab=='contacto') active @endif" id="contacto" role="tabpanel">

						<div class="card-body bg-verde ">
							<h6 class="card-subtitle text-white m-0">{{ __('Modifica los datos de la persona de contacto de la empresa.') }}</h6>
						</div>

						<div class="card-body">
							<form method="POST" class="" action="{{ action('Dashboard\OfertasController@update', ['id' => $oferta->id,'tab'=>'contacto'])}}">
								@csrf @method('PUT')
								<input type="hidden" name="tab" value="contacto">
	@include('dashboard.ofertas.formulario.contacto')

								<div class="row">

									<div class="col-md-12">

										<div class="form-group">
											<button class="btn btn-verde waves-effect waves-light my-2 my-md-0">{{ __('Modificar datos de Contacto') }}</button>
											<a href="{{ e(route('dashboardOfertas')) }}" class="btn btn-inverse waves-effect waves-light">{{ __('Cancelar') }}</a>
										</div>
									</div>
								</div>
							</form>

						</div>
					</div>

					@if ($isAdmin)

					<div class="tab-pane  @if($tab=='estado') active @endif" id="estado" role="tabpanel">

						<div class="card-body bg-verde ">
							<h6 class="card-subtitle text-white m-0">{{ __('Activa, o desactiva la oferta.') }}</h6>
						</div>
						<form method="POST" class="" action="{{ action('Dashboard\OfertasController@updateEstado', ['id' => $oferta->id])}}">
							@csrf @method('PUT')

							<div class="card-body">

								<div class="row">

									<div class="col-md-6">

										<div class="form-group ">
											<label for="active" class=" col-form-label ">{{ __('Estado') }}</label>
											<select name="active" id="active" class="form-control form-control-line {{ $errors->has('active') ? ' form-control-danger' : '' }}"
											 required>
                                                <option value="1" @if ( $oferta->active) selected @endif>{{ __('Activa') }}</option>
                                                <option value="0" @if (! $oferta->active) selected @endif>{{ __('Eliminada') }}</option>
                                            </select>
										</div>
									</div>

									<div class="col-md-6">

										<div class="form-group ">
											<label for="approved" class=" col-form-label ">{{ __('Aprobación de la oferta') }}</label>
											<select name="approved" id="approved" class="form-control form-control-line {{ $errors->has('approved') ? ' form-control-danger' : '' }}"
											 required>
                                                <option value="1" @if ( $oferta->approved) selected @endif>{{ __('Aprobada') }}</option>
                                                <option value="0" @if (! $oferta->approved) selected @endif>{{ __('NO Aprobada') }}</option>
                                            </select>
										</div>
									</div>
								</div>
								<hr>

								<div class="row">

									<div class="col-md-12">

										<div class="form-group">
											<button class="btn btn-verde waves-effect waves-light">{{ __('Modificar estado') }}</button>
											<a href="{{ e(route('dashboardOfertas')) }}" class="btn btn-inverse waves-effect waves-light">{{ __('Cancelar') }}</a>
										</div>
									</div>
								</div>

							</div>

						</form>
					</div>
					@endif

					<div class="tab-pane  @if($tab=='inversores') active @endif" id="inversores" role="tabpanel">

						<div class="card-body bg-verde ">
							<h6 class="card-subtitle text-white m-0">{{ __('Los inversores de la entidad') }}</h6>
						</div>

						<div class="card-body">

							<div class="table-responsive ">
								<table class="table  table-hover table-boder  tabla-inversores">
									<tbody>
										@if($oferta->inversiones->isNotEmpty()) @foreach ($oferta->inversiones->sortByDesc('created_at') as $inversion)

										<tr>
											<td class="p-0">
												<a href="#collapse{{ $inversion->usuario->id }}" class="tab-usuarios-link" role="button" aria-expanded="false" aria-controls="collapse{{ $inversion->usuario->id }}"
												 data-toggle="collapse">
                                                    <i class="mdi mdi-account " style="font-size: 120%"></i> {{ e( $inversion->usuario->FullName) }}
                                                    <span class="badge estado-{{ $inversion->estado->id }} float-right text-white" style="font-size: 100%"> {{ e( $inversion->estado->name) }}</span>
                                                </a>

												<div class="tab-usuarios-content collapse" id="collapse{{ $inversion->usuario->id }}">

													<div class="px-2 py-4 row m-0">

														<div class="col-md-12 py-2">
															<span class="text-muted"><i class="ti-email"></i> {{ __('Email') }}</span>
															<h6>{{ e( $inversion->usuario->email) }}</h6>
														</div>

														<div class="col-md-6 py-2">
															<span class="text-muted"><i class="ti-mobile"></i> {{ __('Teléfono') }}</span>
															<h6>{{ e( $inversion->usuario->phone) }}</h6>
														</div>

														<div class="col-md-12 py-2">
															<span class=" font-weight-bold verde text-uppercase"> {{ __('Estado') }}</span>
															<form method="POST" class="" action="{{ action('Dashboard\OfertasController@updateEstadoInversor', ['id' => $inversion->id])}}">
																@csrf @method('PUT')

																<div class="input-group">
																	<select class="custom-select custom-select-sm cambio-estado" data-style="btn-primary" name="estado_id">

                                                                        @foreach ($estadosInversor->sortBy('updated_at') as $estado)
                                                                        <option value="{{ e($estado->id) }}" @if ($estado->id == $inversion->estado->id)
                                                                            selected

                                                                            @endif
                                                                            >{{ e($estado->name) }}</option>
                                                                        @endforeach
                                                                    </select>

																	<div class="input-group-append">
																		<button class="btn btn-verde waves-effect waves-light btn-sm" type="submit">{{ __('Actualizar estado') }}</button>
																	</div>
																</div>
															</form>
														</div>
													</div>
												</div>
											</td>

										</tr>

										@endforeach @else
										<tr>
											<td colspan="5" class="text-right">
												<p>{{ __('No hay inversores en la oferta.') }}</p>
											</td>
										</tr>
										@endif
									</tbody>
									<tfoot>
										<tr>
											<td colspan="5" class="text-right">
												@if ($oferta->inversiones->count()>1)
												<small>
                                                    {{ 'Hay ' }}
                                                    <strong>
                                                        {{ $oferta->inversiones->count() }}
                                                    </strong>
                                                    @if ($oferta->inversiones->count()>1)
                                                    {{ __(' inversores ') }}
                                                    @elseif($oferta->inversiones->count()==1)
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
	</div>
	<!-- Column -->
</div>

</div>
@endsection
 
@section('scripts')
<script>
	$(function () {
        $(".alert-success ").fadeTo(5000, 500).slideUp(500, function () {
            $(".alert-success ").slideUp(500);
        });
    });

</script>
@if($isAdmin)
<script>
	$('#asociacion_id').on('blur change load', function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route( 'searchUsuariosByAsociacion') }} ",
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                "asociacion": $('#asociacion_id').val()
            },
            success: function (data) {
                console.log(data);
                var toAppend = '';
                if (data.status && Object.keys(data.usuarios).length > 0) {
                    toAppend += '<option value=" ">Selecciona Usuario</option>';
                    $('#user_id').prop('disabled', false);
                    $.each(data.usuarios, function (i, o) {
                        toAppend += '<option value=" ' + i + ' ">' + o + '</option>';
                    });
                } else {
                    toAppend += '<option value=" ">No hay usuarios</option>';
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
        $('#poblacion_id').prop('disabled', true);
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