<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Character encoding for the document, ensuring support for most characters -->
    <meta charset="UTF-8">
    
    <!-- Viewport meta tag to ensure the page is responsive on different devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Page title that will appear in the browser tab -->
    <title>Crosby Merch</title>

    <!-- Link to Bootstrap CSS for pre-styled components like grid system, buttons, etc. -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Link to a custom stylesheet (mystyle.css) for additional styling -->
    <link href="mystyle.css" rel="stylesheet">
</head>
<body>

    <?php
    // Start the session to check whether the user is logged in or not
    session_start();

    // If the 'name' session variable is not set (i.e., the user is not logged in), redirect them to the login page
    if (!isset($_SESSION['name'])) {
        header("Location:login.php");
    }
    ?>

    <!-- Navigation bar -->
    <nav class="navbar navbar-expand-lg custom-navbar">
        <div class="container-fluid">
            <!-- Navbar brand (Logo and site name) -->
            <a class="navbar-brand" href="adminhomepage.php">
                <img src="Crosby-Logo.jpg" alt="Crosby"> Crosby Merch
            </a>
            
            <!-- Navbar toggle button for responsive design (on smaller screens) -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Navbar items (links to various sections) -->
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

    <!-- Main content section -->
    <div class="container mt-5">

        <!-- Section displaying the basket items -->
        <div class="row" id="basketContainer">
            <?php
            // Initialize a session variable for total cost calculation
            $_SESSION["total"] = 0;

            // Include database connection
            include_once("connection.php");

            // Prepare a SQL query to get all items in the basket, using the BasketID passed as a GET parameter
            $stmt = $conn->prepare("SELECT * FROM tblbasketitems INNER JOIN tblitems ON tblbasketitems.ItemID = tblitems.ItemID WHERE BasketID = :basketID");
            
            // Bind the basket ID from the URL to the prepared statement
            $basketID = $_GET['BID'];
            $stmt->bindParam(':basketID', $basketID);
            $stmt->execute();

            // Display the basket owner's name (First Name and Last Name)
            echo('<h1>Basket: '.$_GET['FN'].' '.$_GET['LN'].'</h1>');

            // Loop through all items in the basket and display each one
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo('<div class="row basket-item">');
                echo('<div class="col" style="flex:1;"><img src="/Coursework/Coursework-1/Pictures/'.$row["Picfront"].'" class="img-fluid"></div>');
                
                echo('<div class="col" style="flex:6;">');
                echo('<div class="row" style="font-weight:bold; text-decoration:underline;">'.$row["Itemname"].'</div>');

                // Display item details (cost, size, quantity) for each item in the basket
                echo('<div class="row">');
                echo('<div class="col">');
                echo('<div class="row">Cost: £'.$row["Itemcost"].'</div>');
                echo('<div class="row">Size: '.$row["ItemSize"].'</div>');
                echo('</div>');

                // Display the quantity of each item and calculate the total cost for each item
                echo('<div class="col">');
                echo('<div class="row">Quantity: '.$row["Quantity"].'</div>');
                $total = $row["Quantity"] * $row["Itemcost"]; // Calculate total for this item
                $_SESSION["total"] = $_SESSION["total"] + $total; // Add to the session total
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

        <!-- Section displaying the total cost and the "Process" button -->
        <div class="row justify-content-center">
            <div class="col-5" style="background-color: #f2f2f2; padding: 10px;">
                <!-- Display the total cost of all items in the basket -->
                <?php
                    echo('<p><b>Total: £'.number_format((float)$_SESSION["total"],2,".").'</b></p>');
                ?>

                <!-- Form to submit the basket for processing -->
                <div class="container" style="text-align: center;">
                    <form action="processingaccountorder.php" method="post">
                        <!-- Hidden input to pass the BasketID to the processing script -->
                        <?php
                        echo('<input type="hidden" name="BasketID" value ="'.$_GET['BID'].'">');
                        ?>
                        <!-- Button to submit the form and process the order -->
                        <button type="submit" class="confirm-button">Process</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>