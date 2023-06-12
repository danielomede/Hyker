<?php

include 'auth.php';

// Assume you have a database connection established

// Query the database to check if the user has filled in their information
$query2 = "SELECT * FROM users WHERE reference = $reference";
$result2 = mysqli_query($conn, $query2);

if ($result2) {
    $info = mysqli_fetch_assoc($result2);
    
    // Check if date of birth, height, and weight are empty
    if (empty($info['dob']) || empty($info['height']) || empty($info['weight'])) {
        echo "
        <div  class='notification-box show'>
            <div class='notification-dialog android-style'>
                <div class='notification-header'>
                    <div class='in'>
                        <img src='fav.png' alt='image' class='imaged w24 rounded'>
                        <strong>Hyker</strong>
                    </div>
                </div>
                <div class='notification-content'>
                    <div class='i'>
                        <h3 class='subtitle'>Please fill in your date of birth, height and weight for accurate calorie tracking</h3>
                        <a href='settings.php' class='text-info'>
                            SETTINGS
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        ";
        
        
    }
}
?>
