var image = "hikergreen32.png";
var mapIcon = "hiking map32.png";
var trailCoordinates = [];
var map;
var marker;
var polyline;
var path = [];
var is_tracking = false;
var lat;
var lng;

function initMap() {
  navigator.geolocation.getCurrentPosition(function(position) {
    lat = position.coords.latitude;
    lng = position.coords.longitude;

    getLat = document.getElementById('latitudewrap').innerHTML = lat;
    getLong = document.getElementById('longitudewrap').innerHTML = lng;

    map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: lat, lng: lng},
      zoom: 18
    });

    var currentPosition = new google.maps.Marker({
      position: {lat: lat, lng: lng},
      map: map,
      icon: image,
      title: 'You are here'
    });
  });
}

function startTracking() {
  is_tracking = true;
  document.getElementById("tracker").innerHTML = "<span class='spinner-border spinner-border-sm me-05' role='status' aria-hidden='true'></span> Tracking...";
  myLat = document.getElementById('latitudewrap').innerHTML;
  myLng = document.getElementById('longitudewrap').innerHTML;

  marker = new google.maps.Marker({
    position: {lat: myLat, lng: myLng},
    map: map,
    icon: mapIcon
  });

  polyline = new google.maps.Polyline({
    map: map,
    path: path,
    strokeColor: '#0000FF',
    strokeOpacity: 0.5,
    strokeWeight: 5
  });
  navigator.geolocation.watchPosition(updatePosition);
}

function updatePosition(position) {
  if (is_tracking) {
    myLat = document.getElementById('latitudewrap').innerHTML;
    myLng = document.getElementById('longitudewrap').innerHTML;
    var newPosition = new google.maps.LatLng(myLat, myLng);
    marker.setPosition(newPosition);
    path.push(newPosition);
    polyline.setPath(path);
  }
}

function endTracking() {
  is_tracking = false;
  var lastPosition = path[path.length - 1];
  var latitude = lastPosition.lat();
  var longitude = lastPosition.lng();
  $.post('save.php', { user_id: 123, latitude: latitude, longitude: longitude });
  var endMarker = new google.maps.Marker({
    position: lastPosition,
    map: map
  });
}

window.initMap = initMap;

