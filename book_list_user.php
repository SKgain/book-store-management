<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User panel | Book list</title>
    <!-- favicon -->
     <link rel="icon" type="image/x-icon" href="img/weblogo.ico">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php

session_start();

?>

<!-- Navbar -->
<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark shadow-lg">
    <div class="container-fluid">
        <a href="#" class="navbar-brand"><img src="img/icon.png" style="height: 80px !important; width: 80px !important;" alt="Library Logo" id="logo-img"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a href="user panel.php" target="_top" class="nav-link"><h2>User Panel</h2></a></li>
            </ul>
            <a href="user_logout.php"><button class="btn btn-outline-light" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAuth">logout</button></a>
        </div>
    </div>
</nav>

<!-- Book List Table -->
<div class="container mt-5">
    <h2 class="text-center">Book List</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Author Name</th>
                <th>Price</th>
                <th>Unit</th>
                <th>Language</th>
                <th>Action</th> <!-- Column for Buy and Borrow buttons -->
            </tr>
        </thead>
        <tbody id="bookList">
            <!-- Book list will be dynamically inserted here -->
        </tbody>
    </table>
</div>

<script src="js/bootstrap.bundle.js"></script>

<script>
// Fetch the book list from the server when the page loads
window.onload = function() {
    fetch('get_books_user.php')
        .then(response => response.json())
        .then(data => {
            const bookList = document.getElementById('bookList');
            data.forEach(book => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${book.id}</td>
                    <td>${book.title}</td>
                    <td>${book.author_name}</td>
                    <td>${book.price}</td>
                    <td>${book.unit}</td>
                    <td>${book.language}</td>
                    <td>
                        <button class="btn btn-warning btn-sm" onclick="buyBook(${book.id})">Buy</button>
                    </td>
                `;
                bookList.appendChild(row);
            });
        })
        .catch(error => console.error('Error fetching book list:', error));
};

// Redirect to buy book with the book id
function buyBook(id) {
    window.location.href = `buy_book.php?id=${id}`;
}

// Function to delete a book

</script>

</body>
</html>
