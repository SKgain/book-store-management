<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Point | User Panel</title>
    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="img/weblogo.ico">
    <!-- css link here -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/Styel.css">
    <!-- google fonts link -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Satisfy&display=swap" rel="stylesheet">
    <!-- font awesome link -->
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
</head>
<body>

<?php
session_start();
?>

<!-- Navbar -->
<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark shadow-lg">
    <div class="container-fluid">
        <a href="#" class="navbar-brand">
            <img src="img/icon.png" class="img-fluid" style="height: 80px; width: 80px;" alt="Library Logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a href="user panel.php" target="_top" class="nav-link"><h2>User Panel</h2></a></li>
            </ul>
            <a href="user_logout.php"><button class="btn btn-outline-light">Logout</button></a>
        </div>
    </div>
</nav>

<!-- Body -->
<div class="container-fluid p-5">
    <h5>Hello, <?= htmlspecialchars($_SESSION['fullname']) ?></h5>
    <div class="row">
        <!-- Dashboard -->
        <div class="col-12 col-md-4 col-lg-3 border-end border-dark pe-md-4">
            <div class="row">
                <!-- Current Time -->
                <div class="col-12">
                    <div class="card p-4 mt-3">
                        <div class="time-container">
                            Current Time: <span id="live-time"></span>
                        </div>
                    </div>
                </div>
                <!-- Top Sold Book - Pie Chart -->
                <div class="col-12 mt-4">
                    <div id="topSoldBook" style="height: 300px;"></div>
                </div>
            </div>
        </div>
        <!-- Action Board -->
        <div class="col-12 col-md-8 col-lg-9">
            <div class="row">
                <!-- Card for View Profile -->
                <div class="col-12 col-sm-6 col-md-4 mb-4">
                    <a href="profile.html">
                        <div class="card h-100">
                            <img src="img/userProfile.png" class="card-img-top p-3" alt="View Profile">
                            <div class="card-body text-center">
                                <h5 class="card-title">View Profile</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Card for Book List -->
                <div class="col-12 col-sm-6 col-md-4 mb-4">
                    <a href="book_list_user.php">
                        <div class="card h-100">
                            <img src="img/booklist.png" class="card-img-top p-3" alt="Book List">
                            <div class="card-body text-center">
                                <h5 class="card-title">Book List</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Card for Purchase History -->
                <div class="col-12 col-sm-6 col-md-4 mb-4">
                    <a href="user_pur_his.php">
                        <div class="card h-100">
                            <img src="img/history.png" class="card-img-top p-3" alt="Purchase History">
                            <div class="card-body text-center">
                                <h5 class="card-title">Purchase History</h5>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="bg-dark text-white py-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center">
                <p class="mb-0">&copy; 2024 Book Point. All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>

<!-- Scripts -->
<script src="js/bootstrap.bundle.js"></script>
<script src="js/smooth.js"></script>
<script src="js/real_time.js"></script>
<script src="js/top_sold_book.js"></script>
</body>
</html>