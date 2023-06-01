<?
include 'auth.php';

$ref = $_GET['ref'];

$geteventd          = "SELECT * FROM `events` WHERE `reference` = '$ref' ";
$eventresult        = mysqli_query($conn,$geteventd);
$eventrow           = mysqli_fetch_array($eventresult);
//Table variables
$eventname          = $eventrow['name'];
$eventcreator       = $eventrow['createdby'];
$eventadmin         = $eventrow['admin'];
$eventreference     = $eventrow['reference'];
$eventdescription   = $eventrow['details'];
$eventdatecreated   = $eventrow['datecreated'];
$eventstatus        = $eventrow['status'];
$eventdate          = $eventrow['eventdate'];
$eventtime          = $eventrow['eventtime'];
$eventimg           = $eventrow['imgurl'];
$eventlocation      = $eventrow['location'];
$eventrallypoint    = $eventrow['rallypoint'];
$eventcategory      = $eventrow['category'];
$eventcost          = $eventrow['cost'];
// * Table variables
$eventstate         = $eventrow['state'];
$viewer             = $userid;

//Get event organiser's details
$getuser            = "SELECT * FROM `users` WHERE `id` = '$eventcreator' ";
$res                = mysqli_query($conn, $getuser);
$fetch              = mysqli_fetch_array($res);

$organizer          = $fetch['username'];
$organizerpic       = $fetch['imgurl'];
// * Get event organizer's details


//Get event members
$qwatchers          = "SELECT * FROM `event_members` WHERE `event_reference` = '$eventreference' ";
$rwatchers          = mysqli_query($conn, $qwatchers);
// Return the number of rows in result set
$watchcount         = mysqli_num_rows($rwatchers);
  
  // Free result set
 mysqli_free_result($rwatchers);


?>
<!doctype html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Hykr - The Hiking app </title>
    
    
    
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/splide-core.min.css">
    <!-- Material Design Theming -->
    <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.orange-indigo.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined">
  
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="keywords" content="" />
    
    <link rel="apple-touch-icon" sizes="180x180" href="fav.png">
    <link rel="icon" type="image/png" href="fav.png">
    
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

    <style>
    
    .text-red {
            color: #ee6962;
        }
        
    
.bg-red {
    background: #ee6962 !important;
}

.bg-yellow {
    background: #fcca48;
}

.bg-green {
    background: #8ececa;
}

.bg-purp {
    background: #9282f0;
}

.bg-cyan {
    background: #00ffff;
    color: white;

}

.text-blue {
    color: #38b6ff;
}

.text-purple {
    color: #ff4aff;
}

.text-cyan {
    color: #00ffff;
}

