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

        echo("<h2>Unprocessed</h2>");

        $stmt2 = $conn->prepare('SELECT * FROM tblorders INNER JOIN tblusers ON tblorders.UserID = tblusers.UserID WHERE Status = "Unprocessed" AND tblorders.UserID = :UserID');
        $stmt2->bindParam(':UserID', $userID);
        $stmt2->execute();

        while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)){
            echo('<div class="row" id="baskets">');
            echo('<div class="row basket-item">');
            echo('<a style="text-decoration:none; color:inherit;" href="processaccountorder.php?BID=' . $row["BasketID"] . '&FN=' 
            . $row["Firstname"] . '&LN=' . $row["Lastname"] . '">Basket ' . $row["BasketID"] . '</a>');
            echo('</div>');
            echo('</div>');
        }

        echo("<h2>Processed</h2>");

        $stmt3 = $conn->prepare('SELECT * FROM tblorders INNER JOIN tblusers ON tblorders.UserID = tblusers.UserID WHERE Status = "Processed" AND tblorders.UserID = :UserID');
        $stmt3->bindParam(':UserID', $userID);
        $stmt3->execute();

        while ($row = $stmt3->fetch(PDO::FETCH_ASSOC)){
            echo('<div class="row" id="baskets">');
            echo('<div class="row basket-item">');
            echo('<a style="text-decoration:none; color:inherit;" href="completeaccountorder.php?BID=' . $row["BasketID"] . '&FN=' 
        . $row["Firstname"] . '&LN=' . $row["Lastname"] . '">Basket ' . $row["BasketID"] . '</a>');
            echo('</div>');
            echo('</div>');
        }

        echo("<h2>Completed</h2>");

        $stmt4 = $conn->prepare('SELECT * FROM tblorders INNER JOIN tblusers ON tblorders.UserID = tblusers.UserID WHERE Status = "Completed" AND tblorders.UserID = :UserID');
        $stmt4->bindParam(':UserID', $userID);
        $stmt4->execute();

        while ($row = $stmt4->fetch(PDO::FETCH_ASSOC)){
            echo('<div class="row" id="baskets">');
            echo('<div class="row basket-item">');
            echo('<a style="text-decoration:none; color:inherit;" href="completedetail.php?BID=' . $row["BasketID"] . '&FN=' 
        . $row["Firstname"] . '&LN=' . $row["Lastname"] . '">Basket ' . $row["BasketID"] . '</a>');
            echo('</div>');
            echo('</div>');
        }

        ?>
    </div>

</body>
</html>