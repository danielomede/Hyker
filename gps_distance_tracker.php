<!DOCTYPE html>
<html>
<head>
  <title>GPS Distance Tracker</title>
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY&libraries=geometry"></script>
</head>
<body>
  <div id="map" style="height: 500px;"></div>
  <button onclick="startTracking()">Start Tracking</button>
  <button onclick="endTracking()">End Tracking</button>
  <p>Distance Covered: <span id="distance">0 meters</span></p>

  <script>
    var map;
    var marker;
    var path = [];
    var is_tracking = false;

    function initMap() {
      map = new google.maps.Map(document.getElementById('map'), {
        center: { lat: 0, lng: 0 },
        zoom: 18
      });
    }

    function startTracking() {
      is_tracking = true;
      path = [];
      document.getElementById('distance').textContent = '0 meters';
      updateMarker({ lat: 0, lng: 0 }); // Set the initial marker at the starting position
    }

    function endTracking() {
      is_tracking = false;
      calculateDistance();
    }

    function updateMarker(position) {
      if (marker) {
        marker.setPosition(position);
      } else {
        marker = new google.maps.Marker({
          position: position,
          map: map,
          title: 'Current Position'
        });
      }
      map.panTo(position);
    }

    function calculateDistance() {
      var distance = 0;
      for (var i = 1; i < path.length; i++) {
        var p1 = path[i - 1];
        var p2 = path[i];
        distance += google.maps.geometry.spherical.computeDistanceBetween(
          new google.maps.LatLng(p1.lat, p1.lng),
          new google.maps.LatLng(p2.lat, p2.lng)
        );
      }

      // Update the distance on the webpage
      document.getElementById('distance').textContent = distance.toFixed(2) + ' meters';
      
      // Save the distance to the database or perform any other required actions.
      // You can use AJAX to send the distance to the server and save it in the database.
      // For example:
      // var xhttp = new XMLHttpRequest();
      // xhttp.open("POST", "save-distance.php", true);
      // xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      // xhttp.send("distance=" + distance);

      // Clear the path for a new tracking session
      path = [];
    }

    function trackPosition(position) {
      if (is_tracking) {
        var newPosition = { lat: position.coords.latitude, lng: position.coords.longitude };
        path.push(newPosition);
        updateMarker(newPosition);
      }
    }

    function errorHandler(err) {
      console.warn('Error occurred: ' + err.message);
    }

    // Start watching for position updates when the page loads
    navigator.geolocation.watchPosition(trackPosition, errorHandler, {
      enableHighAccuracy: true,
      maximumAge: 0
    });

    window.initMap = initMap;
  </script>
</body>
</html>
