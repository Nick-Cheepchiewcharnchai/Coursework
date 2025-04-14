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

    <!-- Main content area to display user account details -->
    <div class="container mt-5">
        <?php 
        // Include the connection script to interact with the database
        include_once("connection.php");

        // Sanitize any POST data (for security against XSS attacks)
        array_map("htmlspecialchars", $_POST);
        
        // Prepare an SQL statement to retrieve a specific user's data using their UserID
        $stmt = $conn->prepare("SELECT * FROM tblusers WHERE UserID = :UserID;");

        // Retrieve the UserID from the query string passed via GET method
        $userID = $_GET['ADID'];
        $stmt->bindParam(':UserID', $userID); // Bind the UserID parameter to the query
        $stmt->execute(); // Execute the SQL statement

        // Fetch the user's data and display their first and last name
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo('<h1>'.$row["Firstname"].' '.$row["Lastname"].'</h1><br>');
        }
    
        // Display links for more detailed information about the user's account and their orders
        echo('<h2><a style="text-decoration:none; color:#980930;" href="accountinfo.php?AIID='.$_GET['ADID'].'">Account Info</a></h2><br>');
        echo('<h2><a style="text-decoration:none; color:#980930;" href="accountorders.php?AOID='.$_GET['ADID'].'">Orders</a></h2><br>');
        ?>
    </div>

</body>
</html>
