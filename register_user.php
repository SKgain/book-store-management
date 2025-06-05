<?php
include('db_config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash password

    // Check if the username already exists
    $checkUsernameSql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($checkUsernameSql);

    if ($result->num_rows > 0) {
        // If the username exists, show an error
        echo "<script>alert('Username already exists. Please try another username.'); window.location.href='NewUserRegistration.html';</script>";
    } else {
        // If the username is unique, proceed with registration
        $sql = "INSERT INTO users (fullname, email, username, password) VALUES ('$fullname', '$email', '$username', '$password')";
        
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Registration successful.'); window.location.href='Userlogin.html';</script>";
        } else {
            echo "<script>alert('Error: Please try again later.'); window.location.href='NewUserRegistration.html';</script>";
        }
    }

    $conn->close();
}
?>
