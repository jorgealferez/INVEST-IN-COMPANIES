@extends('layouts.public')
@section('contenido')
@include('public.carrusel')

<div class="container  pt-0 pb-5">

	<div class="row">

		<div class="col-md-12  text-center p-5">
			<h2 class="text-uppercase">Noticias</h2>
		</div>
	</div>

	<div class="row pb-5">

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
	<!-- /.col-lg-4 -->
</div>
<!-- /.row -->


<div class="featurette bg-primary">
	<form method="POST" class="" action="{{ route('buscador') }}">
		@csrf @method('POST')


		<div class="container">

			<div class="row">

				<div class="col-md-12  px-5 pt-5 pb-3">
					<h2 class=" text-uppercase text-center text-white mx-auto">Buscador</h2>
				</div>
			</div>

			<div class="row py-0 px-0">

				<div class="col-md-3 ">

					<div class="form-group ">
						<label for="asociacion_id"
							class="col-md-12 col-form-label text-white text-uppercase text-left">{{ __('Entidades Colaboradoras') }}</label>

						<div class="col-md-12">
							<select name="asociacion_id" id="asociacion_id" class="form-control ">
								<option value="0">{{ __('Todas') }}</option>
								@foreach ($asociaciones as $asociacion)
								<option value="{{ $asociacion->id }}">{{ $asociacion->name }}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>

				<div class="col-md-3 ">

					<div class="form-group ">
						<label for="provincia_id"
							class="col-md-12 col-form-label text-white text-uppercase text-left">{{ __('Provincia') }}</label>

						<div class="col-md-12">
							<select name="provincia_id" id="provincia_id" class="form-control ">
								<option value="0">{{ __('Todas') }}</option>
								@foreach ($provincias as $provincia)
								<option value="{{ $provincia->id }}">{{ $provincia->name }}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>

				<div class="col-md-3 ">

					<div class="form-group ">
						<label for="sector_id"
							class="col-md-12 col-form-label text-white text-uppercase text-left">{{ __('Sector') }}</label>

						<div class="col-md-12">
							<select name="sector_id" id="sector_id" class="form-control ">
								<option value="0">{{ __('Todos') }}</option>
								@foreach ($sectores as $sector)
								<option value="{{ $sector->id }}">{{ $sector->name }}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>

				<div class="col-md-3 ">

					<div class="form-group ">
						<label for="precio"
							class="col-md-12 col-form-label text-white text-uppercase text-left">{{ __('Precio') }}</label>

						<div class="col-md-12">
							<select name="precio" id="precio" class="form-control ">
								<option value="0">{{ __('Selecciona cantidad') }}</option>
								@foreach ($precios as $precio)
								<option value="{{ $precio->value }}">{{ $precio->name }}</option>
								@endforeach
							</select>
						</div>
					</div>

				</div>
			</div>

			<div class="row">

				<div class="col-md-12 text-center p-5">
					<button class="btn-invest d-inline-block bg-transparent text-uppercase fa-1x"
						type="submit">{{ __('Buscar') }}</button>
				</div>
			</div>
		</div>
	</form>
</div>

{{--
<div class="container  pt-0">

	<div class="row">

		<div class="col-md-12  text-center p-5">
			<h2 class="text-uppercase">{{ __('Puntos de atención') }}</h2>
</div>
</div>

<div class="row">

	<div class="col-md-12 ">

		<div id="map"></div>

	</div>
</div>
</div> --}}


