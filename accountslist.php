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
        <h1>Accounts list</h1>

        <!-- Container for displaying account details -->
        <div class="row" id="accountsContainer">
            <?php
            // Include connection script to interact with the database
            include_once("connection.php");

            // Prevent any potential XSS attacks by encoding special characters in POST data
            array_map("htmlspecialchars", $_POST);

            // Prepare SQL statement to retrieve users with Authority level 0 (non-admins)
            $stmt = $conn->prepare("SELECT * FROM tblusers WHERE Authority = 0;");
            $stmt->execute();

            // Fetch and display each user in the database
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                echo('<div class="row account-box">');
                echo('<div class="container-fluid">');
                // Link to display account details, passing the UserID as a query parameter
                echo('<a class="nav-link" href="accountdisplay.php?ADID='.$row["UserID"].'&FN='.
                $row["Firstname"].'&LN='.$row["Lastname"].'">'.$row["Firstname"].' '.$row["Lastname"].'</a>');
                echo('</div>');
                echo('</div>');
            }
            ?>
        </div>
    </div>

</body>
</html>