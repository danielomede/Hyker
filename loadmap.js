        var image = "hikergreen32.png";
        var mapIcon = "hiking map32.png";
        var trailCoordinates = [];
        
        // Define variables
        var map;
        var marker;
        var polyline;
        var path = [];
        var is_tracking = false;
        var lat
        var lng
      
        function initMap() {     
        
          // Get user's location
          navigator.geolocation.getCurrentPosition(function(position) {
             lat = position.coords.latitude;
             lng = position.coords.longitude;
            
            // Create map centered on user's location
            var map = new google.maps.Map(document.getElementById('map'), {
              center: {lat: lat, lng: lng},
              zoom: 18
            });
            // * Create map centered on user's location
            
            // Create marker for user's location
            var currentPosition = new google.maps.Marker({
              position: {lat: lat, lng: lng},
              map: map,
              icon: image,
              title: 'You are here'
            });
            // * Create marker for user's location
            
            //document.getElementById("tracker").addEventListener("click", startTracking());                    
            
          }); //End of Google navigator function
          
        }   // End of initMap() function 
          
         // Start tracking the user's location
        function startTracking(position) {
          is_tracking = true;
          document.getElementById("tracker").innerHTML = "<span class='spinner-border spinner-border-sm me-05' role='status' aria-hidden='true'></span> Tracking...";
          //document.getElementById("tracker").innerHTML = "<i class='material-icons'>hiking</i>Tracking...";
          marker = new google.maps.Marker({
            position: {lat: lat, lng: lng},
            map: map,
            
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
        // * Start tracking the user's location
        
        // Update the user's position and add it to the path
        function updatePosition(position) {
          if (is_tracking) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;
            var newPosition = new google.maps.LatLng(latitude, longitude);
            marker.setPosition(newPosition);
            path.push(newPosition);
            polyline.setPath(path);
          }
        }
        // * Update the user's position and add it to the path
        
        // End tracking the user's location
        function endTracking() {
          is_tracking = false;
          var lastPosition = path[path.length - 1];
          var latitude = lastPosition.lat();
          var longitude = lastPosition.lng();
          // Send the coordinates to the server to be saved to the database
          $.post('save.php', { user_id: 123, latitude: latitude, longitude: longitude });
          // Add a marker at the end of the trail
          var endMarker = new google.maps.Marker({
            position: lastPosition,
            map: map
          });
        }
        // * End tracking the user's location 
            
            

        

        window.initMap = initMap;