.bg-gray {
    background: #d8e1ed;
}
    
    .post-footer {
            padding-top: 0px;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;

        }
        
        .post-footer .item {
           flex: 1;
           display: flex;
           flex-direction: row;
           text-align: center;
        }
        
        .post-footer .item a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-direction: row;
        }
        
        .post-footer .item button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-direction: row;
        }
        
        .post-footer .item .icon-wrapper {
            
            width: 48px;
            height: 48px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            color: #fff;
            font-size: 24px;
            margin-bottom: 14px;
        }
    
    .listview>li footer {
        display: flex;
    }
    
        body {
            color: white;
        }
        
        .card {
            --bs-card-bg: #161616;
        }
        
        a {
            text-decoration: none !important;
        }
        
        .text-watcher {
            color: #f99907 !important;
        }
        
        .bg-watcher {
            background: #f99907 !important;
            
        }
        
        .trans-grey-card {
            background: rgba(220,220,233, 0.2) !important;
            color: white;
        }
        
        .form-control {
            color: black !important;
        }
    
        .bg-kasuwa-red {
            background: #cf455c;
        }
        
        .form-group.boxed .form-control {
            background: rgba(220,220,233, 0.2) !important;
        }
        
        
    .text-red {
        color: #cf455c;
    }
        
    .nav-tabs.lined .nav-item .nav-link.active {
        color: #ee6962;
        border-bottom-color: #06060603 !important;
    } 
        
    
        
    .listview {
        border-radius: 10px;
        /* background: rgba(220,220,233, 0.2) !important; */
    }    
    
    .appBottomMenu {
        background: transparent !important;
    }
        
    .nav-tabs.lined .nav-item .nox.active {
        border: 2px #000000 !important;
    }
    
    .exampleBox {
            border: 0px;
    }
    
    .appHeader {
        background: white !important;
        color: black !important;
    }
    
    .modal-header {
        background: transparent !important;
        border-bottom: none !important;
    }
    
    .extraHeader {
        background: #ffffff !important;
    }
    
    .modal {
       /*background: #1c1c1c !important;*/
        --bs-modal-bg: #ffffff !important;
    }
    
    .e-dark {
        background: #161616 !important;
    }
    
    .e-grey {
        background: #1c1c1c;
    }
        
    .e-input {
        background: #333333;
    }    
    
    .listview> li {
        flex-direction: column !important ;
        align-items: center;
    }
    
    .listview>li:after{
      background : #1c1c1c;
      height: 10px;
      
    }
    
    .image-listview>li:after {
        left: 0;
    }

    li {
        background: #ffffff;
    }
        
    .image-listview > li a.item::after {
        display: none;
    }
    
    
    #map-canvas{
    position: absolute;
    top: 100px;
    left: 0;
    bottom: 100px;
    right: 0;
}

    /* Set the size of the div element that contains the map */
    #map {
    /*  height: 600px;  The height is 400 pixels */
    /*  width: 100%; /* The width is the width of the web page */
     height: 100%;
      position: absolute; 
      top: 0; 
      bottom: -200px; 
      left: 0; 
      right: 0; 
      z-index: 0;
    }
    
    #container {
  z-index: 100;
  position: relative;
}

 .image-listview> li>footer .item {
        display: flex;
    }

    </style>
    <script type="module" src=""></script>
