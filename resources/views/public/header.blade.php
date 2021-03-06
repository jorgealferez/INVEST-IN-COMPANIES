<header>

	<div class="row justify-content-end bg-primary text-white rss-header mx-0">

		<div class="text-center col-sm-12 col-md-4">
			{{--
			<h5 class="my-0 mr-auto align-middle py-2"><i class="fas fa-phone"></i> 91 411 61 61</h5>
			--}}
		</div>

		<div class="col-4 pr-0">
			<nav class="">
                            {{--	
				<ul class="navbar-nav flex-row ml-md-auto d-none d-md-flex float-right">
					<li class="nav-item">
					<a class="nav-link px-3 py-2 text-white" href="https://twitter.com/in_companies" target="_blank"><i class="fab fa-twitter"></i></a>
					</li>
					<li class="nav-item">
						<a class="nav-link px-3 py-2 text-white" href="https://www.facebook.com/pg/Invest-in-Companies-370660103782176/" target="_blank"><i class="fab fa-facebook-f"></i></a>
					</li>
					<li class="nav-item">
						<a class="nav-link px-3 py-2 text-white" href="ttps://www.linkedin.com/company/invest-in-companies" target="_blank"><i class="fab fa-linkedin-in"></i></a>
					</li>
				</ul>
                            --}}
			</nav>
		</div>
	</div>


	<div class="py-3 text-center">
		<img class="d-block mx-auto p-4 img-fluid logo-top" src="{{ asset('images/logo.png') }}" alt="{{ __('INVESTin Company') }}">
	</div>
	<nav class="navbar navbar-expand-lg navbar-light bg-primary bg-light text-white">
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu-principal" aria-controls="menu-principal" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                
		<div class="navbar navbar-collapse collapse menu-principal" id="menu-principal" style="">
			<ul class="navbar-nav ml-auto mr-auto text-center">
				<li class="nav-item ">
					<a class="nav-link " href="{{ route('home') }}/">{{ __('Home') }}<span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link " href="{{ route('queEs') }}">{{ __('¿Qué es?') }}</a>
				</li>
				<li class="nav-item">
					<a class="nav-link " href="{{ route('quienesSomos') }}">{{ __('¿Quiénes Somos?') }}</a>
				</li>
				<li class="nav-item">
					<a class="nav-link " href="{{ route('vendeEmpresa') }}">{{ __('Vende tu empresa') }}</a>
				</li>
				<li class="nav-item">
					<a class="nav-link " href="{{ route('compraEmpresa') }}">{{ __('Compra una empresa') }}</a>
				</li>
				<li class="nav-item">
					<a class="nav-link " href="{{ route('socio') }}">{{ __('Busca un socio') }}</a>
				</li>
				<li class="nav-item">
					<a class="nav-link " href="{{ route('buscador') }}">{{ __('Buscador') }}</a>
				</li>
				<li class="nav-item">
					<a class="nav-link " href="{{ route('noticias') }}">{{ __('Noticias') }}</a>
				</li>
				<li class="nav-item">
					<a class="nav-link " href="{{ route('puntosAtencion') }}">{{ __('Puntos de atención') }}</a>
				</li>


				@if (Auth::user())
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
											 {{ __('Admin') }}
										</a>
					<div class="dropdown-menu mt-0">
						<a href="{{ url('/dashboard') }}" class="dropdown-item">
												<i class="ti-settings pr-2"></i> {{ __('Panel de Control') }}
											</a>
						<div class="dropdown-divider">
						</div>
						<a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();document.getElementById('logout-form2').submit();">
												<i class="fa fa-power-off pr-2"></i>
												{{ __('Salir') }}
											</a>
						<form id="logout-form2" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
					</div>
				</li>
				@else
				<li class="nav-item">
					<a class="nav-link " href=" {{ route('login') }}">{{ __('Acceso') }}</a>
				</li>
				@endif

                                
                                <li class="nav-item nav-social-icon">
                                        <a class="nav-link text-white" href="https://twitter.com/in_companies" target="_blank"><i class="fab fa-twitter"></i></a>
                                </li>
                                <li class="nav-item nav-social-icon">
                                        <a class="nav-link text-white" href="https://www.facebook.com/pg/Invest-in-Companies-370660103782176/" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                </li>
                                <li class="nav-item nav-social-icon">
                                        <a class="nav-link text-white" href="ttps://www.linkedin.com/company/invest-in-companies" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                </li>
			</ul>
		</div>
	</nav>
</header>