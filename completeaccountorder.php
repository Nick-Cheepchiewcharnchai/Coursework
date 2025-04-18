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
                echo('<div class="col" style="flex:1;"><img src="/Coursework/Coursework-1/Pictures/'.$row["Picfront"].'" class="img-fluid"></div>');

                echo('<div class="col" style="flex:6;">');
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