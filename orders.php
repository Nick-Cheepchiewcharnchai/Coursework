<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crosby Merch</title>
    <!-- Link to Bootstrap CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Link to the custom CSS file for additional styling -->
    <link href="mystyle.css" rel="stylesheet">
</head>
<body>

    <?php
    // Start a session to track user state
    session_start(); 
    
    // Check if the 'name' session variable is set, indicating the user is logged in
    if (!isset($_SESSION['name']))
    {   
        // If the user is not logged in, redirect to the login page
        header("Location:login.php");
    }
    ?>

    <!-- Navigation bar -->
    <nav class="navbar navbar-expand-lg custom-navbar">
        <div class="container-fluid">
            <!-- Branding for the navbar, linking to the admin homepage -->
            <a class="navbar-brand" href="adminhomepage.php">
                <!-- Display the Crosby logo next to the brand name -->
                <img src="Crosby-Logo.jpg" alt="Crosby"> Crosby Merch
            </a>
            <!-- Navbar toggle button for responsive layout (for mobile view) -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Navbar links, positioned to the right -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <!-- Menu items with links to different admin sections -->
                    <li class="nav-item"><a class="nav-link" href="items.php">Items</a></li>
                    <li class="nav-item"><a class="nav-link" href="orders.php">Orders</a></li>
                    <li class="nav-item"><a class="nav-link" href="accounts.php">Accounts</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main content area for displaying the orders page -->
    <div class="container mt-5">
        <!-- Heading for the Orders section -->
        <h1>Orders</h1><br>

        <!-- Links to different order statuses -->
        <!-- Each link points to a separate page showing orders for each status -->
        <h2><a style="text-decoration:none; color:#980930;" href="unprocessed.php">Unprocessed</a></h2><br>
        <h2><a style="text-decoration:none; color:#980930;" href="processed.php">Processed</a></h2><br>
        <h2><a style="text-decoration:none; color:#980930;" href="completed.php">Completed</a></h2><br>
    </div>

</body>
</html>