<hr class="featurette-divider mb-0"> {{--
<div class="featurette bg-gris py-5">

	<div class="container">

		<div class="row">

			<div class="col-md-12   px-5 pt-5 pb-3" ">
                <h4 class=" text-center text-uppercase ">{{ __('Patrocinadores') }}</h4>
</div>
</div>
<div class=" row patrocinadores ">
	<div class=" col-md-2 col-sm-6 mx-auto text-center p-2 ">
		<img src=" images/patrocinador1.png " alt=" " class=" img-fluid mx-auto ">
	</div>
	<div class=" col-md-2 col-sm-6 mx-auto text-center p-2 ">
		<img src=" images/patrocinador1.png " alt=" " class=" img-fluid mx-auto ">
	</div>
	<div class=" col-md-2 col-sm-6 mx-auto text-center p-2 ">
		<img src=" images/patrocinador1.png " alt=" " class=" img-fluid mx-auto ">
	</div>
	<div class=" col-md-2 col-sm-6 mx-auto text-center p-2 ">
		<img src=" images/patrocinador1.png " alt=" " class=" img-fluid mx-auto ">
	</div>
	<div class=" col-md-2 col-sm-6 mx-auto text-center p-2 ">
		<img src=" images/patrocinador1.png " alt=" " class=" img-fluid mx-auto ">
	</div>
	<div class=" col-md-2 col-sm-6 mx-auto text-center p-2 ">
		<img src=" images/patrocinador1.png " alt=" " class=" img-fluid mx-auto ">
	</div>
</div>
</div>
<div class=" container ">
	<div class=" row ">
		<div class=" col-md-12 px-5 pt-5 pb-3 " ">
				<h4 class=" text-center text-uppercase ">{{ __('Patrocinadores') }}</h4>
			</div>
		</div>

		<div class=" row patrocinadores pb-5">

			<div class="col-md-2 col-sm-6 mx-auto text-center p-2 ">
				<img src="images/patrocinador1.png " alt=" " class="img-fluid mx-auto ">
			</div>

			<div class="col-md-2 col-sm-6 mx-auto text-center p-2 ">
				<img src="images/patrocinador1.png " alt=" " class="img-fluid mx-auto ">
			</div>

			<div class="col-md-2 col-sm-6 mx-auto text-center p-2 ">
				<img src="images/patrocinador1.png " alt=" " class="img-fluid mx-auto ">
			</div>

			<div class="col-md-2 col-sm-6 mx-auto text-center p-2 ">
				<img src="images/patrocinador1.png " alt=" " class="img-fluid mx-auto ">
			</div>

			<div class="col-md-2 col-sm-6 mx-auto text-center p-2 ">
				<img src="images/patrocinador1.png " alt=" " class="img-fluid mx-auto ">
			</div>

			<div class="col-md-2 col-sm-6 mx-auto text-center p-2 ">
				<img src="images/patrocinador1.png " alt=" " class="img-fluid mx-auto ">
			</div>
		</div>
	</div>
</div> --}}
@endsection

@section('scripts') {{--
<script>
	function initMap() {

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 13,
            disableDefaultUI: true
        });

        var geocoder = new google.maps.Geocoder;
        geocoder.geocode({
            'address': 'Madrid'
        }, function (results, status) {
            if (status === 'OK') {
                map.setCenter(results[0].geometry.location);
                map.setOptions({
                    styles: styles['silver']
                });
                new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location,
                    icon: 'images/ico-maps.png',
                });
            } else {
                window.alert('Geocode was not successful for the following reason: ' +
                    status);
            }
        });
        var styles = {
            default: null,
            silver: [{
                    elementType: 'geometry',
                    stylers: [{
                        color: '#f5f5f5'
                    }]
                },
                {
                    elementType: 'labels.icon',
                    stylers: [{
                        visibility: 'off'
                    }]
                },
                {
                    elementType: 'labels.text.fill',
                    stylers: [{
                        color: '#616161'
                    }]
                },
                {
                    elementType: 'labels.text.stroke',
                    stylers: [{
                        color: '#f5f5f5'
                    }]
                },
                {
                    featureType: 'administrative.land_parcel',
                    elementType: 'labels.text.fill',
                    stylers: [{
                        color: '#bdbdbd'
                    }]
                },
                {
                    featureType: 'poi',
                    elementType: 'geometry',
                    stylers: [{
                        color: '#eeeeee'
                    }]
                },
                {
                    featureType: 'poi',
                    elementType: 'labels.text.fill',
                    stylers: [{
                        color: '#757575'
                    }]
                },
                {
                    featureType: 'poi.park',
                    elementType: 'geometry',
                    stylers: [{
                        color: '#e5e5e5'
                    }]
                },
                {
                    featureType: 'poi.park',
                    elementType: 'labels.text.fill',
                    stylers: [{
                        color: '#9e9e9e'
                    }]
                },
                {
                    featureType: 'road',
                    elementType: 'geometry',
                    stylers: [{
                        color: '#ffffff'
                    }]
                },
                {
                    featureType: 'road.arterial',
                    elementType: 'labels.text.fill',
                    stylers: [{
                        color: '#757575'
                    }]
                },
                {
                    featureType: 'road.highway',
                    elementType: 'geometry',
                    stylers: [{
                        color: '#dadada'
                    }]
                },
                {
                    featureType: 'road.highway',
                    elementType: 'labels.text.fill',
                    stylers: [{
                        color: '#616161'
                    }]
                },
                {
                    featureType: 'road.local',
                    elementType: 'labels.text.fill',
                    stylers: [{
                        color: '#9e9e9e'
                    }]
                },
                {
                    featureType: 'transit.line',
                    elementType: 'geometry',
                    stylers: [{
                        color: '#e5e5e5'
                    }]
                },
                {
                    featureType: 'transit.station',
                    elementType: 'geometry',
                    stylers: [{
                        color: '#eeeeee'
                    }]
                },
                {
                    featureType: 'water',
                    elementType: 'geometry',
                    stylers: [{
                        color: '#c9c9c9'
                    }]
                },
                {
                    featureType: 'water',
                    elementType: 'labels.text.fill',
                    stylers: [{
                        color: '#9e9e9e'
                    }]
                }
            ],
        }
    }

</script>
	@include('public.googlemaps')--}}
@endsection