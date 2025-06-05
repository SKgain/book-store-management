<?php
// Include the database configuration file
session_start();
include('db_config.php');

// Get the POST data from the form
$user_name = $_POST['username']; 
$bookId = $_POST['bookId'];
$title = $_POST['title'];
$authorName = $_POST['authorName'];
$price = $_POST['price'];
$quantity = $_POST['quantity'];
$date = $_POST['date'];

// Prepare the SQL query to insert data into the sold_book table
$sql = "INSERT INTO sold_book (user_name, title, bookId, author_name, price, quantity, purches_date) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";

// Prepare the SQL statement
$stmt = $conn->prepare($sql);

if ($stmt) {
    // Bind the parameters to the SQL statement
    $stmt->bind_param("ssisdis", $user_name, $title, $bookId, $authorName, $price, $quantity, $date);

    // Execute the query
    if ($stmt->execute()) {
        // Now reduce the quantity in the books table
        $updateQuery = "UPDATE books SET unit = unit - ? WHERE id = ?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param("ii", $quantity, $bookId);

        if ($updateStmt->execute()) {
            // Redirect to the book list page upon success
            // header('Location: book_list_user.php');
            header("Location: generate_invoice.php?bookId=$bookId&quantity=$quantity");
            exit();
        } else {
            // Handle error reducing units from books table
            echo "Error updating book stock: " . $updateStmt->error;
        }

        // Close the update statement
        $updateStmt->close();
    } else {
        // Handle query execution error for inserting into sold_book
        echo "Error executing query: " . $stmt->error;
    }

    // Close the main statement
    $stmt->close();
} else {
    // Handle SQL preparation error for inserting into sold_book
    echo "Error preparing query: " . $conn->error;
}

// Close the database connection
$conn->close();
?>

<!-- Saikat -->