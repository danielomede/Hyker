<?php
// Handle the database connection
$servername = "localhost"; 
$username = "hoppert1_admin";
$password = "jaykay007";
$dbname = "hoppert1_hyker";  

// Create a new PDO instance
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Get the trail data from the POST request
$startingPoint = $_POST['startingpoint'];
$endPoint = $_POST['endpoint'];
$trailData = $_POST['traildata'];
$duration = $_POST['duration'];
$recordedBy = $_POST['recordedby'];
$distance = $_POST['distance'];

// Generate a random trail reference code
$reference = "TR" . generateRandomCode(10);

// Prepare the SQL statement to insert the trail data into the 'trails' table
$stmt = $conn->prepare("INSERT INTO trails (startpoint, traildata, endpoint, duration, distance, recordedby, reference) VALUES (:startpoint, :traildata, :endpoint, :duration, :distance, :recordedby, :reference)");

// Bind the parameters
$stmt->bindParam(':startpoint', $startingPoint);
$stmt->bindParam(':traildata', $trailData);
$stmt->bindParam(':endpoint', $endPoint);
$stmt->bindParam(':duration', $duration);
$stmt->bindParam(':distance', $distance); // Corrected binding for $distance
$stmt->bindParam(':recordedby', $recordedBy);
$stmt->bindParam(':reference', $reference);

// Execute the statement
$stmt->execute();



// Get the last inserted trail ID
$trailId = $conn->lastInsertId();

// Prepare the SQL statement to insert the trail membership data into the 'trail_members' table
$stmt2 = $conn->prepare("INSERT INTO trail_members (session, trail_ref, userid) VALUES (:session, :trail_ref, :userid)");

// Generate a random session code
$session = generateRandomCode(10);

// Bind the parameters
$stmt2->bindParam(':session', $session);
$stmt2->bindParam(':trail_ref', $reference);
$stmt2->bindParam(':userid', $recordedBy);

// Execute the statement
$stmt2->execute();

// Redirect to the trail summary page with the trail ID as a parameter
echo $trailId;

// Function to generate a random alphanumeric code
function generateRandomCode($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $code = '';
    $characterCount = strlen($characters);

    for ($i = 0; $i < $length; $i++) {
        $code .= $characters[rand(0, $characterCount - 1)];
    }

    return $code;
}
?>
