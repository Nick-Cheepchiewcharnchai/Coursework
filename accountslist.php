<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Character encoding set to UTF-8 -->
    <meta charset="UTF-8">
    <!-- Ensures the page is responsive on all devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title of the page that appears on the browser tab -->
    <title>Crosby Merch</title>

    <!-- Link to the Bootstrap 5 CSS file for responsive layout and pre-built components -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Link to custom stylesheet (mystyle.css) for additional custom styling -->
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
                echo('<a class="nav-link" href="accountdisplay.php?ADID='.$row["UserID"].'">'.$row["Firstname"].' '.$row["Lastname"].'</a>');
                echo('</div>');
                echo('</div>');
            }
            ?>
        </div>
    </div>

</body>
</html>