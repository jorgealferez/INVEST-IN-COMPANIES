<div id="myCarousel" class="carousel slide mb-0" data-ride="carousel">
	<ol class="carousel-indicators">
		<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		<li data-target="#myCarousel" data-slide-to="1" class=""></li>
		<li data-target="#myCarousel" data-slide-to="2" class=""></li>
	</ol>

	<div class="carousel-inner">

		<div class="carousel-item active  ">
			<img src="images/slider/home1.jpg" alt="">

			<div class="container">

				<div class="carousel-caption text-left w-50">
					<h1>Un plan para el futuro de las PYMES</h1>
					<p>Proporcionamos alternativas a los emprendedores, empresarios e inversores fomentando y apoyando los procesos de transmisión
						de empresas</p>
					<a class="btn-invest" href="{{ route('vendeEmpresa') }}" role="button">Ver más</a>
				</div>
			</div>
		</div>

		<div class="carousel-item">

			<img src="images/slider/home2.jpg" alt="" srcset="">

			<div class="container">

				<div class="carousel-caption text-left w-50">
					<h1>Un plan para tu futuro profesional</h1>
					<p>
						Invest in Companies te ofrece una valiosa oportunidad para emprendedores y empresarios para entrar en nuevos mercados o sectores.
					</p>
					<a class="btn-invest" href="{{ route('compraEmpresa') }}" role="button">Ver más</a>
				</div>
			</div>
		</div>

		<div class="carousel-item  ">

			<img src="images/slider/home3.jpg" alt="">

			<div class="container">

				<div class="carousel-caption text-left w-50">
					<h1>Crece en buena compañía</h1>
					<p>El camino del emprendedor puede ser muy solitario, te acompañamos durante todo el proceso de crecimiento de tu negocio.
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