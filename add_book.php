<?php
// Include database configuration
include('db_config.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $title = $_POST['title'];
    $authorName = $_POST['authorName'];
    $price = $_POST['price'];
    $unit = $_POST['unit'];
    $language = $_POST['language'];

    // Sanitize input to prevent SQL injection
    $title = $conn->real_escape_string($title);
    $authorName = $conn->real_escape_string($authorName);
    $price = $conn->real_escape_string($price);
    $unit = $conn->real_escape_string($unit);
    $language = $conn->real_escape_string($language);

    // SQL query to insert the book into the database
    $sql = "INSERT INTO books (title, author_name, price, unit, language) 
            VALUES ('$title', '$authorName', '$price', '$unit', '$language')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to a success page or back to the form with a success message
        echo "<script>window.location.href='book_list.html';</script>";
        // Optionally, redirect back to the add book page
        // header("Location: add_book.html"); 
    } else {
        // Error inserting the book
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
