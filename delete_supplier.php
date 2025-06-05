<?php
include('db_config.php');

$data = json_decode(file_get_contents('php://input'), true); // Get data from the body
$id = $data['id']; // Get the member ID to delete

// Query to delete the member by ID
$sql = "DELETE FROM supplier WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}

$conn->close();
?>
