<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crosby Merch</title>
    <!-- Bootstrap CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for additional design elements -->
    <link href="mystyle.css" rel="stylesheet">
</head>
<body>

    <?php
    // Start the session to manage user authentication
    session_start(); 
    
    // Check if the user is logged in; if not, redirect to the login page
    if (!isset($_SESSION['name']))
    {   
        header("Location:login.php");
    }
    ?>

    <!-- Navbar: Links to different sections of the admin panel -->
    <nav class="navbar navbar-expand-lg custom-navbar">
        <div class="container-fluid">
            <!-- Branding with logo and link to admin homepage -->
            <a class="navbar-brand" href="adminhomepage.php">
                <img src="Crosby-Logo.jpg" alt="Crosby"> Crosby Merch
            </a>
            <!-- Navbar toggle button for mobile view -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Collapsible navbar items -->
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

    <!-- Main content area displaying unprocessed orders -->
    <div class="container mt-5">
        <!-- Title for the page -->
        <h1>Unprocessed</h1>
        <div class="row" id="baskets">
            <?php
            // Include the database connection
            include_once("connection.php");
            
            // Prepare the SQL query to select unprocessed orders and join them with user details
            $stmt = $conn->prepare('SELECT * FROM tblorders INNER JOIN tblusers ON tblorders.UserID = tblusers.UserID WHERE Status = "Unprocessed"');
            
            // Execute the query
            $stmt->execute();
            
            // Fetch each row and display the order information
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                echo('<div class="row basket-item">');
                // Create a clickable link for each order, passing parameters to `processorder.php` for further processing
                echo('<a style="text-decoration:none; color:inherit;" href="processorder.php?BID='.$row["BasketID"].'&FN='.$row["Firstname"].'&LN='.$row["Lastname"].'">Basket: '.$row["Firstname"].' '.$row["Lastname"].'</a>');
                echo('</div>');
            }
            ?>
        </div>
    </div>

</body>
</html>