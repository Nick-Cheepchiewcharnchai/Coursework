<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crosby Merch</title>
    <!-- Bootstrap CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for additional design elements -->
    <link href="mystyle.css" rel="stylesheet">
</head>
<body>

    <?php
    // Start the session to track login status
    session_start(); 
    
    // If the user is not logged in, redirect to the login page
    if (!isset($_SESSION['name']))
    {   
        header("Location:login.php");
    }
    ?>

    <!-- Navbar: Links to different sections of the admin panel -->
    <nav class="navbar navbar-expand-lg custom-navbar">
        <div class="container-fluid">
            <!-- Branding with logo and link to admin homepage -->
            <a class="navbar-brand" href="adminhomepage.php">
                <img src="Crosby-Logo.jpg" alt="Crosby"> Crosby Merch
            </a>
            <!-- Navbar toggle button for mobile view -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Collapsible navbar items -->
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

    <!-- Main content area: displaying basket details -->
    <div class="container mt-5">

        <!-- Displaying the basket items -->
        <div class="row" id="basketContainer">
            <?php
            // Initializing total session variable
            $_SESSION["total"] = 0;

            // Include database connection
            include_once ("connection.php");

            // Prepare SQL query to fetch basket items and their associated product details
            $stmt = $conn->prepare("SELECT * FROM tblbasketitems INNER JOIN tblitems ON tblbasketitems.ItemID = tblitems.ItemID WHERE BasketID = :basketID");

            // Get the basket ID from the URL parameters
            $basketID = $_GET['BID'];
            $stmt->bindParam(':basketID', $basketID);
            $stmt->execute();
            
            // Display the user's full name (passed via URL parameters)
            echo('<h1>Basket: '.$_GET['FN'].' '.$_GET['LN'].'</h1>');

            // Loop through each basket item and display its details
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                echo('<div class="row basket-item">');

                // Item image
                echo('<div class="col" style="flex:1;"><img src="/Coursework/Coursework-1/Pictures/'.$row["Picfront"].'" class="img-fluid"></div>');

                // Item name, size, quantity, cost, and total
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

                echo('<div class="col" style="flex:1;"></div>');
                echo('</div>');
            }

            ?>
        </div>
        
        <!-- Total amount and Process button -->
        <div class="row justify-content-center">
            <div class="col-5" style="background-color: #f2f2f2; padding: 10px;">
                <?php
                    // Display the total amount
                    echo('<p><b>Total: £'.number_format((float)$_SESSION["total"],2,".").'</b></p>');
                ?>
                <div class="container" style="text-align: center;">
                    <!-- Form to submit the basket ID and process the order -->
                    <form action="processingorder.php" method="post">
                        <?php
                        // Include hidden field to pass the BasketID to the processing page
                        echo('<input type="hidden" name="BasketID" value ="'.$_GET['BID'].'">');
                        ?>
                        <!-- Submit button to confirm and process the order -->
                        <button type="submit" class="confirm-button">Process</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>