
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
        
        async function handleMarkerClick(trail) {
          const startpoint = trail.startpoint;
  
          // Fetch complete trail details based on the startpoint
            try {
                    // Fetch complete trail details based on the startpoint
                    const trailDetails = await fetchTrailDetails(startpoint);
                
                    // Fetch user details based on the recordedby reference
                    const userDetails = await fetchUserDetails(trailDetails.recordedby);
                    const username = userDetails.username;
                    const imgurl = userDetails.imgurl; 
                    
                     // Create a new map instance for the mini map
                    const miniMap = new google.maps.Map(document.getElementById("map-modal"), {
                        center: { lat: 0, lng: 0 }, // Set initial center as needed
                        zoom: 13,
                    });
                    
                    
                  
                  // Parse the trail data as an array of coordinates
                  const coordinates = JSON.parse(trailDetails.traildata);
            
                  // Create a polyline and set its path
                  const polyline = new google.maps.Polyline({
                    path: coordinates,
                    geodesic: true,
                    strokeColor: "#FF0000",
                    strokeOpacity: 1.0,
                    strokeWeight: 2,
                    map: miniMap,
                  });
    
                // Create start and end markers
                  const startMarker = new google.maps.Marker({
                    position: coordinates[0],
                    map: miniMap,
                    title: "Start",
                    icon: image,
                  });
            
                  const endMarker = new google.maps.Marker({
                    position: coordinates[coordinates.length - 1],
                    map: miniMap,
                    title: "End",
                    icon: image,
                  });
            
                  // Fit the map bounds to show the polyline and markers
                  const bounds = new google.maps.LatLngBounds();
                  bounds.extend(startMarker.getPosition());
                  bounds.extend(endMarker.getPosition());
                  polyline.getPath().forEach(function (latLng) {
                    bounds.extend(latLng);
                  });
                  miniMap.fitBounds(bounds);                
                    
                  
                    
                  // Get the modal and details container
                  const modal = document.getElementById("trailModal");
                  const detailsContainer = document.getElementById("trailDetails");
            
                  // Clear any previous trail details
                  detailsContainer.innerHTML = "";
                    
                    
                    var durationInMillis = trailDetails.duration; // Replace with your duration in milliseconds
                    var seconds = Math.floor(durationInMillis / 1000);
                    // Calculate hours, minutes, and remaining seconds
                    var hours = Math.floor(seconds / 3600);
                    var minutes = Math.floor((seconds % 3600) / 60);
                    var remainingSeconds = seconds % 60;
                    // Format the time components with leading zeros
                    var formattedHours = hours.toString().padStart(2, '0');
                    var formattedMinutes = minutes.toString().padStart(2, '0');
                    var formattedSeconds = remainingSeconds.toString().padStart(2, '0');
                    // Construct the formatted time string
                    var formattedTime = formattedHours + ':' + formattedMinutes + ':' + formattedSeconds;
                    
                    //var formattedDuration = formatDuration(durationInMillis);
                    //console.log(formattedDuration); // Output: 00:00:05
                  
                    
                  
                  // Create HTML content for the trail details
                  const content = `
                    <p><strong>Start Point:</strong> ${startpoint}</p>
                    <p><strong>Duration:</strong> ${trailDetails.duration}</p>
                    <p><strong>Recorded By:</strong> ${username}</p>
                    <br>
                    <div class="wallet-card">
                    <!-- Balance -->
                    
                    <!-- * Balance -->
                    <!-- Wallet Footer -->
                    <div class="wallet-footer" style=" border-top: 0px; ">
                        <div class="item" style="display:  flex;">
                            <div class="icon-wrapper bg-light">
                                <i class="material-icons text-info">local_fire_department</i>
                            </div>
                            
                            <div>
                                <small class="text-secondary">Burns</small>
                                <strong><h4>180 kcal</h4></strong>    
                            </div>
                        </div>
                        
                        <div class="item" style="display:  flex;">
                            <div class="icon-wrapper bg-light">
                                <i class="material-icons text-info">schedule</i>
                            </div>
                            
                            <div>
                                <small class="text-secondary">Duration</small>
                                <strong><h4>${formattedTime}</h4></strong>    
                            </div>
                        </div>
                        
                    </div>
                    <!-- * Wallet Footer -->
                </div>
                <br>
                  `;
                  detailsContainer.innerHTML = content;
            
                  // Show the modal
                  const modalInstance = new bootstrap.Modal(modal);
                  modalInstance.show();
                    
            
                
            } catch (error) {
             console.error("Error handling marker click:", error);
            }
            
        }
        
        // Function to fetch complete trail details based on the startpoint
        function fetchTrailDetails(startpoint) {
          return fetch("get-trail-details.php?startpoint=" + encodeURIComponent(startpoint))
            .then(response => response.json())
            .catch(error => {
              console.error("Error fetching trail details:", error);
              throw error; // Rethrow the error for handling
            });
        }

        // Function to fetch complete user details based on the reference
        function fetchUserDetails(reference) {
          return fetch("get-user-details.php?reference=" + encodeURIComponent(reference))
            .then(response => response.json())
            .catch(error => {
              console.error("Error fetching user details:", error);
              throw error; // Rethrow the error for handling
            });
        }

    
    window.initMap = initMap;
    
    
    
    
    
