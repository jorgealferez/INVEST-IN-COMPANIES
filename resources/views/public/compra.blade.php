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
				Tal vez te encanta la idea de ser tu propio jefe o hacer crecer un negocio exitoso. Comprar una compañía que ya está establecida
				puede ser un camino más rápido y más fácil que empezar de cero o la mejor alternativa para hacer crecer tu negocio, conseguir
				mayor cobertura geográfica o integrar nuevas líneas de negocio.
			</p>
		</div>
	</div>
	<div class="row mt-5">
		<div class="col-lg-6">
			<p>
				No son escasas las razones por las que se decide comprar una empresa:
			</p>
			<ul>
				<li>
					Satisfacer la iniciativa emprendedora a través de una empresa ya en marcha en lugar de crear una nueva.
				</li>
				<li>
					Consolidar la posición de dominio en el sector: Integrando a un competidor y reforzando la presencia de la empresa en el
					mercado.
				</li>
				<li>
					Disfrutar de ventajas vinculadas a una ampliación de dimensión tales como:
					<ul>
						<li>La reducción y el reparto de costes de estructura.</li>
						<li>La mayor y mejor posición de negociación con terceros.</li>
					</ul>
				</li>
				<li>
					Entrar en nuevos mercados: La empresa que compra le aporta diferentes redes comerciales, así como una cartera de clientes
					en un mercado en el que hasta ahora no tenía presencia.
				</li>
				<li>
					Diversificar la gama de producto, de tal forma que permita reducir riesgos, costes y retrasos asociados al desarrollo interno.
				</li>
				<li>
					Adquirir nuevas tecnologías reduciendo los períodos de aprendizaje.
				</li>
				<li>Aprovechar sinergias financieras.</li>
				<li>Sacar mayor y mejor rentabilidad al dinero.</li>
				<li>
					Obtener subvenciones o ayudas fiscales destinadas a reflotar a empresas en crisis, etc.)
				</li>
			</ul>
		</div>
		<div class="col-lg-6 mx-auto text-white p-3 bg-verdeOscuro mt-md-5 mt-lg-0 ">
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
			<h3 class="text-uppercase">{{ __('Servicios') }}</h3>
		</div>
	</div>
	<div class="row   text-justify">

		<div class="col-md-6 ">

			<div class="servicio">
				<h4 class="text-center">
					<i class="fas fa-chart-line"></i>Diseño estratégico <br>de crecimiento</h4>

				<div class="row">

					<div class="col-md-12">
						Analizamos el mercado anticipándonos las tendencias del mismo y a los derroteros de la innovación permitiendo definir los
						siguientes pasos estratégicos para mantener tu empresa en constante crecimiento.
					</div>
				</div>
			</div>

		</div>
		<div class="col-md-6 ">

			<div class="servicio">
				<h4 class="text-center">
					<i class="fas fa-users"></i>Búsqueda de <br>alianzas adecuadas</h4>

				<div class="row">

					<div class="col-md-12">
						Podemos detectar a las compañías mas adecuadas por tamaño, ubicación, posicionamiento entre otros factores para poder integrar
						en tu negocio.<br><br>
					</div>
				</div>
			</div>

		</div>
		<div class="col-md-6 ">

			<div class="servicio">
				<h4 class="text-center">
					<i class="mdi mdi-chart-bar"></i>Financiación <br>Corporativa</h4>

				<div class="row">

					<div class="col-md-12">
						Estructuramos la empresa para la venta facilitando el atractivo y la entrada al posible inversor mediante diferentes mecanismos
						de financiación.<br>
					</div>

				</div>
			</div>

		</div>

		<div class="col-md-6 ">

			<div class="servicio">
				<h4 class="text-center">
					<i class="far fa-handshake"></i>Proceso de <br>negociación y cierre</h4>

				<div class="row">

					<div class="col-md-12">
						Velamos por la imparcialidad del proceso, asegurando el juego limpio de la operación y que la decisión que tomes hoy sea
						de tu total conformidad.
					</div>

				</div>
			</div>

		</div>

	</div>
</div>
@endsection
 
@section('scripts')
@endsection