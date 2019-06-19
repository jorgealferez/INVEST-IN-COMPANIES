@extends('layouts.public') 
@section('contenido')



<div class="container  pt-0">

	<div class="row">

		<div class="col-md-12  text-center p-5">
			<h2 class="text-uppercase">{{ __('Puntos de atención') }}</h2>
</div>
</div>

<div class="row pb-5">

	<div class="col-md-12 ">

		<div id="map"></div>

	</div>
</div>
</div>
@endsection
  
@section('scripts')

<script>
	
    function initMap() {
        var madrid = {lat: 40.4346123, lng: -3.6788531};
        var asociacion1 = {lat: 37.7724074, lng: -3.7883089}; /* Federación Empresarial Jienense de Comercio y Servicios */
        var asociacion2 = {lat: 39.859385, lng: -4.034994}; /* FEDETO */
        var asociacion3 = {lat: 41.662611, lng: -0.890057}; /* CEOE Aragón */
        var asociacion4 = {lat: 41.6683213, lng: -4.7174531}; /* Cámara de Contratistas de Castilla y León */
        var asociacion5 = {lat: 42.8457648, lng: -2.6732935}; /* SEA Empresas Alavesas */
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 6,
          center: madrid,
          styles: [
                {
                  "elementType": "geometry",
                  "stylers": [
                    {
                      "color": "#f5f5f5"
                    }
                  ]
                },
                {
                  "elementType": "labels.icon",
                  "stylers": [
                    {
                      "visibility": "off"
                    }
                  ]
                },
                {
                  "elementType": "labels.text.fill",
                  "stylers": [
                    {
                      "color": "#616161"
                    }
                  ]
                },
                {
                  "elementType": "labels.text.stroke",
                  "stylers": [
                    {
                      "color": "#f5f5f5"
                    }
                  ]
                },
                {
                  "featureType": "administrative.land_parcel",
                  "elementType": "labels.text.fill",
                  "stylers": [
                    {
                      "color": "#bdbdbd"
                    }
                  ]
                },
                {
                  "featureType": "poi",
                  "elementType": "geometry",
                  "stylers": [
                    {
                      "color": "#eeeeee"
                    }
                  ]
                },
                {
                  "featureType": "poi",
                  "elementType": "labels.text.fill",
                  "stylers": [
                    {
                      "color": "#757575"
                    }
                  ]
                },
                {
                  "featureType": "poi.park",
                  "elementType": "geometry",
                  "stylers": [
                    {
                      "color": "#e5e5e5"
                    }
                  ]
                },
                {
                  "featureType": "poi.park",
                  "elementType": "labels.text.fill",
                  "stylers": [
                    {
                      "color": "#9e9e9e"
                    }
                  ]
                },
                {
                  "featureType": "road",
                  "elementType": "geometry",
                  "stylers": [
                    {
                      "color": "#ffffff"
                    }
                  ]
                },
                {
                  "featureType": "road.arterial",
                  "elementType": "labels.text.fill",
                  "stylers": [
                    {
                      "color": "#757575"
                    }
                  ]
                },
                {
                  "featureType": "road.highway",
                  "elementType": "geometry",
                  "stylers": [
                    {
                      "color": "#dadada"
                    }
                  ]
                },
                {
                  "featureType": "road.highway",
                  "elementType": "labels.text.fill",
                  "stylers": [
                    {
                      "color": "#616161"
                    }
                  ]
                },
                {
                  "featureType": "road.local",
                  "elementType": "labels.text.fill",
                  "stylers": [
                    {
                      "color": "#9e9e9e"
                    }
                  ]
                },
                {
                  "featureType": "transit.line",
                  "elementType": "geometry",
                  "stylers": [
                    {
                      "color": "#e5e5e5"
                    }
                  ]
                },
                {
                  "featureType": "transit.station",
                  "elementType": "geometry",
                  "stylers": [
                    {
                      "color": "#eeeeee"
                    }
                  ]
                },
                {
                  "featureType": "water",
                  "elementType": "geometry",
                  "stylers": [
                    {
                      "color": "#c9c9c9"
                    }
                  ]
                },
                {
                  "featureType": "water",
                  "elementType": "labels.text.fill",
                  "stylers": [
                    {
                      "color": "#9e9e9e"
                    }
                  ]
                }
              ]
        });
        
        
        <!-- SEDE CEPYME --/>
        
        
        var cepyme = new google.maps.Marker({
            position: madrid,
            map: map,
            icon: 'images/ico-maps.png',
            title: 'CEPYME'
        });
        
        var contentString = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h3 id="cepyme" class="firstHeading">CEPYME</h3>'+
            '<div id="bodyContent">'+
            '<p><b>Dirección:</b> Calle de Diego de León, 50, 28006 Madrid<br/><b>Teléfono:</b>914 11 61 61</p>'+
            '</div>'+
            '</div>';

        var infowindow = new google.maps.InfoWindow({
          content: contentString
        });
        
        cepyme.addListener('click', function() {
          infowindow.open(map, cepyme);
        });
        <!-- SEDE CEPYME --/>
        
        
        <!-- ASOCIACION 1 --/>
        
        
        var asociacion1 = new google.maps.Marker({
            position: asociacion1,
            map: map,
            icon: 'images/ico-maps.png',
            title: 'Las Rozas'
        });
        
        var contentAsociacion1 = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h3 id="cepyme" class="firstHeading">Federación Empresarial Jienense de Comercio y Servicios</h3>'+
            '<div id="bodyContent">'+
            '<p><b>Dirección:</b> Avenida de Madrid, 32-Entreplanta 23003 Jaén<br/><b>Teléfono:</b>953 25 86 31<br/><b>Email:</b>comerciojaen@comerciojaen.com</p>'+
            '</div>'+
            '</div>';

        var windowsAsociacion1 = new google.maps.InfoWindow({
          content: contentAsociacion1
        });
        
        asociacion1.addListener('click', function() {
          windowsAsociacion1.open(map, asociacion1);
        });
        <!-- ASOCIACION 1 --/>
        
        <!-- ASOCIACION 2 --/>
        
        
        var asociacion2 = new google.maps.Marker({
            position: asociacion2,
            map: map,
            icon: 'images/ico-maps.png',
            title: 'FEDETO'
        });
        
        var contentAsociacion2 = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h3 id="cepyme" class="firstHeading">Federación Empresarial Toledana FEDETO</h3>'+
            '<div id="bodyContent">'+
            '<p><b>Dirección:</b> Paseo de Recaredo 1, Toledo<br/><b>Teléfono:</b>925 228 710<br/><b>Email:</b>ernestogarcia@fedeto.es</p>'+
            '</div>'+
            '</div>';

        var windowsAsociacion2 = new google.maps.InfoWindow({
          content: contentAsociacion2
        });
        
        asociacion2.addListener('click', function() {
          windowsAsociacion2.open(map, asociacion2);
        });
        <!-- ASOCIACION 2 --/>
        
        <!-- ASOCIACION 3 --/>
        
        
        var asociacion3 = new google.maps.Marker({
            position: asociacion3,
            map: map,
            icon: 'images/ico-maps.png',
            title: 'CEOE Aragón'
        });
        
        var contentAsociacion3 = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h3 id="cepyme" class="firstHeading">CEOE Aragón</h3>'+
            '<div id="bodyContent">'+
            '<p><b>Dirección:</b> Avd. Jose Atares 20 50018 Zaragoza<br/><b>Teléfono:</b>976 460 066<br/><b>Email:</b>calvarez@ceoearagon.es</p>'+
            '</div>'+
            '</div>';

        var windowsAsociacion3 = new google.maps.InfoWindow({
          content: contentAsociacion3
        });
        
        asociacion3.addListener('click', function() {
          windowsAsociacion3.open(map, asociacion3);
        });
        <!-- ASOCIACION 3 --/>
        
        <!-- ASOCIACION 4 --/>
        
        
        var asociacion4 = new google.maps.Marker({
            position: asociacion4,
            map: map,
            icon: 'images/ico-maps.png',
            title: 'Cámara de Contratistas de Castilla y León'
        });
        
        var contentAsociacion4 = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h3 id="cepyme" class="firstHeading">Cámara de Contratistas de Castilla y León</h3>'+
            '<div id="bodyContent">'+
            '<p><b>Dirección:</b> C/ Valle de Arán, 5 47010 Valladolid<br/><b>Teléfono:</b>982 252 210<br/><b>Email:</b>camara@ccontratistascyl.es</p>'+
            '</div>'+
            '</div>';

        var windowsAsociacion4 = new google.maps.InfoWindow({
          content: contentAsociacion4
        });
        
        asociacion4.addListener('click', function() {
          windowsAsociacion4.open(map, asociacion4);
        });
        <!-- ASOCIACION 4 --/>
        
        <!-- ASOCIACION 5 --/>
        
        
        var asociacion5 = new google.maps.Marker({
            position: asociacion5,
            map: map,
            icon: 'images/ico-maps.png',
            title: 'SEA Empresas Alavesas'
        });
        
        var contentAsociacion5 = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h3 id="cepyme" class="firstHeading">SEA Empresas Alavesas</h3>'+
            '<div id="bodyContent">'+
            '<p><b>Dirección:</b> Pasaje Postas 32, 7ª planta Vitoria-Gasteiz (Alava)<br/><b>Teléfono:</b>945 000 400<br/><b>Email:</b>sea@sea.es</p>'+
            '</div>'+
            '</div>';

        var windowsAsociacion5 = new google.maps.InfoWindow({
          content: contentAsociacion5
        });
        
        asociacion5.addListener('click', function() {
          windowsAsociacion5.open(map, asociacion5);
        });
        <!-- ASOCIACION 5 --/>
        
      }

</script>

@include('public.googlemaps')

@endsection


