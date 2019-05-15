@extends('layouts.public') 
@section('contenido')

<div class="container my-5">
	<div class="row">
		<div class="col-md-12  text-center p-5">
			<h2 class="text-uppercase">{{ __("Compra una empresa") }}</h2>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<p>
				Tal vez te encanta la idea de ser tu propio jefe o hacer crecer un negocio exitoso. Comprar una compañía 
                                que ya está establecida puede ser un camino más rápido y más fácil que empezar de cero o la mejor 
                                alternativa para hacer crecer tu negocio, conseguir mayor cobertura geográca o integrar nuevas líneas de 
                                negocio.
			</p>
		</div>
	</div>
	<div class="row mb-5">
		<div class="col-lg-6">
			<p>
				No son escasas las razones por las que se decide comprar una empresa:
			</p>
			<ul>
				<li>Satisfacer la iniciativa emprendedora a través de una empresa ya en marcha en lugar de crear 
                                        una nueva.
                                </li>
                                <li>Consolidar la posición de dominio en el sector: Integrando a un competidor y reforzando la 
                                        presencia de la empresa en el mercado e incluso entrar en otros nuevos
                                </li>
                                <li>Disfrutar de ventajas vinculadas a una ampliación de dimensión tales como:
                                </li>
                                
                                        <ul>
                                                <li>La reducción y el reparto de costes de estructura.</li>
                                                <li>La mayor y mejor posición de negociación con terceros.</li>
                                        </ul>
                                
                                <li>Diversificar la gama de producto, adquirir nuevas tecnologías de tal forma que permita reducir riesgos</li>
                                <li>Aprovechar sinergias financieras.</li>
			</ul>
		</div>
		<div class="col-lg-6 mx-auto text-white p-3 bg-verde mt-md-5 mt-lg-0 ">
			@if (session()->has('enviado'))

			<div class="row h-100">
				<div class="col-md-12 text-center p-5 my-auto">
					<h3 class="text-white">{{ __("Gracias") }}</h3>
					{{ __("por ponerte en contacto con nosotros, en breve nos pondremos en contacto contigo.") }}
				</div>
			</div>
			@else

			<div class="row">
				<div class="col-md-12">
					<div class="card-body">
						<a name="formulario"></a>
						<h3 class="text-white mb-4 text-uppercase">Regístrate</h3>
						<form method="POST" action="{{ action('PublicController@registro') }}">
							@csrf

							<div class="form-group row">
								<div class="col-md-5">
									<label for="name" class="col-form-label ">{{
										__("Nombre")
									}}</label>

									<input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}"
									 required autofocus pl /> @if ($errors->has('name'))
									<span class="invalid-feedback" role="alert">
										<strong>{{ $errors->first('name') }}</strong>
									</span> @endif
								</div>

								<div class="col-md-7">
									<label for="surname" class="col-form-label  ">{{
										__("Apellidos")
									}}</label>
									<input id="surname" type="text" class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" name="surname" value="{{ old('surname') }}"
									 required autofocus /> @if ($errors->has('surname'))
									<span class="invalid-feedback" role="alert">
										<strong>{{ $errors->first('surname') }}</strong>
									</span> @endif
								</div>
							</div>

							<div class="form-group row">
								<div class="col-md-8">
									<label for="email" class="col-form-label ">{{
										__("E-Mail")
									}}</label>

									<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}"
									 required /> @if ($errors->has('email'))
									<span class="invalid-feedback" role="alert">
										<strong>{{ $errors->first('email') }}</strong>
									</span> @endif
								</div>

								<div class="col-md-4">
									<label for="phone" class="col-form-label ">{{
										__("Teléfono")
									}}</label>
									<input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}"
									 required maxlength="9" /> @if ($errors->has('phone'))
									<span class="invalid-feedback" role="alert">
										<strong>{{ $errors->first('phone') }}</strong>
									</span> @endif
								</div>
							</div>

							<div class="form-group row">
								<div class="col-md-6">
									<label for="password" class="col-form-label ">
										{{ __("Contraseña") }}
									</label>
									<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
									 required /> @if ($errors->has('password'))
									<span class="invalid-feedback" role="alert">
										<strong>{{ $errors->first('password') }}</strong>
									</span> @endif
								</div>

								<div class="col-md-6">
									<label for="password-confirm" class="col-form-label ">{{
										__("Confirma Contraseña")
									}}</label>
									<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required />
								</div>
							</div>

							<div class="form-group row mb-0 mt-5">
								<div class="col-md-12 text-right">
									<button type="submit" class="btn-invest d-inline-block bg-transparent text-uppercase fa-1x">
										{{ __("Registrarme") }}
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			@endif
		</div>
	</div>
	<div class="row">

		<div class="col-md-12  text-center p-5">
			<h3 class="text-uppercase">{{ __('Servicios gratuitos') }}</h3>
		</div>
	</div>
</div>

<div class="row text-justify bulletbox flexlist">

        <div class="bullet-col-5 flexlist-item">

                <div class="servicio">
                        <h4 class="text-center">
                                <i class="mdi mdi-seal"></i>ANÁLISIS<br> ESTRATÉGICO</h4>

                        <div class="row">

                                <div class="col-md-12">
                                        Análisis de objetivos pretendidos para realizar la compra de una nueva empresa y orientación
                                        a la búsqueda.
                                </div>
                        </div>
                </div>

        </div>

        <div class="bullet-col-5 flexlist-item">

                <div class="servicio">
                        <h4 class="text-center">
                                <i class="mdi mdi-chart-bar"></i>CONSIDERACIONES<br> CORPORATIVAS</h4>

                        <div class="row">

                                <div class="col-md-12">
                                        Orientación sobre formas de Financiación, valoración de la empresa y economías de escala.
                                </div>

                        </div>
                </div>

        </div>
        <div class="bullet-col-5 flexlist-item">

                <div class="servicio">
                        <h4 class="text-center">
                                <i class="mdi mdi-account-multiple-plus"></i>FASES<br> DEL PROCESO</h4>

                        <div class="row">

                                <div class="col-md-12">
                                        Orientación sobre las fases del proceso (lanzamiento de ofertas y negociación y cierre) y 
                                        condiciones de entrada.
                                </div>
                        </div>
                </div>

        </div>

        <div class="bullet-col-5 flexlist-item">

                <div class="servicio">
                        <h4 class="text-center">
                                <i class="far fa-handshake"></i>COSTES Y DURACIÓN<br> DEL PROCESO</h4>

                        <div class="row">

                                <div class="col-md-12">
                                        Asesoramiento para la búsqueda de los recursos de apoyo más adecuados para el proceso.
                                </div>

                        </div>
                </div>

        </div>
        <div class="bullet-col-5 flexlist-item">

                <div class="servicio">
                        <h4 class="text-center">
                                <i class="far fa-handshake"></i>REGISTRO<br> COMO INVERSOR</h4>

                        <div class="row">

                                <div class="col-md-12">
                                        Registro gratuito con un perfil de inversor en la plataforma de Invest in Companies para analizar
                                        todas las ofertas de venta vigentes.
                                </div>

                        </div>
                </div>

        </div>

</div>

<div class="container my-5">
    
</div>

@endsection
 
@section('scripts')
@endsection