</head>
<body onload="initMap()" class="e-grey" >

    
<!-- App Header -->
    <div class="appHeader bg-light no-border">
        <div class="left">
            <span><a onclick="window.history.back()" class="headerButton goBack" > <i class="material-icons text-dark">chevron_left</i></a></span>   
         <span>
          <!--   <a  data-toggle="modal" data-target="#sidebarPanel"> <i class="material-icons" >more_vert</i></a></span>   -->
        </div>
        <div class="center">
            <strong><?= $eventname?></strong>
            
        </div>
        <div class="right">
        
        </div>
            
        </div> 
    
    <!-- * App Header --> 

    <!-- New Report Modal Box -->
    <? include 'newpost.php'; ?>
    <!-- * New Report Modal Box -->
    
    <!-- New Result Modal Box -->
    <? include 'newresult.php'; ?>
    <!-- * New Result Modal Box -->
    
      
    <!-- Default Post Modal Box -->
    <? include 'defpost.php'; ?>
    <!-- * Default post Modal Box -->
    
    <!-- New channel Modal Box -->
    <? include 'newchannel.php'; ?>
    <!-- * New channel Modal Box -->
    
    <!-- App Sidebar -->
     <? include 'sidebar.php';?>   
    <!-- * App Sidebar -->
    <!-- App Capsule -->
    <div id="appCapsule" >
        
            <div class="tab-content mt-2">
                <div class="tab-pane fade show active" id="home" role="tabpanel">
                    
        
                        <!-- MAP -->
                        <div id="map"></div>
                                                                      
                        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCiDYtaPKvXEjQYWh1qAkX5QcScfk-cCRw&callback=initMap&v=weekly" defer></script>    
                        <!-- * MAP -->
                            
                    <!-- Home Tab 
                         
                        <div id="map-canvas">
                             <iframe src="https://storage.googleapis.com/maps-solutions-jub5eo5qcd/neighborhood-discovery/qtlk/neighborhood-discovery.html"
                              width="100%" height="100%"
                              style="border:0;"
                              loading="lazy">
                            </iframe>
                        </div>
                    <!-- *Home Tab     -->
                        
                        
                    <br>      
                   
                </div>
                <!-- * Home Tab -->
                
                <!-- Explore Tab -->
                <div class="tab-pane fade" id="explore" role="tabpanel">
                
                </div>
                <!-- * Explore Tab -->
                        
                <!-- Notifications Tab 
                <div class="tab-pane fade" id="notifications" role="tabpanel">
                </div>
                <!-- * Notifications Tab -->
                
                <!-- Profile Tab -->
                <div class="tab-pane fade" id="profile" role="tabpanel">
                    
                </div>
                <!-- * Profile tab -->
            </div>
            
            <div class="section">
                
            </div>
    </div>
    <!-- * App Capsule-->
    
     <div  class="appBottomMenu transparent no-border"  style="border-radius: 15px; width: 90%; left: 20px; bottom: 10px;">
         
         
         <a type="button" onclick="startTracking()" id="tracker"
            style="display: flex;flex-direction: column-reverse;flex-wrap: wrap;align-content: center;" 
            class="btn btn-primary btn-block btn-lg">
           <i class="material-icons">share_location</i>  
            Track
        </a>
        
    
        
        <div id="cancel" style="margin-left: 10px">
            <a type='button' hidden onclick='cancelTracking()' id='cancel-tracker'
                style='display: flex;flex-direction: column-reverse;flex-wrap: wrap;align-content: center;' 
                class='btn btn-danger '>
               <i class='material-icons'>cancel</i>  
            </a>
        </div>
        
        
        
        
        
        <div hidden id="longitudewrap"></div>
        <div hidden id="latitudewrap"></div>
         <ul class="nav nav-tabs lined" role="tablist">
                    <!--
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#home" role="tab">
                            <i class="material-icons">home</i>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#explore" role="tab">
                            <i class="material-icons">explore</i>
                            <strong id="longitude"></strong>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" id="start-tracker"   role="">
                            <i class="material-icons">share_location</i>
                            <strong>Track</strong>
                        </a>
                    </li>
                    <!--
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#notifications" role="tab">
                            <i class="material-icons">notifications</i>
                        </a>
                    </li> 
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#profile" role="tab">
                            <i class="material-icons">person</i>
                            <strong id="latitude"></strong>
                        </a>
                    </li>
                    -->
         </ul>    
    </div>
    

    
    <!-- Modals -->
    
     <!-- Dialog Basic -->
    <div class="modal fade dialogbox" id="DialogBasic" data-bs-backdrop="static" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete</h5>
                </div>
                <div class="modal-body">
                    Are you sure?
                </div>
                <div class="modal-footer">
                    <div class="btn-inline">
                        <a href="#" class="btn btn-text-secondary" data-bs-dismiss="modal">CANCEL</a>
                        <a href="#" class="btn btn-text-primary" data-bs-dismiss="modal">DELETE</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- * Dialog Basic -->
    
    <!-- Search Modal Box -->
        <div class="modal fade modalbox" id="search-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header no-border transparent">
                        <a href="javascript:;" class="me-2" data-dismiss="modal"><i class="material-icons text-light">arrow_back</i></a>
                        
                            <form action="search.php" class="search-form">
                                <div class="form-group transparent searchbox">
                                    <input type="text" class="form-control" onkeyup="showResult(this.value)" for="searcher" style="background: 000000; border-radius: 20px; border: none; color: white " placeholder="Search eWatcher">
                                    <!--<i class="input-icon">
                                        <i class="material-icons text-dark">search</i>
                                    </i> -->
                                    <a href="#" class="ms-1 close toggle-searchbox"><i class="material-icons text-light">close</i></a>
                                </div>
                                
                                <div class="form-group searchbox">
                                    <input type="search" id="searcher" class="form-control" name="keyword" hidden>
                                    <i class="material-icons">search</i>
                                    
                                </div>
                                
                                <input type="submit" class="btn btn-danger" value="Search" name="find">
                            </form>
                        <button onclick="document.getElementById('search-suggesstions').innerHTML = ' '" class="btn btn-icon btn-danger me-1">
                            <i class="material-icons text-light" style="margin-left: -0.30rem !important ;">cancel</i>
                            </button>
                    </div>
                    <div class="modal-body transparent">
                        <div class="action-sheet-content">
                        <div id="search" class="appHeader transparent">
                            <form class="search-form">
                                
                            </form>
                        </div>
                        <br>
                        <ul class="listview image-listview text-light" id="search-suggestions">
                        </ul>
                        
                    </div>
                </div>
                
                
                
            </div>
        </div>
        </div>
