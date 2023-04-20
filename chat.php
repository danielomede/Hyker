<?php

// Set up the database connection
include 'config.php';

// Retrieve the chat messages from the database
$sql = "SELECT * FROM chat_messages ORDER BY timestamp ASC";
$result = mysqli_query($conn, $sql);

$messages = array();

while ($row = mysqli_fetch_assoc($result)) {
	$messages[] = $row;
}

echo json_encode($messages);


mysqli_close($conn);

?>
