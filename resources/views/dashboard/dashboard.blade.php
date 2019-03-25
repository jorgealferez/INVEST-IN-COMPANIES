@extends('layouts.dashboard') 
@section('content')
<?php
		use Carbon\Carbon; ?>
	<div class="container-fluid r-aside">
		@if (session('status'))

		<div class="alert alert-success" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button> {{ session('status') }}
		</div>
		@endif
		<div class="row">
	@includeWhen($isAdmin,'dashboard.dashboard.estadisticasAdmin')
	@includeWhen($isAsesor,'dashboard.dashboard.estadisticasAsesor')
	@includeWhen($isGestor,'dashboard.dashboard.estadisticasGestor')
		</div>
		@if ($isAdmin)
		<div class="row row-eq-height">


			<div class="col-md-8">

				<div class="card">

					<div class="card-body card-seccion-asociaciones">
						<h4 class="card-title mb-0 title-section">
							<span class="lstick"></span>{{ __('Solicitudes de Empresa')}}
							<h6 class="card-subtitle r m-b-0 op-5">Las solicitudes de empresa nueva</h6>
						</h4>
					</div>
					<hr class="mt-0">

					<div class="card-body" id="solicitudesEmpresa">
						<p class="saving">{{ __('Cargando') }}<span>.</span><span>.</span><span>.</span></p>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card">
					<div class="card-body bg-verde">
						<h4 class="text-white card-title">{{ __('Últimos usuarios')}}</h4>
						<h6 class="card-subtitle text-white m-b-0 op-5">Los últimos usuarios en darse de alta en la plataforma</h6>
					</div>
					<div class="card-body">
						<div class="message-box contact-box">
							<div class="message-widget contact-widget">
								@foreach ($usuarios as $usuario)
								<a href="{{ route('dashboardUsuario',['usuario'=>$usuario]) }}">
									<div class="float-left mr-2">
										<span class="round {{ $usuario->getRoleClass() }} roleMedium">{{ substr($usuario->getRoleClass(),4,1) }}</span>
									</div>
									<div class="mail-contnet">
										<h5>{{ $usuario->Fullname}}</h5> <span class="mail-desc">{{ $usuario->email}}</span>
									</div>
								</a>
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endif
		<div class="row row-eq-height">
			@if ($isAdmin||$isAsesor||$isGestor)
			<div class="col-lg-5">
				<div class="card">
					<div class="card-body">
						<div class="d-flex no-block">
							<h4 class="card-title">{{ __('Inversiones') }}</h4>
						</div>
						<h6 class="card-subtitle">{{ __('Listado de las últimas inversiones en las ofertas de la asociacion') }}</h6>
						<div class="table-responsive">
							<table class="table stylish-table tabla-dashboard f">
								<thead>
									<tr>
										<th class="no-wrap" style="width: 50%">{{ __('Inversor') }}</th>
										<th class="text-center no-wrap" style="width: 30%">{{ __('Oferta') }}</th>
										<th class="no-wrap" style="width: 20%"></th>
									</tr>
								</thead>
								<tbody>
									@foreach ($inversiones as $inversion)
									<tr>
										<td class=" text-truncate">
											<span class="badge estado-{{ $inversion->estado->id }} float-left text-white align-middle mr-2"> {{ e( $inversion->estado->name) }}</span>											{{ e( $inversion->usuario->FullName) }}
										</td>
										<td class="text-center">
											{{ e($inversion->oferta->name) }}
										</td>
										<td class="text-right">
											<a href="<?php echo urldecode(route('dashboardOferta',['oferta'=>$inversion->oferta])); ?>" data-toggle="tooltip" data-original-title="{{ __('Ver') }}"
											 class="btn btn-sm btn-secondary">
													 	{{ __('Ver') }}
										            </a>

										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-7">
				<div class="card">
					<div class="card-body">
						<div class="d-flex no-block">
							<h4 class="card-title">{{ __('Últimas ofertas') }}</h4>
						</div>
						<h6 class="card-subtitle">{{ __('Listado de las últimas ofertas en la plataforma') }}</h6>
						<div class="table-responsive">
							<table class="table stylish-table tabla-dashboard">
								<thead>
									<tr>
										<th class="no-wrap" style="width: 38%">{{ __('Oferta') }}</th>
										<th class="no-wrap" style="width: 25%">{{ __('Asociacion') }}</th>
										<th class="text-center no-wrap" style="width: 22%">{{ __('Inversores') }}</th>
										<th class="no-wrap" style="width: 15%"></th>
									</tr>
								</thead>
								<tbody>
									@foreach ($ofertas as $oferta)
									<tr>
										<td>
											@if (in_array($oferta->id, $notifiacionesOfertas->pluck('data')->pluck('oferta_id')->toArray()))
											<span class="badge badge-success bg-warning align-middle">
													<i class="mdi mdi-star text-white float-left "></i></span> @endif {!! e($oferta->name) !!}
										</td>
										<td>
											{{ e($oferta->asociacion->name) }}
										</td>
										<td class="text-center">
											{{ e($oferta->inversiones()->count()) }}
										</td>
										<td class="text-right">
											<a href="<?php echo urldecode(route('dashboardOferta',['oferta'=>$oferta])); ?>" data-toggle="tooltip" data-original-title="{{ __('Ver') }}"
											 class="btn btn-sm btn-secondary">
													 	{{ __('Ver') }}
										            </a>

										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			@endif
			<!-- -->
			@if($isAdmin)
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<div class="d-flex no-block">
							<h4 class="card-title">{{ __('Últimas asociaciones') }}</h4>
						</div>
						<h6 class="card-subtitle">{{ __('Listado de las últimas asociaciones en la plataforma') }}</h6>
						<div class="table-responsive">
							<table class="table stylish-table tabla-dashboard">
								<thead>
									<tr>
										<th class="no-wrap" style="width: 50%">{{ __('Asociación') }}</th>
										<th class="text-center no-wrap" style="width: 30%">{{ __('Ofertas') }}</th>
										<th class="no-wrap" style="width: 20%"></th>
									</tr>
								</thead>
								<tbody>
									@foreach ($asociaciones as $asociacion)
									<tr class="@if(!$asociacion->active) registro-eliminado @endif">
										<td class=" text-truncate">
											@if (in_array($asociacion->id, $notifiacionesAsociaciones->pluck('data')->pluck('asociacion_id')->toArray()))
											<span class="badge badge-success bg-warning align-middle"><i class="mdi mdi-star text-white float-left"></i></span>											@endif {!! e($asociacion->name) !!}
										</td>
										<td class="text-center">
											{{ e($asociacion->ofertas()->count()) }}
										</td>
										<td class="text-right">
											<a href="<?php echo urldecode(route('dashboardAsociacion',['asociacion'=>$asociacion])); ?>" data-toggle="tooltip" data-original-title="{{ __('Ver') }}"
											 class="btn btn-sm btn-secondary">
														 	{{ __('Ver') }}
											            </a>

										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			@endif
		</div>

	</div>
