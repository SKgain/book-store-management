<?php
// Include the database configuration file
include('db_config.php');

// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

header("Content-Type: application/json");

// Prepare the SQL query to fetch all books from the "sold_book" table
$sql = "SELECT id, user_name, title, bookId, author_name, price, quantity, purches_date FROM sold_book";
$result = $conn->query($sql);

if ($result) {
    // Check if there are any books
    if ($result->num_rows > 0) {
        $books = $result->fetch_all(MYSQLI_ASSOC); // Fetch all rows as an associative array
        echo json_encode($books); // Return books as JSON
    } else {
        echo json_encode([]); // Return an empty array if no books
    }
} else {
    echo json_encode(["error" => "Failed to execute query: " . $conn->error]);
}

// Close the database connection
$conn->close();
?>
