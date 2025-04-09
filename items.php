<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crosby Merch</title>
    <!-- Bootstrap CSS: Link to external stylesheet for responsive and styled UI elements -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS: Link to the custom stylesheet for additional styling specific to this page -->
    <link href="mystyle.css" rel="stylesheet">
</head>
<body>

    <?php
    // Starts the session or resumes an existing session
    session_start(); 

    // Checks if the 'name' session variable is set, which indicates that the user is logged in
    if (!isset($_SESSION['name']))
    {   
        // Redirects to the login page if the user is not logged in
        header("Location:login.php");
    }
    ?>

    <!-- Navbar Section -->
    <nav class="navbar navbar-expand-lg custom-navbar">
        <div class="container-fluid">
            <!-- Logo and brand name section of the navbar, links to the admin homepage -->
            <a class="navbar-brand" href="adminhomepage.php">
                <img src="Crosby-Logo.jpg" alt="Crosby"> Crosby Merch
            </a>
            <!-- Navbar toggle button for mobile responsiveness -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Navbar menu, collapses into a dropdown on smaller screens -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <!-- Links to navigate to different sections of the admin panel -->
                    <li class="nav-item"><a class="nav-link" href="items.php">Items</a></li>
                    <li class="nav-item"><a class="nav-link" href="orders.php">Orders</a></li>
                    <li class="nav-item"><a class="nav-link" href="accounts.php">Accounts</a></li>
                    <!-- Link for logging out -->
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main content area -->
    <div class="container mt-5">
        <!-- Heading for the page -->
        <h1>Items</h1><br>

        <!-- Link to view the list of items -->
        <h2><a style="text-decoration:none; color:#980930;" href="adminbrowse.php">Items list</a></h2><br>

        <!-- Link to add a new item -->
        <h2><a style="text-decoration:none; color:#980930;" href="additems.php">Add item</a></h2><br>
    </div>

</body>
</html>
