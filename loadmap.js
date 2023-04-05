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
      mapId: "5b73fae6a22953ae",
      center: {lat: lat, lng: lng},
      zoom: 18
    });

    var currentPosition = new google.maps.Marker({
      position: {lat: lat, lng: lng},
      map: map,
      icon:  {
      path: google.maps.SymbolPath.CIRCLE,
      scale: 10,
      fillColor: '#00FF00',
      fillOpacity: 1,
      strokeWeight: 1
    },
      title: 'You are here'
    });
  });
}

function startTracking() {
  is_tracking = true;
  document.getElementById("tracker").innerHTML = "<span class='spinner-grow spinner-grow-sm' role='status' aria-hidden='true'></span>";
  document.getElementById("cancel").innerHTML = "<a type='button' onclick='cancelTracking()' id='cancel-tracker' style='display: flex;flex-direction: column-reverse;flex-wrap: wrap;align-content: center;' class='btn btn-danger'> <i class='material-icons'>cancel</i></a>";
  document.getElementById("save").innerHTML = "<a type='button' onclick='endTracking()' id='cancel-tracker'style='display: flex;flex-direction: column-reverse;flex-wrap: wrap;align-content: center;' class='btn btn-blue '><i class='material-icons'>save</i> </a>"
  myLat = parseFloat(document.getElementById('latitudewrap').innerHTML);
  myLng = parseFloat(document.getElementById('longitudewrap').innerHTML);
    
  
  var startPosition = { lat: myLat, lng: myLng };
  path.push(startPosition); // add the starting position to the path array       
  
  marker = new google.maps.Marker({
    position: {lat: myLat, lng: myLng},
    map: map,
    icon: mapIcon
  });
  

  polyline = new google.maps.Polyline({
    map: map,
    path: path,
    strokeColor: '#0000FF',
    strokeOpacity: 1,
    strokeWeight: 5
  });
    
  //polyline.setPath(path);
   console.log(path);
  navigator.geolocation.watchPosition(updatePosition);
 
}


function updatePosition(position) {
  if (is_tracking) {
    
    var myLat = position.coords.latitude;
    var myLng = position.coords.longitude;
    
    if (typeof myLat === 'number' && typeof myLng === 'number') {
       var newPosition = { lat: myLat, lng: myLng };
      path.push(newPosition);
      polyline.setPath(path); 
      marker.setPosition(newPosition);
      console.log(path);
      
    }
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

// Cancel tracking and remove marker and polyline
  function cancelTracking() {
    is_tracking = false;
    marker.setMap(null);
    polyline.setMap(null);
    document.getElementById("tracker").innerHTML = "<i class='material-icons'>share_location</i> Track";
    document.getElementById("cancel").innerHTML = "<a type='button' hidden onclick='cancelTracking()' id='cancel-tracker' style='display: flex;flex-direction: column-reverse;flex-wrap: wrap;align-content: center;' class='btn btn-danger'> <i class='material-icons'>cancel</i></a>";
    document.getElementById("save").innerHTML = "<a type='button' hidden onclick='endTracking()' id='cancel-tracker' style='display: flex;flex-direction: column-reverse;flex-wrap: wrap;align-content: center;'  class='btn btn-blue '><i class='material-icons'>save</i></a>"
  }
// * Cancel tracking and remove marker and polyline

 // Stop tracking the user's location
  function stopTracking() {
    is_tracking = false;
    document.getElementById("tracker").innerHTML = "<i class='material-icons'>share_location</i> Track";
    navigator.geolocation.clearWatch(watchID);
  }
  // * Stop tracking the user's location

window.initMap = initMap;


