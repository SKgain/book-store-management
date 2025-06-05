<?php
// Include the database configuration file
include('db_config.php');

// Prepare the SQL query to fetch all books from the "books" table
$sql = "SELECT id, title, author_name, price, unit, language FROM books";
$result = $conn->query($sql);

// Check if we have any books in the database
if ($result->num_rows > 0) {
    // Initialize an array to hold the books
    $books = [];

    // Fetch each row and add it to the $books array
    while ($row = $result->fetch_assoc()) {
        $books[] = $row;
    }

    // Return the books as a JSON response
    echo json_encode($books);
} else {
    // If no books, return an empty array
    echo json_encode([]);
}

// Close the database connection
$conn->close();
?>
