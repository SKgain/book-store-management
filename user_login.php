<?php
include('db_config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Start session and redirect to user panel
            session_start();
            
            $_SESSION['username'] = $user['username'];
            $_SESSION['fullname'] = $user['fullname'];
            $_SESSION['email'] = $user['email'];
            header("Location: user panel.php"); // Redirect to user panel after successful login
        } else {
            echo "<script>alert('Wrong Password. Please try again.'); window.location.href='Userlogin.html';</script>";
        }
    } else {
        echo "<script>alert('No user found with that username. Please try again.'); window.location.href='Userlogin.html';</script>";
    }
    $conn->close();
}
?>