@endsection
 
@section('scripts')
	<!-- -->
	@if ($isAdmin)
	<script>
		$('.borrar_notificacion').on('click', function (e) {
        var $boton = $(this);
        var $num = parseInt($boton.closest('table').find('.numTotal').html());
        $.ajax({
            url: "{{ route('boorarNotificacion', ['id'=>" + $(this).data('id') + "]) }}",
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                "notificacion_id": $(this).data('id')
            },
            success: function (data) {
                if (data.status) {
                    $boton.closest('table').find('.numTotal').html($num - 1);
                    $boton.closest('tr').fadeOut(500);
                } else {
                    alert('Error');
                }
            }
        });
    });
	</script>
	@endif
	<!-- -->
	@if ($isAdmin)
	<script>
		$(function () {
			// 1.
			function getPaginationSelectedPage(url) {
				var chunks = url.split('?');
				var baseUrl = chunks[0];
				var querystr = chunks[1].split('&');
				var pg = 1;
				for (i in querystr) {
					var qs = querystr[i].split('=');
					if (qs[0] == 'page') {
						pg = qs[1];
						break;
					}
				}
				return pg;
			}

			$('#solicitudesEmpresa').on('click', '.pagination a', function (e) {
				e.preventDefault();
				var pg_solicitudesEmpresa = getPaginationSelectedPage($(this).attr('href'));
				$('#solicitudesEmpresa').html("<p class='saving'>{{ __('Cargando') }}<span>.</span><span>.</span><span>.</span></p>");
				$.ajax({
					url: '/dashboard/ajax/solicitudesEmpresa',
					data: { 
						"_token": "{{ csrf_token() }}",
						page: pg_solicitudesEmpresa
						 },
					success: function (data) {
						$('#solicitudesEmpresa').html(data);
					}
				});
			});

			


			$('#solicitudesEmpresa').load('/dashboard/ajax/solicitudesEmpresa?page=1');
		});
	</script>
	@endif
@endsection