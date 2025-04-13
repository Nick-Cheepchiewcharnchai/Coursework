<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crosby Merch</title>
    <!-- Bootstrap CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="mystyle.css" rel="stylesheet"> <!-- Custom stylesheet -->
</head>
<body>

<?php include("adminloggedin.php"); ?>
<?php include("adminnavbar.php"); ?>

<!-- Main content area -->
<div class="container mt-5">
    <h1>Remove account</h1>  <!-- Heading for the page -->

    <div class="row" id="accountsContainer">
        <?php
        // Include the database connection
        include_once ("connection.php");

        // Sanitize POST data to prevent potential security issues (XSS attacks)
        array_map("htmlspecialchars", $_POST);

        // Prepare a SQL query to select all users with Authority = 0 (non-admins)
        $stmt = $conn->prepare("SELECT * FROM tblusers WHERE Authority = 0;");
        $stmt->execute();  // Execute the query

        // Loop through the result set and display each user's name in a link
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Each user is displayed as a link to a page for removing their account
            echo('<div class="row account-box">');
            echo('<div class="container-fluid">');
            echo('<a class="nav-link" href="removeaccountdisplay.php?RAID='.$row["UserID"].'">'.$row["Firstname"].' '.$row["Lastname"].'</a>');
            echo('</div>');
            echo('</div>');
        }
        ?>
    </div>
</div>

</body>
</html>