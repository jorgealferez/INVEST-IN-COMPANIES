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

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 13,
            disableDefaultUI: true
        });

        var geocoder = new google.maps.Geocoder;
        geocoder.geocode({
            'address': 'Calle Diego de León, 50 Madrid'
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
@endsection

@include('public.googlemaps')