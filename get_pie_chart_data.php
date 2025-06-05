<?php
// Include the database configuration file
include('db_config.php');

// SQL Query to fetch books sold by month
$sql = "SELECT MONTH(purches_date) AS month, SUM(quantity) AS total_books_sold 
        FROM sold_book 
        GROUP BY MONTH(purches_date)";

// Execute the query
$result = $conn->query($sql);

// Initialize an empty array to store the data
$data = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $monthName = date("F", mktime(0, 0, 0, $row['month'], 10)); // Convert month number to name
        $data[] = ['month' => $monthName, 'total' => $row['total_books_sold']];
    }
}

// Close the database connection
$conn->close();

// Return the data in JSON format
echo json_encode($data);
?>

