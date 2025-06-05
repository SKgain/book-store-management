<?php
session_start();
include 'db_config.php';  // Include the database connection

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit();
}

$username = $_SESSION['username'];  // Assuming the username is stored in the session

// Query the database for the user's profile data
$query = "SELECT fullname, email, username FROM users WHERE username = ?";
$stmt = $conn->prepare($query);

// Check if the statement was prepared correctly
if ($stmt === false) {
    echo json_encode(['error' => 'Failed to prepare query']);
    exit();
}

$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

// Check if a user is found
$user = $result->fetch_assoc();
if (!$user) {
    echo json_encode(['error' => 'User not found']);
    exit();
}

// Return the user profile data as JSON, excluding the password
unset($user['password']);  // Remove password before sending data
echo json_encode($user);
?>
