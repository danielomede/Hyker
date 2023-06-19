<?php
include ('config.php');
#ini_set('display_errors',1);
session_start();

/*if (isset($_POST['signin'])) {
    $phone = $_POST['phone'];
    $pin = $_POST['pin'];
    $pinhash = md5($pin);
 
    $query = "SELECT * FROM `users` WHERE phone='$phone' AND pin = '$pinhash'";
    $result = mysqli_query($conn, $query);
    $rows = mysqli_num_rows($result);

    if ($rows == 0) {
        echo "<script>alert('Phone number or pin is incorrect')</script>";
        echo "<script>window.open('login.php','_self')</script>";
        exit();
    } else {
        $_SESSION['phone'] = $phone;

        // Store the user's login information in the local storage
        echo "<script>
                localStorage.setItem('username', '$phone');
                localStorage.setItem('pin', '$pin');
                // You can store more user information if needed
              </script>";

        echo "<script>window.open('index.php','_self')</script>";
        
        // Update the last login timestamp in the database
        $new_lastLogin = date("Y-m-d h:i:sa");
        mysqli_close($conn);
    }
}*/

// Check if the user is already logged in
if (isset($_SESSION['phone'])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['signin'])) {
    $phone = $_POST['phone'];
    $pin = $_POST['pin'];
    $pinhash = md5($pin);

    $query = "SELECT * FROM `users` WHERE phone='$phone' AND pin = '$pinhash'";
    $result = mysqli_query($conn, $query);
    $rows = mysqli_num_rows($result);

    if ($rows == 0) {
        echo "<script>alert('Phone number or pin is incorrect')</script>";
        echo "<script>window.open('login.php','_self')</script>";
        exit();
    } else {
        $_SESSION['phone'] = $phone;

        // Store the user's login information in the local storage
        echo "<script>
                localStorage.setItem('username', '$phone');
                localStorage.setItem('pin', '$pin');
              </script>";

        echo "<script>window.open('index.php','_self')</script>";

        // Update the last login timestamp in the database
        $new_lastLogin = date("Y-m-d h:i:sa");
        mysqli_close($conn);
    }
}
?>

<!doctype html>
<html lang="en">
<head>
        <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login | hyker fitness app </title>
    <link rel="stylesheet" href="assets/css/styleae52.css">
    <link rel="stylesheet" href="assets/css/style.css">
    
    <!-- Material Design -->
    <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.orange-indigo.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- Material Design -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="description" content="">
    <meta name="keywords" content="" />
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="fav.png" sizes="32x32">
    <link rel="shortcut icon" href="fav.png">
    
    <style>
        .btn-purple {
            background: #ff4aff;
            color: white;
            border: 1px #00ffff solid;
        }
        
        .btn-blue {
            background: #38b6ff;
            color: white;
            border: 1px #ff4aff solid;
        }
        
        .btn-cyan {
            background: #00ffff;
            color: white;
            border: 1px #ff4aff solid;
        }
    
        .bg-blue {
            background: #38b6ff;
            color: white;
            
        }
        
        .bg-purple {
            background: #ff4aff;
            color: white;
        
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

        
        
         .bg-watcher {
            background: #f99907 !important;
        }
         
        
         .btn-grad {background-image: linear-gradient(to right, #780206 0%, #061161  51%, #780206  100%)}
         .btn-grad {
            margin: 10px;
            padding: 15px 45px;
            text-align: center;
            text-transform: uppercase;
            transition: 0.5s;
            background-size: 200% auto;
            color: white;            
            box-shadow: 0 0 20px #eee;
            border-radius: 10px;
            display: block;
          }

          .btn-grad:hover {
            background-position: right center; /* change the direction of the change here */
            color: #fff;
            text-decoration: none;
          }
         
         
         
    </style>
</head>

<body class="bg-light text-dark" >

    <!-- loader -->
    
    <!-- * loader -->

    <!-- App Header -->
    <div class="appHeader no-border transparent position-absolute">
        <div class="left">
            <span><a onclick="window.history.back()" class="headerButton goBack" > <i class="material-icons text-dark">chevron_left</i></a></span>   
        </div>
        <div class="pageTitle">
            <strong>Sign In</strong>
        </div>
        <div class="right">
            
        </div>
        
    </div>
    <!-- * App Header -->

    <!-- App Capsule -->
    <div id="appCapsule">

        <div class="section mt-2 text-center">
            <img src="logo.png" height="130px" width="130px" style="border-radius: 20px;"> 
            <h3 class="text-dark"></h3>
        <small>By continuing, you are setting up a Hykr account and agree to our <a href="#" class="text-info" data-toggle="modal" data-target="#termsModal">User Agreement and Privacy Policy</a> </small>
        </div>
        <div class="section mb-5 p-2">

            <form action="" method="post">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group boxed">
                            <div class="input-group mb-2">
                                <span class="input-group-text material-icons-outlined" id="" style="border-bottom: 0px solid #DCDCE9; display:flex; flex-direction: row;">call</span>
                                <input type="number" class="form-control" id="phone" placeholder="" name="phone">
                            </div>
                        </div>
                        
                        <div class="form-group boxed">
                            <div class="input-group mb-2">
                                <span class="input-group-text material-icons-outlined" id="" style="border-bottom: 0px solid #DCDCE9; display:flex; flex-direction: row;">lock</span>
                                <input type="password" class="form-control" id="pin" placeholder="* * * *" name="pin">
                            </div>
                        </div>
                    </div>
                </div>


                <div class="form-links mt-2 text-center">
                    <div>
                      Dont have an account? <a class="text-info " href="signup.php">Sign up</a> 
                    </div>
                    <!--<div><a href="app-forgot-password.html" class="text-muted">Forgot Password?</a></div>-->
                </div>

                <div class="form-button-group  transparent">
                    <input type="submit"  class=" btn btn-block btn-info btn-lg  mr-1" value="Log in" name="signin">
                </div>
                
                

            </form>
        </div>

    </div>
    <!-- * App Capsule -->



   


</body>



</html>
