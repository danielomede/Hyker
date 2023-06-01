<?
include 'auth.php';
$ref                = $_GET['ref'];
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
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

    <style>
    
    
.bg-red {
    background: #ee6962;
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
        
        .form-event.boxed .form-control {
            background: rgba(220,220,233, 0.2) !important;
        }
        
        
    .text-red {
        color: #cf455c;
    }
        
    .nav-tabs.lined .nav-item .nav-link.active {
        color: #000;
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
        background: transparent !important;
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
    
    .wallet-card-section:before {
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 55px;
        content: "";
        display: block;
        height: 300px;
        filter: blur(3px);
        background: url('<? echo $eventimg;?>');
    }
    
    .wallet-card {
        background: transparent;
         box-shadow: None; 
        border-radius: 10px; 
        padding: 8px 24px;
        position: relative;
        z-index: 1;
    }
    
    .wallet-card .wallet-footer {
        border-top: 0px;
        padding-top: 0px;
        display: flex;
        justify-content: space-around;
        align-content: center;
        flex-wrap: nowrap;
        align-items: center;
    }
    
    .wallet-card .balance .total {
        font-weight: 700;
        letter-spacing: -0.01em;
        line-height: 1em;
        font-size: 50px;
    }
    
    .icon-wrapper {
        width: 48px;
        height: 48px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        color: #fff;
        font-size: 16px;
        margin-bottom: 14px;
        flex-direction: column;
    }
    
    </style>
    <script type="module" src=""></script>
</head>
<body class="text-dark" style="background: #ffffff">
    
    <!--App Header-->
    <div class="appHeader transparent no-border">
        <div class="left">
            <span><a onclick="window.history.back()" class="headerButton goBack" > <i class="material-icons text-dark">chevron_left</i></a></span>   
            <strong class="pageTitle text-dark text-left" style=""> </strong>
        </div>
        <div class="center ">
                                       
        </div>
        <div class="right">
          <span id="startEvent"></span>
        </div>
    </div>
    <!-- * App Header-->
    
    <!--App Capsule-->  
    <div id="appCapsule">
        
        <div class="section mt-2">
            <figure>
                <img src="<?= $eventimg; ?>" alt="image" class="imaged img-fluid">
            </figure>
        </div>
        
        <div class="section mt-2">
            <h1>
                <?= $eventname; ?>
            </h1>
            <br>
            <div class="blog-header-info mt-2 mb-2">
                <div>
                    <img src="<?= $organizerpic ?>" alt="img" class="imaged w24 rounded me-05">
                    by <a href="#"><?= $organizer ?></a>
                </div>
                <div>
                    <span id="formattedDate"></span>
                </div>
            </div>
            <br>
            <div class="listview-title text-red mt-1"><strong>About this event</strong></div>
            <p >
             <?= $eventdescription  ; ?>  
            </p>
            <br>
            
            
            
        </div>
        <div class="section mt-2">
            <ul class="listview flush transparent no-line image-listview">
                       
               <li>
                     <a  style="text-decoration:none;" class="item ">
                         <div class="icon-box bg-light">
                             <i class="material-icons-outlined text-dark">push_pin</i>
                         </div>
                            <?= $eventrallypoint ?>
                      </a>
               </li>
               <li>
                     <a  style="text-decoration:none;" class="item ">
                         <div class="icon-box bg-light">
                             <i class="material-icons-outlined text-dark">location_on</i>
                         </div>
                            <?= $eventlocation ?>
                      </a>
               </li>
               <li>
                     <a style="text-decoration:none;" class="item ">
                         <div class="icon-box bg-light">
                             <i class="material-icons-outlined text-dark">schedule</i>
                         </div>
                            <?= $eventtime ?>
                      </a>
               </li>
               <li>
                     <a  style="text-decoration:none;" class="item ">
                         <div class="icon-box bg-light">
                             <i class="material-icons-outlined text-dark">category</i>
                         </div>
                         <?= $eventcategory ?>
                            
                      </a>
               </li>
            </div>           
            <br>
        </div>
        <!--
        <div class="section wallet-card-section header-filter clear-filter pt-1" style="bottom: 55px;">
            <div class="wallet-card transparent" style="top: 50px;">
                <!-- Balance 
                <div class="balance pt-1"> 
                    <h1 class="total text-dark text-center" id="demo" style="margin-top: 55px;margin-bottom: 0px;"></h1>
                    
                </div>
                <!-- * Balance 
                <!-- Wallet Footer 
                <div class="wallet-footer">
                    <div class="item" style="text-align: center;">
                        <strong>Days</strong>
                    </div>
                    <div class="item" style="text-align: center;">
                        <strong>Hours</strong>
                    </div>
                    <div class="item" style="text-align: left;">   
                        <strong>Minutes</strong>
                    </div>

                </div>
                <!-- * Wallet Footer 
            </div>
        </div>
        
        <br><br><br><br><br>
        <div class="section-heading padding mt-4">
                <h2 class="title"><strong><? echo $eventname; ?></strong></h2>
                <div class="icon-wrapper bg-red" style="display: flex">
                   <small>₦</small> 
                    <strong style="margin-bottom: 5px;"><? echo $eventcost ?></strong>
                </div>
        </div> 
        -->
        
        <div class="section">
            
        </div>
        
    </div>
    <!--* App Capsule-->
    
    <!--Bottom menu-->
     <div  class="appBottomMenu transparent no-border"  style="border-radius: 15px; width: 95%; left: 20px; right: 20px; bottom: 10px;">
         <button id="eventButton" class="btn text-light bg-red btn-block btn-lg">
             <a
             style='display: flex;flex-direction: row;flex-wrap: wrap;align-content: center;justify-content: center;' 
             >
             <i class='material-icons text-light'>hourglass_bottom</i>  
            Waiting
            </a>
         </button>

         
        
        <div id="save" style="margin-left: 10px">
            <a type='button' hidden onclick='endTracking()' id='cancel-tracker'
                style='display: flex;flex-direction: column-reverse;flex-wrap: wrap;align-content: center;' 
                class='btn btn-blue '>
               <i class='material-icons'>save</i>  
            </a>
        </div>
        
        <div hidden id="longitudewrap"></div>
        <div hidden id="latitudewrap"></div>
    </div>
    <!--Bottom menu-->
    <!-- ///////////// Js Files ////////////////////  -->
    <!-- Jquery -->
    <script src="assets/js/lib/jquery-3.4.1.min.js"></script>
    <!-- Bootstrap-->
    <script src="assets/js/lib/popper.min.js"></script>
    <script src="assets/js/lib/bootstrap.min.js"></script>
    <script src="assets/js/plugins/splide/splide.min.js"></script>
    

<script>
     var admin = '<?php echo $eventadmin; ?>';
  
  // Get the button element
  var startTrail = document.getElementById('startEvent');
  
  // Update the button text based on the event status
  if (admin === '<?= $viewer; ?>') {
    startTrail.innerHTML = "<a onclick='startHike()' class='headerButton' id='' > <i class='material-icons text-dark'>play_circle</i></a>";
  } else {
    startTrail.innerHTML = '';
  }
  
  function startHike() {
      $.ajax({
        url: 'changestatus.php?ref=<?= $ref; ?>', // Replace with the URL of your PHP script to fetch the event status
        method: 'GET',
        dataType: 'json',
        success: function(response) {
          document.getElementById('eventButton').innerHTML = "<a href='trail.php?ref=<?= $ref;?>' style='display: flex;flex-direction: row;flex-wrap: wrap;align-content: center;justify-content: center;' ><i class='material-icons text-light'>play_circle</i>  Start</a>";;
        },
        error: function() {
          console.log('Error occurred while checking event status.');
        }
      });
    }
  
  
</script>



<script>
    //Check if event has started
     // Function to update the button text
    function updateButton(eventStatus) {
      var button = document.getElementById('eventButton');

      if (eventStatus === 'Ongoing') {
        button.innerHTML = "<a href='trail.php?ref=<?= $ref;?>' style='text-decoration: none; display: flex;flex-direction: row;flex-wrap: wrap;align-content: center;justify-content: center;' ><i class='material-icons text-light'>play_circle</i></a>";
      } else {
        button.innerHTML = "<a style='display: flex;flex-direction: row;flex-wrap: wrap;align-content: center;justify-content: center;' ><i class='material-icons text-light'>hourglass_bottom</i>  Waiting</a>";
      }
    }

     // Function to check event status via AJAX
    function checkEventStatus() {
      $.ajax({
        url: 'get_event_status.php?ref=<?= $ref; ?>', // Replace with the URL of your PHP script to fetch the event status
        method: 'GET',
        dataType: 'json',
        success: function(response) {
          if (response && response.status) {
            updateButton(response.status);
          }
        },
        error: function() {
          console.log('Error occurred while checking event status.');
        }
      });
    }

    // Periodically check event status
    setInterval(checkEventStatus, 5000); // Adjust the interval (in milliseconds) based on your requirements

</script>

  <script>
    var dateString = '<?php echo $eventdate; ?>';

   var dateParts = dateString.split('-');
    var year = parseInt(dateParts[0]);
    var month = parseInt(dateParts[1]) - 1;
    var day = parseInt(dateParts[2]);

    var date = new Date(year, month, day);

    var formattedDate = date.toLocaleDateString('en-GB', {
      weekday: 'long',
      day: 'numeric',
      month: 'long',
      year: 'numeric'
    });

    document.getElementById('formattedDate').textContent = formattedDate;
  </script>
<script>
// Set the date we're counting down to
var countDownDate = new Date("<? echo $eventdate." ".$eventtime; ?>");

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  
    
  // Output the result in an element with id="demo"
  document.getElementById("demo").innerHTML = days + " : " + hours + " : "
  + minutes;
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "EXPIRED";
  }
}, 1000);
</script>
</body>