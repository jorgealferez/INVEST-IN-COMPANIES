@extends('layouts.public') 
@section('contenido')


<div class="container my-5">

	<div class="row">

		<div class="col-md-12  text-center p-5">
			<h2 class="text-uppercase">{{ __('Noticias') }}</h2>
		</div>
	</div>

	<div class="row   text-justify">

		<div class="row pb-5 pt-5">

                        <div class="col-lg-4 text-center equal">
                                <img src="images/slider/noticia1.jpg" alt="" class="img-fluid mx-auto">
                                <h3 class="pt-5 pb-2 text-center ">Una de las razones que mantienen la compra de empresas en España</h3>
                                <p class="p-3 text-justify ">Muchas empresas españolas son fruto del gran crecimiento del país después de la
                                        crisis de los años 70. Sus propietarios
                                        están en edad de jubilación y muchos no tienen sucesión, con lo que su única alternativa es la venta de
                                        la sociedad a
                                        capitales externos para mantener el negocio en funcionamiento obteniendo además liquidez.</p>
                        </div>

                        <div class="col-lg-4  text-center equal">
                                <img src="images/slider/noticia2.jpg" alt="" class="img-fluid">
                                <h3 class="pt-5 pb-2 text-center">Empresas Unicornio,<br> en busca de <br>la nueva Apple</h3>
                                <p class="p-3 text-justify">El término de unicornio se aplica a las empresas que consiguen un valor superior
                                        a 1.000 millones de dólares en su etapa
                                        inicial (un billón, en términos anglosajones). Esta gran cifra, tan mitológica como el animal, en un
                                        período de tiempo
                                        relativamente corto, sólo es alcanzada por empresas que tienen un negocio potencial muy grande, empresas
                                        con grandes
                                        expectativas.
                                </p>
                        </div>

                        <div class="col-lg-4  text-center equal">
                                <img src="images/slider/noticia3.jpg" alt="" class="img-fluid">
                                <h3 class="pt-5 pb-2 text-center">Las empresas no pueden ser una oficina de empleo para los propietarios
                                </h3>
                                <p class="p-3 text-justify">En sus manos, como CEO de Vidal Golosinas -consejero delegado-, está seguir
                                        liderando un legado empresarial de más de
                                        medio siglo. Francisco José Hernández Arnaldos, 53 años, padre de tres hijos, desempeña también el
                                        puesto de vicepresidente
                                        con el reto de seguir haciendo crecer a una empresa que es todo un referente en Molina de Segura y en la
                                        Región.</p>
                        </div>
                </div>

	</div>
    
	<div class="row text-justify mb-5">


	</div>


</div>
@endsection
 
@section('scripts')
@endsection