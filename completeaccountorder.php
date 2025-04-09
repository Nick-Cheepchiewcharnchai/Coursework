<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags for character set and viewport settings -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crosby Merch</title>

    <!-- Bootstrap CSS for responsive design and UI components -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS for additional styling -->
    <link href="mystyle.css" rel="stylesheet">
</head>
<body>

    <?php
    // Start a session to manage login status and other session data
    session_start(); 

    // If the session 'name' is not set (i.e., the user is not logged in), redirect to login page
    if (!isset($_SESSION['name'])) {   
        header("Location:login.php");
    }
    ?>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg custom-navbar">
        <div class="container-fluid">
            <!-- Logo and Brand Name -->
            <a class="navbar-brand" href="adminhomepage.php">
                <img src="Crosby-Logo.jpg" alt="Crosby"> Crosby Merch
            </a>
            <!-- Navbar Toggle Button for mobile responsiveness -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Navigation links -->
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="items.php">Items</a></li>
                    <li class="nav-item"><a class="nav-link" href="orders.php">Orders</a></li>
                    <li class="nav-item"><a class="nav-link" href="accounts.php">Accounts</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content Area -->
    <div class="container mt-5">

        <div class="row" id="basketContainer">
            <?php
            // Initialize the total session variable to 0
            $_SESSION["total"] = 0;

            // Include the connection file to connect to the database
            include_once ("connection.php");

            // Prepare the SQL query to fetch all items in the basket associated with the BasketID
            $stmt = $conn->prepare("SELECT * FROM tblbasketitems INNER JOIN tblitems ON tblbasketitems.ItemID = tblitems.ItemID WHERE BasketID = :basketID");

            // Get the BasketID from the URL parameter and bind it to the SQL query
            $basketID = $_GET['BID'];
            $stmt->bindParam(':basketID', $basketID);
            $stmt->execute();
            
            // Display the basket owner's name (passed through URL as 'FN' and 'LN')
            echo('<h1>Basket: '.$_GET['FN'].' '.$_GET['LN'].'</h1>');

            // Loop through the basket items and display each item's details
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                // Each item displayed within a row container
                echo('<div class="row basket-item">');

                // Display the item's image (with a flexible width)
                echo('<div class="col" style="flex:1;"><img src="/Coursework/Coursework-1/Pictures/'.$row["Picfront"].'" class="img-fluid"></div>');

                echo('<div class="col" style="flex:6;">');

                // Display the item name with bold and underlined style
                echo('<div class="row" style="font-weight:bold; text-decoration:underline;">'.$row["Itemname"].'</div>');

                echo('<div class="row">');

                // Display the cost and size of the item
                echo('<div class="col">');
                echo('<div class="row">Cost: £'.$row["Itemcost"].'</div>');
                echo('<div class="row">Size: '.$row["ItemSize"].'</div>');
                echo('</div>');

                // Display the quantity of the item and its total cost
                echo('<div class="col">');
                echo('<div class="row">Quantity: '.$row["Quantity"].'</div>');
                $total = $row["Quantity"] * $row["Itemcost"];
                $_SESSION["total"] = $_SESSION["total"] + $total;
                echo('<div class="row">Total: £'.number_format((float)$total, 2, ".", "").'</div>');
                echo('</div>');

                echo('<div class="col"></div>');
                
                echo('</div>');

                echo('</div>');

                // Empty column to maintain layout structure
                echo('<div class="col" style="flex:1;"></div>');

                echo('</div>');
            }

            ?>
        </div>
        
        <!-- Section to display the total cost and the button to complete the order -->
        <div class="row justify-content-center">
            <div class="col-5" style="background-color: #f2f2f2; padding: 10px;">
                <?php
                    // Display the total price of all items in the basket
                    echo('<p><b>Total: £'.number_format((float)$_SESSION["total"],2,".").'</b></p>');
                ?>
                <!-- Button to confirm and complete the order -->
                <div class="container" style="text-align: center;">
                    <form action="completingaccountorder.php" method="post">
                        <?php
                        // Pass the BasketID as a hidden input field to the processing script
                        echo('<input type="hidden" name="BasketID" value ="'.$_GET['BID'].'">');
                        ?>
                        <!-- Submit button to complete the order -->
                        <button type="submit" class="confirm-button">Complete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>