<?php
// Include database configuration
include('db_config.php');

// Read the input data sent by the frontend
$data = json_decode(file_get_contents('php://input'), true); // Get the JSON input
$id = $data['id'];
$fullname = $data['fullname'];
$email = $data['email'];
$username = $data['username'];

// Validate and sanitize input
$fullname = $conn->real_escape_string($fullname);
$email = $conn->real_escape_string($email);
$username = $conn->real_escape_string($username);

// SQL query to update the member information
$sql = "UPDATE users SET fullname = '$fullname', email = '$email', username = '$username' WHERE id = $id";

// Execute the query and check for success
if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true]); // Return success response
} else {
    echo json_encode(['success' => false, 'error' => $conn->error]); // Return error message
}

$conn->close(); // Close the database connection
?>
