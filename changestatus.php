<?php
include 'config.php';
$ref                = $_GET['ref'];
$geteventd          = "SELECT * FROM `events` WHERE `reference` = '$ref' ";
$eventresult        = mysqli_query($conn,$geteventd);
$eventrow           = mysqli_fetch_array($eventresult);
//Table variables



$update = "UPDATE `events` SET  `status`='Ongoing' WHERE `events`.`reference` ='$ref'";
    	
        	if (mysqli_query($conn, $update)) {
        	     
            	echo "<script>window.history.back()</script>";
            } else {
                echo "Error: " . $update . "<br>" . mysqli_error($conn);
            }    
//$eventstatus = ''; // Replace with the variable that holds the event status

// Simulate fetching the event status from a database or any other data source
// For demonstration purposes, we're simply assigning a static value here
//$eventstatus = 'Ongoing';

?>
