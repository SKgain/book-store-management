<?php
// Start the session to access session variables
session_start();

// Include the database configuration file
include('db_config.php');

// Check if the user is logged in by verifying the session variable
if (!isset($_SESSION['username'])) {
    // Redirect to login page if the user is not logged in
    header("Location: login.php");
    exit();
}

// Get the user name from session
$user_name = $_SESSION['username'];

// Prepare SQL query to fetch user purchase history based on session user_name
$sql = "
    SELECT title, bookId, author_name, price, quantity, purches_date
    FROM sold_book
    WHERE user_name = '$user_name'
    ORDER BY purches_date DESC
";

$result = $conn->query($sql);

// Check if the query returned any results
if ($result->num_rows > 0) {
    $history = [];
    while ($row = $result->fetch_assoc()) {
        $history[] = $row;
    }
} else {
    $history = [];
}

// Close the database connection
$conn->close();
?>
