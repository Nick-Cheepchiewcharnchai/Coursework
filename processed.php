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

    <!-- Main content area displaying unprocessed orders -->
    <div class="container mt-5">
        <!-- Title for the page -->
        <h1>Processed</h1>
        <div class="row" id="baskets">
            <?php
            // Include the database connection
            include_once("connection.php");
            
            // Prepare the SQL query to select processed orders and join them with user details
            $stmt = $conn->prepare('SELECT * FROM tblorders INNER JOIN tblusers ON tblorders.UserID = tblusers.UserID WHERE Status = "Processed"');
            
            // Execute the query
            $stmt->execute();
            
            // Fetch each row and display the order information
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                echo('<div class="row basket-item">');
                // Create a clickable link for each order, passing parameters to `completeorder.php` for further processing
                echo('<a style="text-decoration:none; color:inherit;" href="completeorder.php?BID='.$row["BasketID"].'&FN='.$row["Firstname"].'&LN='.$row["Lastname"].'">Basket: '.$row["Firstname"].' '.$row["Lastname"].'</a>');
                echo('</div>');
            }
            ?>
        </div>
    </div>

</body>
</html>