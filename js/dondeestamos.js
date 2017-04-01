var geocoder;
var map;
var mapaContacto;
var mapaInmueble;
var canvasMapa = document.getElementById('mapa');
var canvasMapaContacto = document.getElementById('mapa-contacto');
var canvasMapaInmueble = document.getElementById('mapa-inmueble');

function initMap() {
  geocoder = new google.maps.Geocoder();
  var mapOptions = {
    zoom: 17,
    center: {lat: 38.875685, lng: -6.968221},
    zoomControl: true,
    mapTypeControl: true,
    scaleControl: false,
    streetViewControl: false,
    scrollwheel: false,
  }

  var mapOptions2 = {
    zoom: 17,
    zoomControl: true,
    mapTypeControl: true,
    scaleControl: false,
    streetViewControl: false,
    scrollwheel: false,
  }

  if (canvasMapa) {
    map = new google.maps.Map(canvasMapa, mapOptions);
    marker = new google.maps.Marker({
      position: {lat: 38.875685, lng: -6.968221},
      map: map
    });
  }

  if (canvasMapaContacto) {
    mapaContacto = new google.maps.Map(canvasMapaContacto, mapOptions);
    marker2 = new google.maps.Marker({
      position: {lat: 38.875685, lng: -6.968221},
      map: mapaContacto
    });
  }

  if (canvasMapaInmueble) {
    mapaInmueble = new google.maps.Map(canvasMapaInmueble, mapOptions2);
    var direccion = document.getElementById('direccion-inmueble').innerHTML + ', ' + document.getElementById('provincia-inmueble').innerHTML + ', ' + document.getElementById('localidad-inmueble').innerHTML;
    geocoder.geocode( { 'address': direccion}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        mapaInmueble.setCenter(results[0].geometry.location);
        var marker = new google.maps.Marker({
          map: mapaInmueble,
          position: results[0].geometry.location
        });
      } else {
        canvasMapaInmueble.innerHTML = '<div class="alert alert-danger">El mapa no está disponible en estos momentos</div>';
      }
    });
  }
}
