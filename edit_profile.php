<?php
session_start();
include 'db_config.php';  // Include the database connection

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit();
}

$username = $_SESSION['username'];  // Assuming the username is stored in the session

// Collect the updated data from the form
$fullname = $_POST['fullname'];
$email = $_POST['email'];
$password = $_POST['password'];

// If the password field is not empty, hash the new password
if (!empty($password)) {
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $query = "UPDATE users SET fullname = ?, email = ?, password = ? WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $fullname, $email, $hashed_password, $username);
} else {
    // If no password is provided, don't change the password
    $query = "UPDATE users SET fullname = ?, email = ? WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $fullname, $email, $username);
}

// Check if the statement was prepared correctly
if ($stmt === false) {
    echo json_encode(['error' => 'Failed to prepare query']);
    exit();
}

$stmt->execute();

// Check if the update was successful
if ($stmt->affected_rows > 0) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['error' => 'No changes made or update failed']);
}

$stmt->close();
$conn->close();
?>
