<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Set character encoding to UTF-8, which supports a wide range of characters -->
    <meta charset="UTF-8">

    <!-- Ensure proper scaling of the page on mobile devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Title that appears on the browser tab -->
    <title>Crosby Merch</title>

    <!-- Link to Bootstrap CSS for pre-styled components and grid system -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Link to custom stylesheet for additional styles -->
    <link href="mystyle.css" rel="stylesheet">
</head>
<body>

    <?php include("adminloggedin.php"); ?>
    <?php include("adminnavbar.php"); ?>

    <!-- Main content area -->
    <div class="container mt-5">
        <?php
        // Include the database connection script
        include_once("connection.php");

        // Sanitize POST data to avoid XSS attacks
        array_map("htmlspecialchars", $_POST);

        // Prepare and execute a query to retrieve the user details based on UserID passed in the URL (AOID)
        $stmt = $conn->prepare("SELECT * FROM tblusers WHERE UserID = :UserID;");
        $userID = $_GET['AOID'];
        $stmt->bindParam(':UserID', $userID);
        $stmt->execute();

        // Display the user's name (Firstname and Lastname)
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo('<h1>' . $row["Firstname"] . ' ' . $row["Lastname"] . '</h1><br>');
        }

        // Display "Unprocessed" section
        echo("<h2>Unprocessed</h2>");

        // Prepare and execute a query to retrieve unprocessed orders for the user
        $stmt2 = $conn->prepare('SELECT * FROM tblorders INNER JOIN tblusers ON tblorders.UserID = tblusers.UserID WHERE Status = "Unprocessed" AND tblorders.UserID = :UserID');
        $stmt2->bindParam(':UserID', $userID);
        $stmt2->execute();

        // Display each unprocessed order in a link that redirects to process it
        while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)){
            echo('<div class="row" id="baskets">');
            echo('<div class="row basket-item">');
            echo('<a style="text-decoration:none; color:inherit;" href="processaccountorder.php?BID=' . $row["BasketID"] . '&FN=' . $row["Firstname"] . '&LN=' . $row["Lastname"] . '">Basket: ' . $row["Firstname"] . ' ' . $row["Lastname"] . '</a>');
            echo('</div>');
            echo('</div>');
        }

        // Display "Processed" section
        echo("<h2>Processed</h2>");

        // Prepare and execute a query to retrieve processed orders for the user
        $stmt3 = $conn->prepare('SELECT * FROM tblorders INNER JOIN tblusers ON tblorders.UserID = tblusers.UserID WHERE Status = "Processed" AND tblorders.UserID = :UserID');
        $stmt3->bindParam(':UserID', $userID);
        $stmt3->execute();

        // Display each processed order in a link that redirects to complete it
        while ($row = $stmt3->fetch(PDO::FETCH_ASSOC)){
            echo('<div class="row" id="baskets">');
            echo('<div class="row basket-item">');
            echo('<a style="text-decoration:none; color:inherit;" href="completeaccountorder.php?BID=' . $row["BasketID"] . '&FN=' . $row["Firstname"] . '&LN=' . $row["Lastname"] . '">Basket: ' . $row["Firstname"] . ' ' . $row["Lastname"] . '</a>');
            echo('</div>');
            echo('</div>');
        }

        // Display "Completed" section
        echo("<h2>Completed</h2>");

        // Prepare and execute a query to retrieve completed orders for the user
        $stmt4 = $conn->prepare('SELECT * FROM tblorders INNER JOIN tblusers ON tblorders.UserID = tblusers.UserID WHERE Status = "Completed" AND tblorders.UserID = :UserID');
        $stmt4->bindParam(':UserID', $userID);
        $stmt4->execute();

        // Display each completed order in a link that redirects to the order details page
        while ($row = $stmt4->fetch(PDO::FETCH_ASSOC)){
            echo('<div class="row" id="baskets">');
            echo('<div class="row basket-item">');
            echo('<a style="text-decoration:none; color:inherit;" href="completedetail.php?BID=' . $row["BasketID"] . '&FN=' . $row["Firstname"] . '&LN=' . $row["Lastname"] . '">Basket: ' . $row["Firstname"] . ' ' . $row["Lastname"] . '</a>');
            echo('</div>');
            echo('</div>');
        }

        ?>
    </div>

</body>
</html>