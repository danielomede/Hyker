<?php
include 'config.php';
$ref                = $_GET['ref'];
$geteventd          = "SELECT * FROM `events` WHERE `reference` = '$ref' ";
$eventresult        = mysqli_query($conn,$geteventd);
$eventrow           = mysqli_fetch_array($eventresult);
//Table variables

$eventstatus        = $eventrow['status'];


//$eventstatus = ''; // Replace with the variable that holds the event status

// Simulate fetching the event status from a database or any other data source
// For demonstration purposes, we're simply assigning a static value here
//$eventstatus = 'Ongoing';

$response = array('status' => $eventstatus);
echo json_encode($response);
?>
