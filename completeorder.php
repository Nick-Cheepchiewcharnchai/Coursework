<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Setting the character encoding to UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Ensuring the page is mobile-responsive -->
    <title>Crosby Merch</title> <!-- The title of the page displayed in the browser tab -->
    
    <!-- Linking to the Bootstrap CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Linking to custom styles in mystyle.css -->
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

            // Include the database connection file
            include_once ("connection.php");
        
            // Prepare the SQL query to fetch basket items based on the BasketID
            $stmt = $conn->prepare("SELECT * FROM tblbasketitems INNER JOIN tblitems ON tblbasketitems.ItemID = tblitems.ItemID WHERE BasketID = :basketID");

            // Retrieve the BasketID from the URL parameter
            $basketID = $_GET['BID'];

            // Bind the BasketID parameter to the SQL query
            $stmt->bindParam(':basketID', $basketID);
            
            // Execute the query
            $stmt->execute();
            
            // Display the basket owner (user's name)
            echo('<h1>Basket: '.$_GET['FN'].' '.$_GET['LN'].'</h1>');

            // Loop through the results of the query
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                // Display each item in the basket
                echo('<div class="row basket-item">');

                // Display the image of the item
                echo('<div class="col" style="flex:1;"><img src="/Coursework/Coursework-1/Pictures/'.$row["Picfront"].'" class="img-fluid"></div>');

                // Display item name, cost, size, quantity, and total cost for that item
                echo('<div class="col" style="flex:6;">');
                echo('<div class="row" style="font-weight:bold; text-decoration:underline;">'.$row["Itemname"].'</div>');
                echo('<div class="row">');
                echo('<div class="col">');
                echo('<div class="row">Cost: £'.$row["Itemcost"].'</div>');
                echo('<div class="row">Size: '.$row["ItemSize"].'</div>');
                echo('</div>'); // End of item details (cost and size)

                echo('<div class="col">');
                echo('<div class="row">Quantity: '.$row["Quantity"].'</div>');
                $total = $row["Quantity"] * $row["Itemcost"];
                $_SESSION["total"] = $_SESSION["total"] + $total;
                echo('<div class="row">Total: £'.number_format((float)$total,2,".").'</div>');
                echo('</div>'); // End of quantity and total cost

                echo('<div class="col"></div>');
                echo('</div>'); // End of row
                echo('</div>'); // End of item display

                echo('<div class="col" style="flex:1;"></div>');
                echo('</div>'); // End of basket-item div
            }
            ?>
        </div>
        
        <!-- Total amount and a button to complete the order -->
        <div class="row justify-content-center">
            <div class="col-5" style="background-color: #f2f2f2; padding: 10px;">
                <?php
                    // Display the total cost for the basket
                    echo('<p><b>Total: £'.number_format((float)$_SESSION["total"],2,".").'</b></p>');
                ?>
                
                <!-- Form to submit the BasketID and complete the order -->
                <div class="container" style="text-align: center;">
                    <form action="completingorder.php" method="post">
                        <?php
                        // Hidden input to send the BasketID to the next page
                        echo('<input type="hidden" name="BasketID" value ="'.$_GET['BID'].'">');
                        ?>
                        <!-- Button to complete the order -->
                        <button type="submit" class="confirm-button">Complete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>