<?php
session_start();
include('db_config.php');

$bookId = isset($_GET['bookId']) ? (int)$_GET['bookId'] : 0;
$quantity = isset($_GET['quantity']) ? (int)$_GET['quantity'] : 1;

// Fetch book details from the database
if ($bookId > 0) {
    $sql = "SELECT * FROM books WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $bookId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $book = $result->fetch_assoc();
        $totalPrice = $book['price'] * $quantity;
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
  <title>User panel | Invoice</title>
  <link rel="stylesheet" href="css/bootstrap.css">
  <!-- favicon -->
  <link rel="icon" type="image/x-icon" href="img/weblogo.ico">
  <style>
    body {
      font-family: Arial, sans-serif;
    }
    .invoice-container {
      max-width: 800px;
      margin: 20px auto;
      border: 1px solid #ccc;
      padding: 20px;
      border-radius: 8px;
    }
    header, section {
      margin-bottom: 20px;
    }
    .company-info, .invoice-info {
      display: inline-block;
      vertical-align: top;
      width: 48%;
    }
    .company-info h1 {
      margin: 0;
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    table th, table td {
      border: 1px solid #ddd;
      padding: 8px;
    }
    table th {
      background-color: #f2f2f2;
      text-align: left;
    }
    footer {
      text-align: center;
      margin-top: 20px;
    }
  </style>
</head>
<body>

<div class="invoice-container">
  <header>
    <div class="col-12 text-center"><h2>Invoice</h2></div>
    <div class="d-flex justify-content-between">
        <div class="company-info">
        <h4>Book Point</h4>
        <p><strong>Email:</strong> info@bookpoint.com</p>
        <p><strong>Phone:</strong> +880 1319806363</p>
        </div>
        <div >
        
        </div>
    </div>
  </header>

  <section class="customer-info">
    <h4>Customer Information</h4>
    <p><strong>Name:</strong> <?= htmlspecialchars($_SESSION['fullname']) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($_SESSION['email']) ?></p>
  </section>

  <section class="items">
    <h3>Item Details</h3>
    <table>
      <thead>
        <tr>
          <th>Book Title</th>
          <th>Author</th>
          <th>Unit Price</th>
          <th>Quantity</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?= htmlspecialchars($book['title']) ?></td>
          <td><?= htmlspecialchars($book['author_name']) ?></td>
          <td><?= number_format($book['price'], 2) ?></td>
          <td><?= htmlspecialchars($quantity) ?></td>
          <td><?= number_format($totalPrice, 2) ?></td>
        </tr>
      </tbody>
    </table>
  </section>

  <footer>
    <a href="user panel.php" class="btn btn-primary">Back to User Panel</a>
    <button onclick="window.print()" class="btn btn-success">Print Invoice</button>
  </footer>
</div>

<script src="js/bootstrap.bundle.js"></script>
</body>
</html>
