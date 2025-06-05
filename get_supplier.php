<?php
// Include database configuration
include('db_config.php');

// Get the member ID from the URL query string
$id = $_GET['id'];

// Fetch the member data from the database
$sql = "SELECT * FROM supplier WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Return the member data as JSON
    echo json_encode($result->fetch_assoc());
} else {
    echo json_encode(null);  // Member not found
}

$conn->close();
?>
