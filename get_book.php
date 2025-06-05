<?php
// Include the database configuration file
include('db_config.php');

// Get the book ID from the query parameter
$bookId = $_GET['id'];

// Prepare the SQL query to fetch the book details
$sql = "SELECT id, title, author_name, price, unit FROM books WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $bookId);
$stmt->execute();
$result = $stmt->get_result();

// Check if the book exists
if ($result->num_rows > 0) {
    // Fetch the book data and return it as a JSON response
    $book = $result->fetch_assoc();
    echo json_encode($book);
} else {
    // If no book found, return an empty response
    echo json_encode([]);
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
