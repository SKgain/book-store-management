<?php
include('db_config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect user input from the form
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Prepare an SQL statement
    $stmt = $conn->prepare("INSERT INTO message (fullname, email, message) VALUES (?, ?, ?)");

    // Bind parameters to the SQL query (s for string, i for integer, etc.)
    $stmt->bind_param("sss", $fullname, $email, $message);

    // Execute the prepared statement
    if ($stmt->execute()) {
        echo "<script>alert('Message sent successfully.'); window.location.href='index.html';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
