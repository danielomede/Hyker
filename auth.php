<?php
include 'config.php';
#ini_set('display_errors',1);
session_start();
/*if(!isset($_SESSION["phone"])){
echo "
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Check if the user's login information exists in the local storage
      const username = localStorage.getItem('username');
      const pin = localStorage.getItem('pin');
      // If the login information exists, automatically log in the user
    
        if (username && pin) {
        // Perform the login process using the retrieved login information
        // You can implement your login logic here, such as setting session variables, updating UI, etc.
        // Example:
            login(username, pin);
        }    
    
    
  });

  function login(phone, pin) {
    // Get the form values
    //var phone = document.getElementById('phone').value;
    //var pin = document.getElementById('pin').value;

    // Perform the login request
    // Perform the login request using AJAX
      $.ajax({
        url: 'login.php', // Replace with your login PHP file
        method: 'POST',
        data: { phone: phone, pin: pin },
        success: function(response) {
          // Check the response from the server
          if (response === 'success') {
            // Login successful
            localStorage.setItem('username', phone);
            localStorage.setItem('pin', pin);
            window.open('index.php', '_self');
          } else {
            // Login failed
            alert('Phone number or PIN is incorrect');
            window.open('login.php', '_self');
          }
        },
        error: function(error) {
          console.error('Error during login request:', error);
        }
      });
        // ... your login request code here ...

    // Store the username in the local storage
    localStorage.setItem('username', phone);
    localStorage.setItem('pin', pin);
  }
</script>
";
#header("Location: login.php ");
exit(); }*/

// Check if session is set
if (!isset($_SESSION["phone"])) {
    // Check if the user's login information exists in the local storage
    echo "
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const username = localStorage.getItem('username');
            const pin = localStorage.getItem('pin');
            
            if (username && pin) {
                // Perform the auto-login process
                login(username, pin);
            } else {
                // Redirect to the login page
                window.open('login.php', '_self');
            }
        });

        function login(phone, pin) {
            $.ajax({
                url: 'autologin.php',
                method: 'POST',
                data: { phone: phone, pin: pin },
                success: function(response) {
                    if (response === 'success') {
                        localStorage.setItem('username', phone);
                        localStorage.setItem('pin', pin);
                        window.open('index.php', '_self');
                    } else {
                        alert('Phone number or PIN is incorrect');
                        window.open('login.php', '_self');
                    }
                },
                error: function(error) {
                    console.error('Error during login request:', error);
                }
            });
        }
    </script>
    ";
    exit();
}


$user = $_SESSION['phone'];
$query = "SELECT * FROM users WHERE phone = '$user'";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_array($result);

//USER DATA 
$userid         = $row['id'];
$email          = $row['email'];
$username       = $row['username'];
$getuser        = $row['name'];
$phone          = $row['phone'];
$pin            = $row['pin'];
$reference      = $row['reference'];
$lastLoginAt    = $row['lastLoginAt'];
$createdAt      = $row['createdAt'];
$imgurl         = $row['imgurl'];
$dob            = $row['dob'];
$height         = $row['height'];
$weight         = $row['weight'];

$weightInKg = $weight * 0.45359237;
$formattedWeightInKg = number_format($weightInKg, 1);
$dateOfBirth = $dob; // Example date of birth

// Convert the date of birth to a DateTime object
$dobs = DateTime::createFromFormat('Y-m-d', $dateOfBirth);

// Get the current date
$currentDate = new DateTime();

// Calculate the difference between the current date and the date of birth
$age = $currentDate->diff($dobs)->y;

// Output the current age
//echo "Current age: " . $age . " years";


?>
<!-- Add this JavaScript code to your HTML file -->

