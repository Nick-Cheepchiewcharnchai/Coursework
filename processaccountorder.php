<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crosby Merch</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="mystyle.css" rel="stylesheet">
</head>
<body>

    <?php include("adminloggedin.php"); ?>
    <?php include("adminnavbar.php"); ?>

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