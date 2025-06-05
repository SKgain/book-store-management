<?php
// Include the database configuration file
include('db_config.php');

// Get the POST data from the form
$bookId = $_POST['id'];
$title = $_POST['title'];
$authorName = $_POST['authorName'];
$price = $_POST['price'];
$unit = $_POST['unit'];

// Prepare the SQL query to update the book
$sql = "UPDATE books SET title = ?, author_name = ?, price = ?, unit = ? WHERE id = ?";

// Prepare and bind the SQL statement
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssdii", $title, $authorName, $price, $unit, $bookId);

// Execute the query
if ($stmt->execute()) {
    // If the update was successful, redirect to the book list page
    header('Location: book_list.html');
    exit();
} else {
    // If there was an error, display an error message
    echo "Error updating record: " . $conn->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
