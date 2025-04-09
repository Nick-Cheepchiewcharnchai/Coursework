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

    <?php
    // Start the session to access session variables
    session_start();

    // Check if the user is logged in by verifying if a session variable is set
    if (!isset($_SESSION['name'])) {   
        // If the session variable 'name' is not set, redirect the user to the login page
        header("Location:login.php");
    }
    ?>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg custom-navbar">
        <div class="container-fluid">
            <!-- Navigation bar with a logo and links to different pages -->
            <a class="navbar-brand" href="adminhomepage.php">
                <img src="Crosby-Logo.jpg" alt="Crosby"> Crosby Merch
            </a>
            <!-- Toggle button for mobile view (for responsive design) -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Navbar links for navigation -->
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