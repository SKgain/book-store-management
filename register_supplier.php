<?php
include('db_config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
   

    // Check if the supplier already exists
    $checkUsernameSql = "SELECT * FROM supplier WHERE fullname='$fullname'";
    $result = $conn->query($checkUsernameSql);

    if ($result->num_rows > 0) {
        // If the supplier exists, show an error
        echo "<script>alert('Same Supplier is already exists. Please rewrite the supplier name.'); window.location.href='supplier_registration.html';</script>";
    } else {
        // If the supplier is unique, proceed with registration
        $sql = "INSERT INTO supplier (fullname, email, address) VALUES ('$fullname', '$email', '$address')";
        
        if ($conn->query($sql) === TRUE) {
            echo "<script>window.location.href='supplier_list.html';</script>";
        } else {
            echo "<script>alert('Error: Please try again later.'); window.location.href='supplier_registration.html';</script>";
        }
    }

    $conn->close();
}
?>
