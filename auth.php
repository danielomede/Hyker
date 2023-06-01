<?php
include 'config.php';
session_start();
if(!isset($_SESSION["phone"])){
header("Location: login.php ");
exit(); }

$user = $_SESSION['phone'];
$query = "SELECT * FROM users WHERE phone = '$user'";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_array($result);

//USER DATA 
$userid        = $row['id'];
$email          = $row['email'];
$username = $row['username'];
$getuser          = $row['name'];
$phone    = $row['phone'];
$pin      = $row['pin'];
$lastLoginAt    = $row['lastLoginAt'];
$createdAt      = $row['createdAt'];
$imgurl         = $row['imgurl'];

?>
