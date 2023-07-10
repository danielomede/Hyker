 var image = "hyk.png";
    var mapIcon = "hiking map32.png";
    var trailCoordinates = [];
    var map;
    var marker;
    var polyline;
    var path = [];
    var is_tracking = false;
    var lat;
    var lng;
    
    var imgIcon = {
      url: image,
      size: new google.maps.Size(40, 40),
      origin: new google.maps.Point(0, 0),
      anchor: new google.maps.Point(20, 20),
    };
    
    function initMap() {
      navigator.geolocation.getCurrentPosition(function(position) {
        lat = position.coords.latitude;
        lng = position.coords.longitude;
    
        getLat = document.getElementById('latitudewrap').innerHTML = lat;
        getLong = document.getElementById('longitudewrap').innerHTML = lng;
    
        map = new google.maps.Map(document.getElementById('map'), {
          mapId: "1abe1ac6f95dca8b",
          center: {lat: lat, lng: lng},
          zoom: 13
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
      //* End Google navigator
      
       fetchTrailData().then(trails => {
            trails.forEach(trail => {
              const startpoint = trail.startpoint;
              const coordinates = startpoint.split(",");
              const lat = parseFloat(coordinates[0]);
              const lng = parseFloat(coordinates[1]);
        
              if (isNaN(lat) || isNaN(lng)) {
                console.error("Invalid startpoint:", startpoint);
                return;
              }
        
              const position = new google.maps.LatLng(lat, lng);
        
              const startMarker = new google.maps.Marker({
                position: position,
                map: map,
                title: "Trail Start",
                icon: image
              });
        
              // Add a click event listener to the marker
              startMarker.addListener("click", () => {
                // Handle the marker click event
                handleMarkerClick(trail);
              });
            });
          });
      
    } //End init map()
        
        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
          infoWindow.setPosition(pos);
          infoWindow.setContent(
            browserHasGeolocation
              ? "Error: The Geolocation service failed."
              : "Error: Your browser doesn't support geolocation."
          );
          infoWindow.open(map);
        }
    //* End Init Map
    
    // Function to fetch trail data from the database
        function fetchTrailData() {
          return fetch("get-trails.php")
            .then(response => response.json())
            .catch(error => {
              console.error("Error fetching trail data:", error);
              return []; // Return an empty array in case of error
            });
        }
        
        // Function to handle marker click event
        function handleMarkerClick(trail) {
          // Handle the click event for the marker, e.g., show trail details
          console.log("Trail clicked:", trail);
        }
        
    
    window.initMap = initMap;
    
