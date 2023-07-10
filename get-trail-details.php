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

// Get the startpoint from the query parameter
$startpoint = $_GET['startpoint'];

// Prepare the SQL statement to fetch the trail details
$stmt = $conn->prepare("SELECT * FROM trails WHERE startpoint = :startpoint");
$stmt->bindParam(':startpoint', $startpoint);

// Execute the statement
$stmt->execute();

// Fetch the trail details
$trailDetails = $stmt->fetch(PDO::FETCH_ASSOC);

// Return the trail details as JSON response
header('Content-Type: application/json');
echo json_encode($trailDetails);
?>
