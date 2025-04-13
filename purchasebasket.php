<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crosby Merch</title>
    <!-- Bootstrap CSS for styling and responsiveness -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="mystyle.css" rel="stylesheet"> <!-- Custom CSS for additional styling -->
</head>
<body>

    <?php include("customerloggedin.php"); ?>
    <?php include("navbar.php"); ?>

    <!-- Main content area -->
    <div class="container mt-5">
        <h1>Basket</h1>

        <!-- Basket items container -->
        <div class="row" id="basketContainer">
        <?php
        // Include the database connection
        include_once ("connection.php");

        // Prepare a SQL query to fetch basket items and their details (joined with tblitems)
        $stmt = $conn->prepare("SELECT * FROM tblbasketitems INNER JOIN tblitems ON tblbasketitems.ItemID = tblitems.ItemID  WHERE BasketID = :basketID");

        // Retrieve the BasketID from the URL query string
        $basketID = $_GET['BID'];

        // Bind the BasketID parameter to the SQL query
        $stmt->bindParam(':basketID', $basketID);

        // Execute the query
        $stmt->execute();

        // Loop through the fetched rows and display the basket items
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Store the BasketID in session, although this might be redundant (questioned later)
            $_SESSION["basket"] = $row["BasketID"];

            // Start displaying each basket item
            echo('<div class="row basket-item">');

            // Display the product image, dynamically fetching the image from the server
            echo('<div class="col" style="flex:1;"><img src="/Coursework/Coursework-1/Pictures/'.$row["Picfront"].'" class="img-fluid"></div>');

            // Start the column displaying product information
            echo('<div class="col" style="flex:6;">');

            // Display the product name in bold and underlined
            echo('<div class="row" style="font-weight:bold; text-decoration:underline;">'.$row["Itemname"].'</div>');

            // Start another row for cost, size, and quantity information
            echo('<div class="row">');

            // Display cost and size
            echo('<div class="col">');
            echo('<div class="row">Cost: £'.$row["Itemcost"].'</div>');
            echo('<div class="row">Size: '.$row["ItemSize"].'</div>');
            echo('</div>');

            // Display quantity and calculate the total cost for the item (quantity * cost)
            echo('<div class="col">');
            echo('<div class="row">Quantity: '.$row["Quantity"].'</div>');
            $total = $row["Quantity"] * $row["Itemcost"];
            $_SESSION["total"] = $_SESSION["total"] + $total; // Accumulate the total cost in session
            echo('<div class="row">Total: £'.number_format((float)$total,2,".").'</div>');
            echo('</div>');

            // Empty column for layout purposes
            echo('<div class="col"></div>');
            
            // End the row for product information
            echo('</div>');

            // End the column for product details
            echo('</div>');

            // End the empty column for layout purposes
            echo('<div class="col" style="flex:1;"></div>');

            // End the row for the current basket item
            echo('</div>');
        }
        ?>
        </div>
    </div>

</body>
</html>
