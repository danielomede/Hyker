<?php
include ('config.php');
#ini_set('display_errors',1);
session_start();

$phone = $_POST['phone'];
$pin = $_POST['pin'];
$pinhash = md5($pin);

$query = "SELECT * FROM `users` WHERE phone='$phone' AND pin = '$pinhash'";
$result = mysqli_query($conn, $query);
$rows = mysqli_num_rows($result);

if ($rows == 0) {
    echo "failure"; // Return an appropriate response to indicate login failure
    exit();
} else {
    $_SESSION['phone'] = $phone;

    // Store the user's login information in the local storage
    echo "<script>
            localStorage.setItem('username', '$phone');
            localStorage.setItem('pin', '$pin');
          </script>";

    echo "success"; // Return a response to indicate login success

    // Update the last login timestamp in the database
    $new_lastLogin = date("Y-m-d h:i:sa");
    mysqli_close($conn);
}
?>
