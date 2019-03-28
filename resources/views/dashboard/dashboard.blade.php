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
		@endif {{-- --}}
		<div class="row">
	@includeWhen($isAdmin,'dashboard.dashboard.estadisticasAdmin')
	@includeWhen($isAsesor,'dashboard.dashboard.estadisticasAsesor')
	@includeWhen($isGestor,'dashboard.dashboard.estadisticasGestor')
		</div>

		<div class="row row-eq-height">
			@if ($isAdmin)
			<div class="col-lg-6">
				<div class="card">
					<div class="card-body card-seccion-asociaciones">
						<h4 class="card-title mb-0 title-section">
							<span class="lstick"></span>{{ __('Solicitudes de Empresa')}}
							<h6 class="card-subtitle r mb-0 op-5">{{ __('Las solicitudes de empresa nueva')}}</h6>
						</h4>
					</div>
					<hr class="mt-0">

					<div class="card-body" id="solicitudesEmpresa">
						<p class="saving">{{ __('Cargando') }}<span>.</span><span>.</span><span>.</span></p>
					</div>
				</div>
			</div>
			@endif
			<div class="@if($isAdmin) col-lg-6 @else col-lg-12 @endif">
				<div class="card">
					<div class="card-body card-seccion-asociaciones">
						<h4 class="card-title mb-0 title-section">
							<span class="lstick"></span>{{ __('Inversores')}}
							<h6 class="card-subtitle r mb-0 op-5">{{ __('Listado de inversiones en las ofertas de la asociacion') }}</h6>
						</h4>
					</div>
					<hr class="mt-0">
					<div class="card-body" id="inversores">
						<p class="saving">{{ __('Cargando') }}<span>.</span><span>.</span><span>.</span></p>
					</div>
				</div>
			</div>
		</div>


		<div class="row row-eq-height">

			<div class="col-lg-7 ">
				<div class="card">
					<div class="card-body card-seccion-asociaciones">
						<h4 class="card-title mb-0 title-section">
							<span class="lstick"></span>{{ __('Últimas ofertas') }}
							<h6 class="card-subtitle r mb-0 op-5">{{ __('Listado de las últimas ofertas en la plataforma') }}</h6>
						</h4>
					</div>
					<hr class="mt-0">
					<div class="card-body">
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
			<div class="col-lg-5  ">
				<div class="card">
					<div class="card-body card-seccion-asociaciones bg-verde text-white">
						<h4 class="card-title mb-0 text-white">
							<span class="lstick"></span>{{ __('Últimos usuarios')}}</h4>
						<h6 class=" mb-0 op-5 text-white">{{ __('Los últimos usuarios en darse de alta en la plataforma') }}</h6>

					</div>
					<hr class="mt-0">
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
			<!-- -->
			@if($isAdmin)
			<div class="col-12">
				<div class="card">
					<div class="card-body card-seccion-asociaciones">
						<h4 class="card-title mb-0 title-section">
							<span class="lstick"></span>{{ __('Últimas asociaciones') }}
							<h6 class="card-subtitle r mb-0 op-5">{{ __('Listado de las últimas asociaciones en la plataforma') }}</h6>
						</h4>
					</div>
					<hr class="mt-0">
					<div class="card-body">
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

	<script>
		$(function () {
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
			$('#inversores').on('click', '.pagination a', function (e) {
				e.preventDefault();
				var pg = getPaginationSelectedPage($(this).attr('href'));
				$('#inversores').html("<p class='saving'>{{ __('Cargando') }}<span>.</span><span>.</span><span>.</span></p>");
				$.ajax({
					url: '/dashboard/ajax/inversores',
					data: { 
						"_token": "{{ csrf_token() }}",
						page: pg
						 },
					success: function (data) {
						$('#inversores').html(data);
					}
				});
			});
			$('#inversores').load('/dashboard/ajax/inversores?page=1');
			
	

	@if ($isAdmin)
		$('#solicitudesEmpresa').on('click', '.pagination a', function (e) {
				e.preventDefault();
				var pg = getPaginationSelectedPage($(this).attr('href'));				
				$('#solicitudesEmpresa').html("<p class='saving'>{{ __('Cargando') }}<span>.</span><span>.</span><span>.</span></p>");
				$.ajax({
					url: '/dashboard/ajax/solicitudesEmpresa',
					data: { 
						"_token": "{{ csrf_token() }}",
						page: pg
						 },
					success: function (data) {
						$('#solicitudesEmpresa').html(data);
					}
				});
			});
		$('#solicitudesEmpresa').load('/dashboard/ajax/solicitudesEmpresa?page=1');
		});
	@endif
	</script>
@endsection