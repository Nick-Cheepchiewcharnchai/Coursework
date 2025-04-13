<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crosby Merch</title>
    <!-- Bootstrap CSS for responsive and styled elements -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="mystyle.css" rel="stylesheet"> <!-- Custom styles from mystyle.css -->
</head>
<body>

    <?php include("adminloggedin.php"); ?>
    <?php include("adminnavbar.php"); ?>

    <!-- Main content area -->
    <div class="container mt-5">
        <h1>Processed</h1> <!-- Page heading -->

        <!-- Row to hold all the processed orders -->
        <div class="row" id="baskets">
            <?php
            // Include the database connection file
            include_once ("connection.php");
            
            // Prepare the SQL query to fetch orders with the 'Processed' status from the tblorders table
            $stmt = $conn->prepare('SELECT * FROM tblorders INNER JOIN tblusers ON tblorders.UserID = tblusers.UserID WHERE Status = "Processed"');

            // Execute the prepared statement
            $stmt->execute();

            // Loop through the results and display each processed order
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Create a row for each order with a link to the completeorder.php page, passing BasketID and user details as parameters
                echo('<div class="row basket-item">');
                echo('<a style="text-decoration:none; color:inherit;" href="completeorder.php?BID='.$row["BasketID"].'&FN='.$row["Firstname"].'&LN='.$row["Lastname"].'">Basket: '.$row["Firstname"].' '.$row["Lastname"].'</a>');
                echo('</div>');
            }
            ?>
        </div>
    </div>

</body>
</html>
