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

<?php
    // Start a new session or resume an existing session
    session_start(); 

    // If the session variable 'name' is not set, redirect to login page
    if (!isset($_SESSION['name'])) {   
        header("Location:login.php");
    }
?>

    <!-- Navbar for site navigation -->
    <nav class="navbar navbar-expand-lg custom-navbar">
        <div class="container-fluid">
            <!-- The website's logo and name in the navbar -->
            <a class="navbar-brand" href="adminhomepage.php">
                <img src="Crosby-Logo.jpg" alt="Crosby"> Crosby Merch
            </a>
            <!-- Toggler for mobile navigation -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Collapsible menu items for larger screens -->
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