@extends('layouts.public') 
@section('contenido')


<div class="container my-5">

	<div class="row">

		<div class="col-md-12  text-center p-5">
			<h2 class="text-uppercase">{{ __('Vende tu empresa') }}</h2>
		</div>
	</div>

	<div class="row   text-justify">

		<div class="col-md-5">
			<img src="images/about2.jpg" alt="" class="img-fluid img-thumbnail">
		</div>

		<div class="col-md-7">
			<ul class="lista text-justify">
				<li>
					<i class="fas fa-check"></i>¿Se aproxima la edad de jubilación y no cuentas con herederos que quieran
					<strong>continuar con la actividad</strong> de la empresa?
				</li>
				<li>
					<i class="fas fa-check"></i>¿Ha llegado el momento de recoger los frutos del trabajo de tantos años de sacrificio?
				</li>
			</ul>


		</div>

	</div>

	<div class="row mt-5 text-justify">

		<div class="col-md-12">
			<p>Puede que alguna o varias de estas razones sean la causa de la venta. La decisión de vender una empresa es posiblemente
				una de las decisiones más difíciles en la vida de un empresario. Por otra parte, el propio proceso de transmisión de
				empresas se considera como la principal barrera para la conclusión de contratos de compraventa de empresas. Este problema
				se pone especialmente de manifiesto en caso de emprendedores y pequeñas empresas, ya que las grandes empresas pueden
				normalmente encontrar sin excesivos problemas el asesoramiento fiscal y legal apropiado.</p>

		</div>
	</div>

	<div class="row text-justify">

		<div class="col-md-12">
			<p>En cualquier caso, una vez tomada la decisión, lo importante es hacerlo de la forma adecuada, entendiendo y aplicando
				la normativa vigente en esta materia, ¿y qué mejor manera que hacerlo de la mano de CEPYME y Grupo PGS?.</p>

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
					<i class="mdi mdi-seal"></i>Valoración<br> de empresas</h4>

				<div class="row">

					<div class="col-md-12">
						Poseemos larga experiencia en el proceso de valoración de empresas, utilizando diferentes métodos de valoración y optimizando
						el mismo para ajustarnos a la demanda del mercado y a las expectativas del vendedor.
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
						de financiación.<br><br>
					</div>

				</div>
			</div>

		</div>
		<div class="col-md-6 ">

			<div class="servicio">
				<h4 class="text-center">
					<i class="mdi mdi-account-multiple-plus"></i>Búsqueda <br>de Inversores</h4>

				<div class="row">

					<div class="col-md-12">
						Tenemos acceso al mercado mas activo y con mayor capacidad inversora, buscando al comprador más adecuado.<br><br>
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

<div class="container-fluid info py-5">
	<div class="container">
		<a name="formulario"></a>


		<div class="row row justify-content-center">
			<div class="col-md-12   p-5">
				<h2 class="text-uppercase text-center pb-5">{{ __('Vende tu empresa') }}</h2>
				<p class="text-justify">Con la Plataforma Invest in Companies, lograrás sortear los problemas que encontrarías por el camino de la venta, si
					lo recorrieses solo, y estarías acompañado y asesorado en todo momento por grandes profesionales y especialistas en
					el sector.</p>
			</div>
			<div class="col-md-3 text-right">
				<div class="row">

					<div class="col-md-12 py-3">
						<a href="mailto:{{ Config::get('app.email') }}" target="_blank"><i class="fa fa-envelope"></i> {{ Config::get('app.email') }}</a>
					</div>

					<div class="col-md-12 py-3">
						<i class="fa fa-phone"></i>
						<p>91 411 61 61</p>
					</div>

				</div>
			</div>
			<div class="col-md-5">
				@if (session()->has('enviado'))

				<div class="row">

					<div class="col-md-12 pt-4">
						<h4>{{ __('Gracias por ponerte en contacto con nosotros') }}</h4>
						{{ __('en breve nos pondremos en contacto contigo.') }}
					</div>
				</div>
				@else
				<form method="POST" class="" action="{{ action('PublicController@vendeContacto')}}">
					@csrf @method('PUT')
					<input type="hidden" name="tab" value="modificar">

					<div class="row">

						<div class="col-md-12">

							<div class="form-group {{ $errors->has('name') ? ' has-danger' : '' }}">
								<input placeholder="{{ __('Nombre y apellidos') }}" type="text " value="{{ ((old( 'name')) ? old( 'name') : $request->name ) }}"
								 class="form-control form-control-line
                                            {{ $errors->has('name') ? ' is-invalid'
                                        : '' }}" id="name" name="name" required> @if ($errors->has('name'))

								<div class="col-md-12 invalid-feedback">{{ $errors->first('name') }}</div>
								@endif

							</div>
						</div>


						<div class="col-md-12">

							<div class="form-group {{ $errors->has('email') ? ' has-danger' : '' }}">
								<input placeholder="{{ __('Email de contacto') }}" type="email " name="email" id="email" class="form-control form-control-line {{ $errors->has('email') ? ' is-invalid' : '' }}"
								 value="{{ ((old( 'email')) ? old( 'email') : $request->email ) }}"> @if ($errors->has('email'))

								<div class="invalid-feedback">{{ $errors->first('email') }}</div>
								@endif

							</div>
						</div>

						<div class="col-md-12">

							<div class="form-group {{ $errors->has('phone') ? ' has-danger' : '' }}">
								<input placeholder="{{ __('Teléfono') }}" type="text " name="phone" id="phone" class="form-control form-control-line {{ $errors->has('phone') ? ' is-invalid' : '' }}"
								 maxlength="9" value="{{ ((old( 'phone')) ? old( 'phone') : $request->phone ) }}">@if ($errors->has('phone'))

								<div class="invalid-feedback">{{ $errors->first('phone') }}</div>
								@endif

							</div>
						</div>
					</div>


					<div class="row py-4">

						<div class="col-md-12 ">

							<div class="form-group">
								<button class="btn-invest bg-transparent text-uppercase verde">{{ __('Enviar') }}</button>

							</div>
						</div>
					</div>
				</form>
				@endif
			</div>


		</div>
	</div>


</div>
@endsection
 
@section('scripts')
@endsection