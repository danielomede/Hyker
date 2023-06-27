<?php

// Get the data from the POST request
$data = json_decode(file_get_contents('php://input'), true);

// Extract the values from the data
$userReference = $data['userReference'];
$stepFitReference = $data['stepFitReference'];
$sessionCode = $data['sessionCode'];

// TODO: Validate and sanitize the input data

// Perform the database insertion
$servername = "localhost"; 
$username = "hoppert1_admin";
$password = "jaykay007";
$dbname = "hoppert1_hyker";  

try {
  // Create a new PDO instance
  $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  
  // Set the PDO error mode to exception
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  // Prepare the SQL statement
  $stmt = $pdo->prepare("INSERT INTO program_members (reference, user, session_id, timestamp) VALUES (:reference, :user, :sessionCode, CURRENT_TIMESTAMP)");
  
  // Bind the parameters
  $stmt->bindParam(':reference', $stepFitReference);
  $stmt->bindParam(':user', $userReference);
  $stmt->bindParam(':sessionCode', $sessionCode);
  
  // Execute the statement
  $stmt->execute();
  
  // Return a success message
  echo "Program member inserted successfully!";
} catch(PDOException $e) {
  // Return an error message
  echo "Error inserting program member: " . $e->getMessage();
}


?>
