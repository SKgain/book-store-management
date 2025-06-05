<?php
// get_books.php

include 'db_config.php';  // Include database connection

// Fetch all books from the database
$query = "SELECT id, title, author_name, price, unit, language FROM books";
$result = $conn->query($query);

// Check if books were found
if ($result->num_rows > 0) {
    $books = [];
    while ($row = $result->fetch_assoc()) {
        $books[] = $row;  // Add each book to the books array
    }
    echo json_encode($books);  // Return books as JSON
} else {
    echo json_encode([]);  // Return an empty array if no books are found
}

$conn->close();
?>
