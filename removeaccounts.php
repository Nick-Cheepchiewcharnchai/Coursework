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

<?php
    // Start the session to access session variables
    session_start();

    // If the user is not logged in (session 'name' does not exist), redirect them to the login page
    if (!isset($_SESSION['name'])) {   
        header("Location:login.php");  // Redirect to the login page
    }
?>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg custom-navbar">
    <div class="container-fluid">
        <!-- Circular image before "Crosby Merch" -->
        <a class="navbar-brand" href="adminhomepage.php">
            <img src="Crosby-Logo.jpg" alt="Crosby"> Crosby Merch
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="items.php">Items</a></li>
                <li class="nav-item"><a class="nav-link" href="orders.php">Orders</a></li>
                <li class="nav-item"><a class="nav-link" href="accounts.php">Accounts</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

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