<?php
// Include the database configuration file
include('db_config.php');

// Get the ID of the book to delete from the POST request
$data = json_decode(file_get_contents('php://input'), true);
$book_id = $data['id'];

// Prepare the SQL query to delete the book from the database
$sql = "DELETE FROM books WHERE id = ?";

// Prepare and bind the SQL statement
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $book_id);

if ($stmt->execute()) {
    // If the book was deleted successfully, return a success response
    echo json_encode(['success' => true]);
} else {
    // If there was an error, return a failure response
    echo json_encode(['success' => false]);
}

// Close the prepared statement and database connection
$stmt->close();
$conn->close();
?>
