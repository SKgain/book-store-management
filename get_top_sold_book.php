<?php

// Include the database configuration file
include('db_config.php');

// Query to get the top sold book
$sql = "SELECT 
            bookId, 
            title, 
            author_name, 
            SUM(quantity) AS total_sold 
        FROM 
            sold_book 
        GROUP BY 
            bookId, title, author_name 
        ORDER BY 
            total_sold DESC 
        LIMIT 1";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output the top sold book
    while ($row = $result->fetch_assoc()) {
        echo "<div class='card p-4'style='font-size: smaller; height: 230px !important;'>";
        echo "<h6 class='text-center' style='color:green'>Top Sold Book</h6>";
        echo "<p><strong>Book ID:</strong> " . $row["bookId"] . "</p>";
        echo "<p><strong>Title:</strong> " . $row["title"] . "</p>";
        echo "<p><strong>Author:</strong> " . $row["author_name"] . "</p>";
        echo "<p><strong>Total Sold:</strong> " . $row["total_sold"] . "</p>";
        echo "</div>";
    }
} else {
    echo "<p>No data found.</p>";
}

$conn->close();
?>
