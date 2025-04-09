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

    <div class="container mt-5">
        <?php 

            include_once ("connection.php");

            array_map("htmlspecialchars", $_POST);

            $stmt = $conn->prepare("SELECT * FROM tblusers WHERE UserID = :UserID;");

            $userID = $_GET['AOID'];
            $stmt->bindParam(':UserID', $userID);
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                echo('<h1>'.$row["Firstname"].' '.$row["Lastname"].'</h1><br>');
            }

            echo("<h2>Unprocessed</h2>");

            $stmt2 = $conn->prepare('SELECT * FROM tblorders INNER JOIN tblusers ON tblorders.UserID = tblusers.UserID WHERE Status = "Unprocessed" AND tblorders.UserID = :UserID');

            $stmt2->bindParam(':UserID', $userID);
            $stmt2->execute();

            while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)){
                echo('<div class="row" id="baskets">');
                echo('<div class="row basket-item">');
                echo('<a style="text-decoration:none; color:inherit;" href="processaccountorder.php?BID='.$row["BasketID"].'&FN='.$row["Firstname"].'&LN='.$row["Lastname"].'">Basket: '.$row["Firstname"].' '.$row["Lastname"].'</a>');
                echo('</div>');
                echo('</div>');
            }

            echo("<h2>Processed</h2>");

            $stmt3 = $conn->prepare('SELECT * FROM tblorders INNER JOIN tblusers ON tblorders.UserID = tblusers.UserID WHERE Status = "Processed" AND tblorders.UserID = :UserID');

            $stmt3->bindParam(':UserID', $userID);
            $stmt3->execute();

            while ($row = $stmt3->fetch(PDO::FETCH_ASSOC)){
                echo('<div class="row" id="baskets">');
                echo('<div class="row basket-item">');
                echo('<a style="text-decoration:none; color:inherit;" href="completeaccountorder.php?BID='.$row["BasketID"].'&FN='.$row["Firstname"].'&LN='.$row["Lastname"].'">Basket: '.$row["Firstname"].' '.$row["Lastname"].'</a>');
                echo('</div>');
                echo('</div>');
            }

            echo("<h2>Completed</h2>");

            $stmt4 = $conn->prepare('SELECT * FROM tblorders INNER JOIN tblusers ON tblorders.UserID = tblusers.UserID WHERE Status = "Completed" AND tblorders.UserID = :UserID');

            $stmt4->bindParam(':UserID', $userID);
            $stmt4->execute();

            while ($row = $stmt4->fetch(PDO::FETCH_ASSOC)){
                echo('<div class="row" id="baskets">');
                echo('<div class="row basket-item">');
                echo('<a style="text-decoration:none; color:inherit;" href="completedetail.php?BID='.$row["BasketID"].'&FN='.$row["Firstname"].'&LN='.$row["Lastname"].'">Basket: '.$row["Firstname"].' '.$row["Lastname"].'</a>');
                echo('</div>');
                echo('</div>');
            }

        ?>
    </div>

</body>
</html>