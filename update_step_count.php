<?php
include 'auth.php';

// Retrieve the data from the POST request
$data = json_decode(file_get_contents('php://input'), true);

// Extract the values
$userReference = $data['userReference'];
$sessionCode = $data['sessionCode'];
$stepCount = $data['stepCount'];
//$caloriesBurned = $data['caloriesBurned'];
$caloriesBurned = round($data['caloriesBurned'], 2); // Round to 2 decimal places


// Update the data row in the program_members table
$sql = "UPDATE program_members SET data = JSON_ARRAY('$stepCount', '$caloriesBurned') WHERE user = '$userReference' AND session_id = '$sessionCode'";

if ($conn->query($sql) === true) {
  $response = ['message' => 'Program member data updated successfully'];
  echo json_encode($response);
} else {
  $response = ['message' => 'Error updating program member data: ' . $conn->error];
  echo json_encode($response);
}

// Close the database connection
$conn->close();
?>
