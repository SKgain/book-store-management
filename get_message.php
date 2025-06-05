<?php
// Include the database configuration file
include('db_config.php');

// Prepare the SQL query to fetch all messages from the "message" table
$sql = "SELECT id, fullname, email, message FROM message";
$result = $conn->query($sql);

// Check if we have any messages in the database
if ($result->num_rows > 0) {
    // Initialize an array to hold the messages
    $messages = [];

    // Fetch each row and add it to the $messages array
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }

    // Return the messages as a JSON response
    echo json_encode($messages);
} else {
    // If no messages, return an empty array
    echo json_encode([]);
}

// Close the database connection
$conn->close();
?>
