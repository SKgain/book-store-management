<?php
// Include the PHP code to fetch user purchase history
include('get_user_pur_history.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Panel User | Purchase History</title>
    <link rel="icon" type="image/x-icon" href="img/weblogo.ico">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/bootstrap.bundle.js"></script>
</head>
<body>
<!-- Navbar -->
<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark shadow-lg">
    <div class="container-fluid">
        <a href="#" class="navbar-brand"><img src="img/icon.png" style="height: 80px; width: 80px;" alt="Library Logo" id="logo-img"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a href="user panel.php" class="nav-link"><h2>User Panel</h2></a></li>
            </ul>
            <a href="user_logout.php"><button class="btn btn-outline-light">Logout</button></a>
        </div>
    </div>
</nav>

<!-- User Purchase History Table -->
<div class="container mt-5">
    <h2 class="text-center">Your Purchase History</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Book ID</th>
                <th>Author Name</th>
                <th>Unit Price</th>
                <th>Quantity</th>
                <th>Purchase Date</th>
            </tr>
        </thead>
        <tbody id="userHistoryTable">
            <!-- PHP will dynamically populate this table -->
            <?php if (!empty($history)): ?>
                <?php foreach ($history as $entry): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($entry['title']); ?></td>
                        <td><?php echo htmlspecialchars($entry['bookId']); ?></td>
                        <td><?php echo htmlspecialchars($entry['author_name']); ?></td>
                        <td><?php echo htmlspecialchars($entry['price']); ?></td>
                        <td><?php echo htmlspecialchars($entry['quantity']); ?></td>
                        <td><?php echo htmlspecialchars($entry['purches_date']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">No purchase history found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>
