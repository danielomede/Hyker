<?php
include 'config.php';
// Get name and message data from AJAX request
$name = mysqli_real_escape_string($conn, $_POST['name']);
$message = mysqli_real_escape_string($conn, $_POST['message']);

// Insert new message into database
$sql = "INSERT INTO chat_messages (name, message) VALUES ('$name', '$message')";
if ($conn->query($sql) === TRUE) {
    echo "New message inserted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
