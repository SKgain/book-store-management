<?php
session_start();
include('db_config.php');

// Get the book ID from the query string
$bookId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($bookId > 0) {
    // Fetch the book details from the database
    $sql = "SELECT * FROM books WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $bookId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $book = $result->fetch_assoc();
    } else {
        echo "Book not found.";
        exit();
    }
} else {
    echo "Invalid book ID.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User panel | Buy Book</title>
    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="img/weblogo.ico">
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Buy Book</h2>
    <form action="process_buy_book.php" method="POST" id="buyBookForm">
        <input type="hidden" name="bookId" value="<?= $book['id'] ?>">

        <div class="mb-3">
            <label for="username" class="form-label">User Name</label>
            <input type="text" class="form-control" id="username" name="username" 
                   value="<?= htmlspecialchars($_SESSION['username']) ?>" readonly>
        </div>

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" 
                   value="<?= htmlspecialchars($book['title']) ?>" readonly>
        </div>

        <div class="mb-3">
            <label for="authorName" class="form-label">Author Name</label>
            <input type="text" class="form-control" id="authorName" name="authorName" 
                   value="<?= htmlspecialchars($book['author_name']) ?>" readonly>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Unit Price</label>
            <input type="number" class="form-control" id="price" name="price" 
                   value="<?= $book['price'] ?>" readonly step="0.01">
        </div>

        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" class="form-control" id="quantity" name="quantity" 
                   min="1" max="<?= $book['unit'] ?>" required>
        </div>

        <div class="mb-3">
            <label for="totalPrice" class="form-label">Total Price</label>
            <input type="text" class="form-control" id="totalPrice" readonly>
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Purchase Date</label>
            <input type="date" class="form-control" id="date" name="date" required>
        </div>

        <button type="submit" class="btn btn-primary">Buy</button>
    </form>
</div>

<script src="js/bootstrap.bundle.js"></script>
<script>
    const quantityInput = document.getElementById('quantity');
    const priceInput = document.getElementById('price');
    const totalPriceInput = document.getElementById('totalPrice');

    // Update total price dynamically as quantity changes
    quantityInput.addEventListener('input', () => {
        const quantity = parseFloat(quantityInput.value) || 0;
        const price = parseFloat(priceInput.value) || 0;
        const total = quantity * price;
        totalPriceInput.value = total.toFixed(2);
    });
</script>
</body>
</html>
