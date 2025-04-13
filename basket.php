<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crosby Merch</title>
    <!-- Link to the Bootstrap CSS file for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Link to a custom stylesheet -->
    <link href="mystyle.css" rel="stylesheet">
</head>
<body>

    <?php include("customerloggedin.php"); ?>
    <?php include("navbar.php"); ?>

    <!-- Main content area -->
    <div class="container mt-5">
        <!-- Page title -->
        <h1>Basket</h1>

        <div class="row" id="basketContainer">
            <?php
            // Initialize the total price for the basket
            $_SESSION["total"] = 0;

            // Include the database connection file
            include_once ("connection.php");
            
            // Query to fetch basket items, joining related tables to get item details
            $stmt = $conn->prepare("SELECT * FROM tblbasketitems INNER JOIN tblitems ON tblbasketitems.ItemID = tblitems.ItemID INNER JOIN tblbaskets ON tblbasketitems.BasketID = tblbaskets.BasketID WHERE UserID = :UserID AND IsOrdered = 0");

            // Bind the user ID to the query parameter
            $stmt->bindParam(':UserID', $_SESSION['name']);
            // Execute the query
            $stmt->execute();

            // Loop through the basket items and display them
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                // Store the current basket ID in the session
                $_SESSION["basket"] = $row["BasketID"];
                // Begin the HTML structure for displaying each item
                echo('<div class="row basket-item">');

                // Display the item's front image
                echo('<div class="col" style="flex:1;"><img src="/Coursework/Coursework-1/Pictures/'.$row["Picfront"].'" class="img-fluid"></div>');

                // Item details like name, cost, size, and quantity
                echo('<div class="col" style="flex:6;">');

                // Display item name with bold and underlined style
                echo('<div class="row" style="font-weight:bold; text-decoration:underline;">'.$row["Itemname"].'</div>');

                // Display item cost and size
                echo('<div class="row">');
                echo('<div class="col">');
                echo('<div class="row">Cost: £'.$row["Itemcost"].'</div>');
                echo('<div class="row">Size: '.$row["ItemSize"].'</div>');
                echo('</div>');

                // Display quantity and calculate total price for this item
                echo('<div class="col">');
                echo('<div class="row">Quantity: '.$row["Quantity"].'</div>');
                $total = $row["Quantity"] * $row["Itemcost"];
                // Add the calculated total to the session's overall total
                $_SESSION["total"] = $_SESSION["total"] + $total;
                // Display the total price for this item
                echo('<div class="row">Total: £'.number_format((float)$total,2,".").'</div>');
                echo('</div>');

                // Empty column for layout
                echo('<div class="col"></div>');
                
                echo('</div>');

                echo('</div>');

                // Empty column for layout
                echo('<div class="col" style="flex:1;"></div>');

                echo('</div>');
            }
            ?>
        </div>
        
        <!-- Section to display the total price and confirm the purchase -->
        <div class="row justify-content-center">
            <div class="col-5" style="background-color: #f2f2f2; padding: 10px;">
                <!-- Display the total price of the items in the basket -->
                <?php
                    echo('<p><b>Total: £'.$_SESSION["total"].'</b></p>');
                ?>
                <!-- Button to confirm the purchase -->
                <div class="container" style="text-align: center;">
                    <form action="confirmpurchase.php" method="post">
                        <!-- Button to submit the form for confirming the purchase -->
                        <button type="submit" class="confirm-button">Confirm Purchase</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
