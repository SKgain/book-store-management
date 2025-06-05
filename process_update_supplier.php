<?php
// Include database configuration
include('db_config.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    // Sanitize input to prevent SQL injection
    $fullname = $conn->real_escape_string($fullname);
    $email = $conn->real_escape_string($email);
    $address = $conn->real_escape_string( $address);

    // SQL query to update the supplier
    $sql = "UPDATE supplier SET fullname = '$fullname', email = '$email', Address = ' $address' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // Redirect to the supplier list page after successful update
        header("Location: supplier_list.html");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}
?>
