<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crosby Merch</title>
    <!-- Bootstrap CSS link for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="mystyle.css" rel="stylesheet"> <!-- Custom CSS for styling -->
</head>
<body>

    <?php include("adminloggedin.php"); ?>
    <?php include("adminnavbar.php"); ?>

    <!-- Main content area displaying completed orders -->
    <div class="container mt-5">
        <!-- Heading for the page -->
        <h1>Completed</h1>
        <!-- Row to display completed orders -->
        <div class="row" id="baskets">
            <?php
            // Include database connection file
            include_once ("connection.php");
            
            // Prepare SQL query to fetch all completed orders from tblorders and join with tblusers to get user details
            $stmt = $conn->prepare('SELECT * FROM tblorders INNER JOIN tblusers ON tblorders.UserID = tblusers.UserID WHERE Status = "Completed"');

            // Execute the query
            $stmt->execute();

            // Loop through the result set and display each completed order in a row
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo('<div class="row basket-item">');
                // Display a link for each completed order, passing BasketID, Firstname, and Lastname as query parameters
                echo('<a style="text-decoration:none; color:inherit;" href="completedetail.php?BID='.$row["BasketID"].'&FN='.$row["Firstname"].'&LN='.$row["Lastname"].'">Basket: '.$row["Firstname"].' '.$row["Lastname"].'</a>');
                echo('</div>');
            }
            ?>
        </div>
    </div>

</body>
</html>