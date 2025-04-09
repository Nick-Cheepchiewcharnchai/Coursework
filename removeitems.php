<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crosby Merch</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="mystyle.css" rel="stylesheet">
</head>
<body>

    <?php
    session_start(); 
    if (!isset($_SESSION['name']))
    {   
        header("Location:login.php");
    }
    ?>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg custom-navbar">
        <div class="container-fluid">
            <!-- Circular image before "Crosby Merch" -->
            <a class="navbar-brand" href="adminhomepage.php">
                <img src="Crosby-Logo.jpg" alt="Crosby"> Crosby Merch
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="items.php">Items</a></li>
                    <li class="nav-item"><a class="nav-link" href="orders.php">Orders</a></li>
                    <li class="nav-item"><a class="nav-link" href="accounts.php">Accounts</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main content area -->
    <div class="container mt-5">
        <h1>Remove item</h1>
        <p>Total no. of items: <span id="totalItems"></span></p>

        <!-- Search, Category Filter, Sort -->
        <div class="row mb-4">
            <div class="col-md-6"></div>
            <div class="col-md-3">
                <select class="form-select" id="categoryFilter">
                    <option value="">All</option>
                    <option value="">Shirts</option>
                    <option value="">Trousers</option>
                    <option value="">Accesories</option>
                    <option value="">Others</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select" id="sortBy">
                    <option value="price">Newest</option>
                    <option value="price">Oldest</option>
                    <option value="price">Cost (High to Low)</option>
                    <option value="price">Cost (Low to High)</option>
                </select>
            </div>
        </div>

        <!-- Item Grid -->
        <div class="row" id="itemContainer">
            <?php

            include_once ("connection.php");
            
            $stmt = $conn->prepare("SELECT * FROM tblitems");
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                echo('<div class="col-lg-3">');
                echo('<a style="text-decoration:none; color:inherit;" href="removingitem.php?RIID='.$row["ItemID"].'">');
                echo('<div><img src="/Coursework/Coursework-1/Pictures/'.$row["Picfront"].'" width="200" height="200"></div>');
                echo('<div><b>'.$row["Itemname"].'</b></div>');
                echo('<div>£'.$row["Itemcost"].'</div>');
                echo('</a>');
                echo('</div>');
            }

            ?>
        </div>
    </div>

</body>
</html>