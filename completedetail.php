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
