<?php
// Include the database configuration file
include('db_config.php');

// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

header("Content-Type: application/json");

// Check if a user_name is provided in the GET request
if (isset($_GET['user_name']) && !empty($_GET['user_name'])) {
    $user_name = $conn->real_escape_string($_GET['user_name']);

    // Query to fetch the purchase history for the given user_name
    $sql = "
        SELECT title, bookId, author_name, price, quantity, purches_date
        FROM sold_book
        WHERE user_name = '$user_name'
        ORDER BY purches_date DESC
    ";

    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            $history = $result->fetch_all(MYSQLI_ASSOC); // Fetch all rows as associative array
            echo json_encode($history); // Return data as JSON
        } else {
            echo json_encode([]); // Return empty array if no history found
        }
    } else {
        echo json_encode(["error" => "Query failed: " . $conn->error]);
    }
} else {
    echo json_encode(["error" => "No user_name provided"]);
}

// Close the database connection
$conn->close();
?>
