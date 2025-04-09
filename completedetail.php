<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crosby Merch</title>
    <!-- Link to Bootstrap CSS for responsive design and styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="mystyle.css" rel="stylesheet"> <!-- Custom CSS for styling -->
</head>
<body>

    <?php
    // Start the session to access session variables
    session_start();

    // Check if the user is logged in by verifying the 'name' session variable
    if (!isset($_SESSION['name'])) {   
        // If the user is not logged in, redirect them to the login page
        header("Location:login.php");
    }
    ?>

    <!-- Navbar section -->
    <nav class="navbar navbar-expand-lg custom-navbar">
        <div class="container-fluid">
            <!-- Logo and link to the admin homepage -->
            <a class="navbar-brand" href="adminhomepage.php">
                <img src="Crosby-Logo.jpg" alt="Crosby"> Crosby Merch
            </a>
            <!-- Button for collapsing the navbar on mobile devices -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Navbar links -->
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

        <div class="row" id="basketContainer">
            <?php
            // Initialize the total cost for the basket
            $_SESSION["total"] = 0;

            // Include database connection
            include_once ("connection.php");
        
            // Prepare SQL query to fetch items from the basket based on the BasketID
            $stmt = $conn->prepare("SELECT * FROM tblbasketitems INNER JOIN tblitems ON tblbasketitems.ItemID = tblitems.ItemID WHERE BasketID = :basketID");

            // Retrieve the BasketID from the URL query parameter
            $basketID = $_GET['BID'];
            // Bind the BasketID parameter to the prepared statement
            $stmt->bindParam(':basketID', $basketID);
            // Execute the query
            $stmt->execute();
            
            // Display the basket owner's name (First and Last name)
            echo('<h1>Basket: '.$_GET['FN'].' '.$_GET['LN'].'</h1>');

            // Loop through the fetched basket items and display each item in the basket
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo('<div class="row basket-item">');

                // Display item image
                echo('<div class="col" style="flex:1;"><img src="/Coursework/Coursework-1/Pictures/'.$row["Picfront"].'" class="img-fluid"></div>');

                // Display item name, cost, size, quantity, and total for the item
                echo('<div class="col" style="flex:6;">');
                echo('<div class="row" style="font-weight:bold; text-decoration:underline;">'.$row["Itemname"].'</div>');
                echo('<div class="row">');

                // Display the cost and size of the item
                echo('<div class="col">');
                echo('<div class="row">Cost: £'.$row["Itemcost"].'</div>');
                echo('<div class="row">Size: '.$row["ItemSize"].'</div>');
                echo('</div>');

                // Display the quantity and calculate the total cost for that item
                echo('<div class="col">');
                echo('<div class="row">Quantity: '.$row["Quantity"].'</div>');
                $total = $row["Quantity"] * $row["Itemcost"];
                // Accumulate the total cost of all items in the basket
                $_SESSION["total"] = $_SESSION["total"] + $total;
                echo('<div class="row">Total: £'.number_format((float)$total,2,".").'</div>');
                echo('</div>');

                echo('<div class="col"></div>');
                echo('</div>');  // End of the item row
                echo('</div>');  // End of the item details

                echo('<div class="col" style="flex:1;"></div>');  // Empty column for spacing 

                echo('</div>');  // End of the basket-item row 
            }

            ?>
        </div>
        
        <!-- Total amount display at the bottom -->
        <div class="row justify-content-center">
            <div class="col-5" style="background-color: #f2f2f2; padding: 10px;">
                <?php
                    // Display the total cost of all items in the basket
                    echo('<p><b>Total: £'.number_format((float)$_SESSION["total"],2,".").'</b></p>');
                ?>
            </div>
        </div>
    </div>

</body>
</html>
