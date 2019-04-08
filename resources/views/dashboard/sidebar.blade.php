<aside class="left-sidebar">
	<!-- Sidebar scroll-->

	<div class="scroll-sidebar">
		<!-- Sidebar navigation-->
		<nav class="sidebar-nav">
			<ul id="sidebarnav">
				<li class="nav-small-cap">{{ __(strtoupper('Administración')) }}</li>
				<!-- -->
				@if($isAdmin || $isAsesor || $isGestor)
				<li>
					<a href="{{ e(route('dashboard')) }}" data-active=""><i class="mdi mdi-poll-box"></i><span class="hide-menu">
                        {{ __('Dashboard') }}

                    </span>
                </a>
				</li>
				@endif
				<!-- -->
				@if($isAdmin)
				<li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-security-home"></i><span class="hide-menu">{{ __('Entidades') }}
                    @if (isset($notifiacionesAsociaciones) && count ($notifiacionesAsociaciones)>0)
                        <span class="badge badge-success bg-warning etiqueta-sidebar">
                            {{ count ($notifiacionesAsociaciones) }}
                        </span>
                    @endif
                    </span>
                </a>
					<ul aria-expanded="false" class="collapse">
						<li><a href="{{ e(route('dashboardAsociaciones')) }}" data-active="/asociaciones">Listado</a></li>
						<li><a href="{{ e(route('dashboardAsociacionesNueva')) }}" data-active="/asociaciones/crear">Crear</a></li>
					</ul>
				</li>
				@endif
				<!-- -->
				@if($isAsesor)
				<li>
					<a href="{{ e(route('dashboardAsociaciones')) }}" data-active="/asociaciones">
                        <i class="mdi mdi-security-home"></i><span class="hide-menu">{{ __('Mis entidades') }}
                        </span>
                    </a>
				</li>
				@endif
				<!-- -->
				@if($isGestor)
				<?php if(!auth()->user()->asociaciones->isEmpty() && auth()->user()->asociaciones->contains('active',1) ){?>
				<li>

					<a href="{{ e(route('dashboardAsociacion', auth()->user()->asociaciones->first()->id)) }}" data-active="/asociaciones">
                        <i class="mdi mdi-security-home"></i>
                        <span class="hide-menu">{{ __('Mi Entidad') }}</span>
                    </a>
					<li>
						<?php } ?> @endif @if ( (!auth()->user()->asociaciones->isEmpty() || $isAdmin) && !$isInversor)
						<li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                        <i class="mdi mdi-tag-text-outline"></i>
                        <span class="hide-menu">
                            {{ __('Ofertas') }}
                            @if (isset($notifiacionesOfertas) && count ($notifiacionesOfertas)>0)
                            <span class="badge badge-success bg-warning etiqueta-sidebar">
                                {{-- <i class="mdi mdi-star"></i> --}}
                                {{ count ($notifiacionesOfertas) }}</span>
                            @endif
                        </span>
                    </a>
							<ul aria-expanded="false" class="collapse">
								<li><a href="{{ e(route('dashboardOfertas')) }}" data-active="/ofertas">Listado</a></li>
								<li><a href="{{ e(route('dashboardOfertasNueva')) }}" data-active="/ofertas/crear">Crear</a></li>
							</ul>
						</li>
						@endif
						<!-- -->
						@if($isAdmin || $isAsesor)
						<li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                        <i class="mdi mdi-account-multiple"></i>
                        <span class="hide-menu">
                            {{ __('Usuarios') }}
                            {{-- {{ dd($notificaciones) }} --}}
                            @if (isset($notifiacionesUsuarios) && count ($notifiacionesUsuarios)>0)
                            <span class="badge badge-success bg-warning etiqueta-sidebar">
                                {{-- <i class="mdi mdi-star"></i> --}}
                                {{ count ($notifiacionesUsuarios) }}</span>
                            @endif
                        </span>
                    </a>

							<ul aria-expanded="false" class="collapse">
								<li><a href="{{ e(route('dashboardUsuarios')) }}" data-active="/usuarios">Listado</a></li>
								<li><a href="{{ e(route('dashboardUsuariosNuevo')) }}" data-active="/usuarios/crear">Crear</a></li>
							</ul>
						</li>
						@endif
						<!-- -->
						@if($isInversor)
						<li>
							<a href="{{ e(route('dashboardInversiones')) }}" data-active="/inversiones">
							   <i class="mdi mdi-chart-line"></i>
							   <span class="hide-menu">{{ __('Mis inversiones') }}</span>
							</a>
						</li>
						@endif
						<!-- -->
						<li class="nav-devider"></li>
						<li class="user-profile">
							<a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                        <span class="round {{ auth()->user()->getRoleClass() }} roleSmall">{{ substr(auth()->user()->getRoleClass(),4,1) }} </span>
                        &nbsp;
                        <span class="hide-menu">{{ auth()->user()->name }} </span>
                    </a>
							<ul aria-expanded="false" class="collapse">
								<li>
									<a href="{{ e(route('perfilUsuario')) }}" data-active="usuarios/perfil"> {{ __('Mi cuenta') }}</a>
								</li>
								<li>
									<a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                {{ __('Salir') }}
                            </a>
									<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
										@csrf
									</form>
								</li>
							</ul>
						</li>
			</ul>
		</nav>
		<!-- End Sidebar navigation -->
	</div>
	<!-- End Sidebar scroll-->
</aside>