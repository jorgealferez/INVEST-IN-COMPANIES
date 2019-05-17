@extends('layouts.public') 
@section('contenido')


<div class="container my-5">

	<div class="row">

		<div class="col-md-12  text-center p-5">
			<h2 class="text-uppercase">{{ __('Busca un socio') }}</h2>
		</div>
	</div>

	<div class="row   text-justify">

		<div class="col-md-4">
			<img src="images/pic/partner.jpg" alt="" class="img-fluid img-thumbnail">
		</div>

		<div class="col-md-8">
			<ul class="lista text-justify">
				<li>
					<i class="fas fa-check"></i>¿La falta de medios financieros, organizativos o técnicos te 
                                        impiden continuar con tu proyecto?
				</li>
				<li>
					<i class="fas fa-check"></i>¿Necesitas obtener liquidez?
				</li>
                                <li>
                                        <i class="fas fa-check"></i>¿La obsolescencia tecnológica te obliga a realizar inversiones 
                                        que no puedes afrontar?
                                </li>
			</ul>


		</div>

	</div>

	<div class="row mt-5 text-justify">

		<div class="col-md-12">
			<p>La incorporación de un socio es un proceso complejo que requiere de un asesoramiento profesional por los 
                            múltiples factores que confluyen en el mismo, pero un nuevo socio puede suponer un gran aliado a tener 
                            muy en cuenta. Un socio es una persona o empresa que te va a acompañar durante mucho tiempo y con la que 
                            tendrás que tomar decisiones, ahora velando por el bien común.
                        </p>
                        <p>
                            Por ello, escoger al socio adecuado y sentar desde el inicio las bases de las reglas del juego, a través 
                            del pacto de socios, es casi tan importante como saber qué valor hay que darle a la parte de tu empresa que 
                            estás dispuesto a ceder a cambio de que entre un nuevo socio en tu compañía.
                        </p>

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
                                        Análisis de objetivos pretendidos con la incorporación de un socio y orientación a la 
                                        selección del inversor más adecuado
                                </div>
                        </div>
                </div>

        </div>

        <div class="bullet-col-5 flexlist-item">

                <div class="servicio">
                        <h4 class="text-center">
                                <i class="mdi mdi-chart-bar"></i>VALORACIÓN<br> DE EMPRESAS</h4>

                        <div class="row">

                                <div class="col-md-12">
                                        Orientación sobre los diferentes métodos de valoración.
                                </div>

                        </div>
                </div>

        </div>
        <div class="bullet-col-5 flexlist-item">

                <div class="servicio">
                        <h4 class="text-center">
                                <i class="mdi mdi-account-multiple-plus"></i>PROPUESTA<br> DE INVERSIÓN</h4>

                        <div class="row">

                                <div class="col-md-12">
                                        Orientación sobre la propuesta de inversión a un posible socio (porcentaje ofertado, 
                                        ventajas competitivas, etc).
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
                                <i class="far fa-handshake"></i>PUBLICACIÓN<br> DE LA OFERTA</h4>

                        <div class="row">

                                <div class="col-md-12">
                                        Publicación de la propuesta de inversión visible para todos los inversores interesados.
                                </div>

                        </div>
                </div>

        </div>

</div>

<div class="container my-5">
    
</div>

<div class="container-fluid info py-5">
	<div class="container">
		<a name="formulario"></a>


		<div class="row row justify-content-center">
			<div class="col-md-12   p-5">
				<h2 class="text-uppercase text-center pb-5">{{ __('Busca un socio') }}</h2>
				<p class="text-center">Solicita más información sobre la búsqueda de socios para su empresa.</p>
			</div>
			<div class="col-md-3 text-right">
				<div class="row">

					<div class="col-md-12 py-3">
						<a href="mailto:{{ Config::get('app.email') }}" target="_blank"><i class="fa fa-envelope"></i> {{ Config::get('app.email') }}</a>
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