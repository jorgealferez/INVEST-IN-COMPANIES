<div id="myCarousel" class="carousel slide mb-0" data-ride="carousel">
	<ol class="carousel-indicators">
		<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		<li data-target="#myCarousel" data-slide-to="1" class=""></li>
		<li data-target="#myCarousel" data-slide-to="2" class=""></li>
	</ol>

	<div class="carousel-inner">

		<div class="carousel-item carousel-item-next carousel-item-left">
			<img src="images/slider/home1.jpg" alt="">

			<div class="container">

				<div class="carousel-caption text-left w-25">
					<h1>Un plan para el futuro de las PYMES</h1>
					<p>Nuestro principal objetivo es asegurar la continuidad de negocios viables que, en proceso de transmisión, corren el
						riesgo de desaparecer y proporcionar alternativas a los emprendedores, empresarios y otros inversores fomentando y
						apoyando los procesos de transmisión de empresas</p>
					<a class="btn-invest" href="{{ route('vendeEmpresa') }}" role="button">Ver más</a>
				</div>
			</div>
		</div>

		<div class="carousel-item">

			<img src="images/slider/home2.jpg" alt="" srcset="">

			<div class="container">

				<div class="carousel-caption text-left w-25">
					<h1>Crece en buena compañía</h1>
					<p>El camino del emprendedor o empresario puede ser muy solitario, pero no tiene porqué ser así. Rodearte de un compañero
						o compañeros de viaje con los que compartas intereses comunes puede ser un gran aliciente para hacer crecer tu negocio
						exponencialmente.
					</p>
					<a class="btn-invest" href="{{ route('compraEmpresa') }}" role="button">Ver más</a>
				</div>
			</div>
		</div>

		<div class="carousel-item active carousel-item-left">

			<img src="images/slider/home3.jpg" alt="">

			<div class="container">

				<div class="carousel-caption text-right w-25">
					<h1>Crece en buena compañía</h1>
					<p>El camino del emprendedor o empresario puede ser muy solitario, pero no tiene porqué ser así. Rodearte de un compañero
						o compañeros de viaje con los que compartas intereses comunes puede ser un gran aliciente para hacer crecer tu negocio
						exponencialmente.
					</p>
					<a class="btn-invest" href="{{ route('socio') }}" role="button">Ver más</a>
				</div>
			</div>
		</div>
	</div>
	<a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
	<a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>