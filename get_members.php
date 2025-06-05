<?php
include('db_config.php');

// Prepare the SQL query to fetch all members from the "users" table
$sql = "SELECT id, fullname, email, username FROM users";
$result = $conn->query($sql);

// Check if we have any rows
if ($result->num_rows > 0) {
    // Initialize an array to hold the members
    $members = [];

    // Fetch each row and add it to the $members array
    while ($row = $result->fetch_assoc()) {
        $members[] = $row;
    }

    // Return the members as a JSON response
    echo json_encode($members);
} else {
    // If no members, return an empty array
    echo json_encode([]);
}

// Close the database connection
$conn->close();
?>
