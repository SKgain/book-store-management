<?php
// Include the database configuration file
include('db_config.php');

// Get the ID of the message to delete from the POST request
$data = json_decode(file_get_contents('php://input'), true);
$message_id = $data['id'];

// Prepare the SQL query to delete the message from the database
$sql = "DELETE FROM message WHERE id = ?";

// Prepare and bind the SQL statement
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $message_id);

if ($stmt->execute()) {
    // If the message was deleted successfully, return a success response
    echo json_encode(['success' => true]);
} else {
    // If there was an error, return a failure response
    echo json_encode(['success' => false]);
}

// Close the prepared statement and database connection
$stmt->close();
$conn->close();
?>
