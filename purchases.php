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
            <a class="navbar-brand" href="homepage.php">
                <img src="Crosby-Logo.jpg" alt="Crosby"> Crosby Merch
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="homepage.php">Browse</a></li>
                    <li class="nav-item"><a class="nav-link" href="basket.php">Basket</a></li>
                    <li class="nav-item"><a class="nav-link" href="purchases.php">Purchases</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main content area -->
    <div class="container mt-5">
        <h1>Purchases</h1>
        <div class="row" id="baskets">
            <h3>Unprocessed</h3>
            <?php

            include_once ("connection.php");
            
            $stmt = $conn->prepare('SELECT * FROM tblorders WHERE UserID = :UserID AND Status = "Unprocessed"');

            $stmt->bindParam(':UserID', $_SESSION['name']);

            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                echo('<div class="row basket-item">');
                echo('<a style="text-decoration:none; color:inherit;" href="purchasebasket.php?BID='.$row["BasketID"].'">Basket '.$row["BasketID"].'</a>');
                echo('</div>');
            }

            ?>
        </div>
        <div class="row" id="baskets">
            <h3>Processed</h3>
            <?php

            include_once ("connection.php");
            
            $stmt = $conn->prepare('SELECT * FROM tblorders WHERE UserID = :UserID AND Status = "Processed"');

            $stmt->bindParam(':UserID', $_SESSION['name']);

            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                echo('<div class="row basket-item">');
                echo('<a style="text-decoration:none; color:inherit;" href="purchasebasket.php?BID='.$row["BasketID"].'">Basket '.$row["BasketID"].'</a>');
                echo('</div>');
            }

            ?>
        </div>
        <div class="row" id="baskets">
            <h3>Finished</h3>
            <?php

            include_once ("connection.php");
            
            $stmt = $conn->prepare('SELECT * FROM tblorders WHERE UserID = :UserID AND Status = "Completed"');

            $stmt->bindParam(':UserID', $_SESSION['name']);

            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                echo('<div class="row basket-item">');
                echo('<a style="text-decoration:none; color:inherit;" href="purchasebasket.php?BID='.$row["BasketID"].'">Basket '.$row["BasketID"].'</a>');
                echo('</div>');
            }

            ?>
        </div>
    </div>
</body>
</html>
