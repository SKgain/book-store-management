<?php
// Include database configuration
include('db_config.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $username = $_POST['username'];

    // Sanitize input to prevent SQL injection
    $fullname = $conn->real_escape_string($fullname);
    $email = $conn->real_escape_string($email);
    $username = $conn->real_escape_string($username);

    // SQL query to update the member
    $sql = "UPDATE users SET fullname = '$fullname', email = '$email', username = '$username' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // Redirect to the member list page after successful update
        header("Location: member_list.html");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}
?>
