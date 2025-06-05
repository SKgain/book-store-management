<?php
// Include the database configuration file
include('db_config.php');

// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

header("Content-Type: application/json");

// Query to find the top 10 users based on quantity
$sql = "
    SELECT user_name, SUM(quantity) AS total_quantity
    FROM sold_book
    GROUP BY user_name
    ORDER BY total_quantity DESC
    LIMIT 10
";

$result = $conn->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        $users = $result->fetch_all(MYSQLI_ASSOC); // Fetch all rows as associative array
        echo json_encode($users); // Return data as JSON
    } else {
        echo json_encode([]); // Return empty array if no results
    }
} else {
    echo json_encode(["error" => "Query failed: " . $conn->error]);
}

// Close the database connection
$conn->close();
?>
