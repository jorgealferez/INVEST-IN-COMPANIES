@extends('layouts.public') 
@section('contenido')


<div class="container my-5">

	<div class="row">

		<div class="col-md-12  text-center p-5">
			<h2 class="text-uppercase">{{ __('Busca un socio') }}</h2>
		</div>
	</div>

	<div class="row   text-justify">

		<div class="col-md-5">
			<img src="images/about2.jpg" alt="" class="img-fluid img-thumbnail">
		</div>

		<div class="col-md-7">
			<ul class="lista text-justify">
				<li>
					<i class="fas fa-check"></i>¿La falta de <strong>medios financieros, organizativos o técnicos</strong> te impiden continuar
					con tu proyecto?
				</li>
				<li>
					<i class="fas fa-check"></i>¿Necesitas obtener <strong>liquidez</strong>?
				</li>
				<li>
					<i class="fas fa-check"></i>¿La <strong>obsolescencia tecnológica</strong> te obliga a realizar inversiones que no puedes
					afrontar?
				</li>
			</ul>


		</div>

	</div>

	<div class="row mt-5 text-justify">

		<div class="col-md-12">
			<p>La incorporación de un socio es un proceso complejo que requiere de un asesoramiento profesional por los múltiples factores
				que confluyen en el mismo, pero un nuevo socio puede suponer un gran aliado a tener muy en cuenta. Un socio es una persona
				o empresa que te va a acompañar durante mucho tiempo y con la que tendrás que tomar decisiones ahora velando por el bien
				común.
			</p>

		</div>
	</div>

	<div class="row text-justify">

		<div class="col-md-12">
			<p>Por ello, escoger al socio adecuado y sentar desde el inicio las bases de las reglas del juego (con el pacto de socios)
				es casi tan importante como saber qué valor hay que darle a la parte de tu empresa que estás dispuesto a ceder a cambio
				de que entre un nuevo socio en tu compañía.</p>

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
					<i class="mdi mdi-currency-eur"></i>Financiación Corporativa</h4>

				<div class="row">

					<div class="col-md-12">
						Estructuramos la empresa para la entrada de un nuevo socio pudiendo por un lado maximizar el valor de la compañía y por otro
						asegurar al socio entrante el retorno de su inversión.<br><br>
					</div>
				</div>
			</div>

		</div>

		<div class="col-md-6 ">

			<div class="servicio">
				<h4 class="text-center">
					<i class="mdi mdi-chart-line"></i>Valoración de empresas</h4>

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
					<i class="mdi mdi-certificate"></i>Búsqueda de Inversores adecuados</h4>

				<div class="row">

					<div class="col-md-12">
						Encontramos al socio mas adecuado para poder constituir un equipo directivo con el potencial suficiente para hacer crecer
						tu negocio y llevarlo al punto estratégico que necesitas.
					</div>

				</div>
			</div>

		</div>

		<div class="col-md-6 ">

			<div class="servicio">
				<h4 class="text-center">
					<i class="fas fa-handshake"></i>Preparación del pacto de socios</h4>

				<div class="row">

					<div class="col-md-12">
						Te acompañamos en el proceso de negociación y cierre de la operación, así como en el diseño del marco regulatorio por el
						que se van a regir las relaciones futuras de los nuevos socios.<br><br>
					</div>

				</div>
			</div>

		</div>

	</div>

</div>
@endsection
 
@section('scripts')
@endsection