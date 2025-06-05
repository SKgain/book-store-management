<?php
// Start the session
session_start();

// Destroy the session
session_destroy();

// Redirect to the login page
header("Location: Userlogin.html");
exit();
?>
