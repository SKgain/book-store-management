<?php
include('db_config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin WHERE ad_username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();
        if ($password == $admin['password']) {
            // Start session and redirect to admin panel
            session_start();
            $_SESSION['username'] = $username;
            header("Location: admin panel.html"); // Redirect to admin panel after successful login
        } else {
            echo "<script>alert('Wrong Password. Please try again.'); window.location.href='Adminlogin.html';</script>";
        }
    } else {
        echo "<script>alert('Wrong admin name. Please try again.'); window.location.href='Adminlogin.html';</script>";
    }
    $conn->close();
}
?>