<!-- * Search Modal Box -->
    <!-- * Modals --> 


    <!-- ///////////// Js Files ////////////////////  -->
    <!-- Jquery -->
    <script src="assets/js/lib/jquery-3.4.1.min.js"></script>
    <!-- Bootstrap-->
    <script src="assets/js/lib/popper.min.js"></script>
    <script src="assets/js/lib/bootstrap.min.js"></script>
    <script src="assets/js/plugins/splide/splide.min.js"></script>
    <!-- Ionicons -->
    <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
    
     <script>

/* Initialize the map
function initMap() {
    /*navigator.geolocation.getCurrentPosition(function(position) {
        var lat = position.coords.latitude;
        var lng = position.coords.longitude;
    )}    
    
    
    map = new google.maps.Map(document.getElementById('map'), {
       center: {lat: lat, lng: lng},
       zoom: 18
    });
}

*/

let stepCount = 0;
let isCounting = false;

function startStepCounter() {
  isCounting = true;
  window.addEventListener('devicemotion', countSteps);
}

function stopStepCounter() {
  isCounting = false;
  window.removeEventListener('devicemotion', countSteps);
}

function countSteps(event) {
  if (isCounting) {
    const { acceleration } = event;
    const accelerationMagnitude = Math.sqrt(
      Math.pow(acceleration.x, 2) +
      Math.pow(acceleration.y, 2) +
      Math.pow(acceleration.z, 2)
    );

    // Detect a step based on the acceleration magnitude threshold
    if (accelerationMagnitude > 15) {
      stepCount++;
      updateStepCountDisplay();
    }
  }
}

function updateStepCountDisplay() {
  document.getElementById('stepCountDisplay').innerText = stepCount;
}


 

</script> 

    <script>
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
      mapId: "1abe1ac6f95dca8b",
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
  
  document.getElementById("cancel").innerHTML = "<a type='button' hidden onclick='cancelTracking()' id='cancel-tracker' style='display: flex;flex-direction: column-reverse;flex-wrap: wrap;align-content: center;' class='btn btn-danger'> <i class='material-icons'>cancel</i></a>";
  document.getElementById("save").innerHTML = "<a type='button' onclick='endTracking()' id='id='stepCountDisplay' 'style='display: flex;flex-direction: column-reverse;flex-wrap: wrap;align-content: center;' class='btn bg-purp '> </a>"
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
     enableHighAccuracy: true
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





</script>
<script>
    
</script>

    <script>
        function showResult(str) {
          if (str.length == 0) {
            document.getElementById("search-suggestions").innerHTML = " ";
            return;
          } else {
            const xmlhttp = new XMLHttpRequest();
            xmlhttp.onload = function() {
              document.getElementById("search-suggestions").innerHTML = this.responseText;
            }
          xmlhttp.open("GET", "search.php?q=" + str);
          xmlhttp.send();
          }
        }
    </script>
    <script>
      new Splide( '.splide', {
		fixedWidth: 110,
		gap       : 10,
		rewind    : true,
		pagination: false,
  } ).mount();
  
  new Splide( '.splide2', {
		fixedWidth: 110,
		gap       : 10,
		rewind    : true,
		pagination: false,
  } ).mount();
      
  new Splide( '.splide3', {
		fixedWidth: 110,
		gap       : 10,
		rewind    : true,
		pagination: false,
  } ).mount();      
      
      
  new Splide( '.splide4', {
		fixedWidth: 110,
		gap       : 10,
		rewind    : true,
		pagination: false,
  } ).mount();            
  
  new Splide( '.splide5', {
		fixedWidth: 110,
		gap       : 10,
		rewind    : true,
		pagination: false,
  } ).mount();            
    </script>    

</body>
