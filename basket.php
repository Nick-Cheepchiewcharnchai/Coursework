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
        <h1>Basket</h1>

        <div class="row" id="basketContainer">
            <?php
            $_SESSION["total"] = 0;

            include_once ("connection.php");
            
            $stmt = $conn->prepare("SELECT * FROM tblbasketitems INNER JOIN tblitems ON tblbasketitems.ItemID = tblitems.ItemID INNER JOIN tblbasket ON tblbasketitems.BasketID = tblbasket.BasketID WHERE UserID = :UserID and IsOrdered = 0");

            $stmt->bindParam(':UserID', $_SESSION['name']);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $_SESSION["basket"] = $row["BasketID"];
                echo('<div class="row basket-item">');

                echo('<div class="col" style="flex:1;"><img src="/Coursework/Coursework-1/Pictures/'.$row["Picfront"].'" class="img-fluid"></div>');

                echo('<div class="col" style="flex:6;">');

                echo('<div class="row" style="font-weight:bold; text-decoration:underline;">'.$row["Itemname"].'</div>');

                echo('<div class="row">');

                echo('<div class="col">');
                echo('<div class="row">Cost: £'.$row["Itemcost"].'</div>');
                echo('<div class="row">Size: '.$row["ItemSize"].'</div>');
                echo('</div>');

                echo('<div class="col">');
                echo('<div class="row">Quantity: '.$row["Quantity"].'</div>');
                $total = $row["Quantity"] * $row["Itemcost"];
                $_SESSION["total"] = $_SESSION["total"] + $total;
                echo('<div class="row">Total: £'.number_format((float)$total,2,".").'</div>');
                echo('</div>');

                echo('<div class="col"></div>');
                
                echo('</div>');

                echo('</div>');

                echo('<div class="col" style="flex:1;">X BUTTON</div>');

                echo('</div>');
            }

            ?>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-5" style="background-color: #f2f2f2; padding: 10px;">
                <?php
                    echo('<p><b>Total: £'.$_SESSION["total"].'</b></p>');
                ?>
                <div class="container" style="text-align: center;"><!--decorate confirm button class-->
                    <form action="confirmpurchase.php" method="post">
                        <button type="submit" class="confirm-button">Confirm Purchase</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
