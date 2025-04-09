<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crosby Merch</title>
    <!-- Link to the Bootstrap CSS for styling and making the page responsive -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Link to a custom CSS file for additional styling -->
    <link href="mystyle.css" rel="stylesheet">
</head>
<body>

    <?php
    // Starts a new session or resumes the existing session
    session_start(); 

    // Checks if the 'name' session variable is set (indicating that the user is logged in)
    if (!isset($_SESSION['name']))
    {   
        // If not logged in, redirects the user to the login page
        header("Location:login.php");
    }
    ?>

    <!-- Navbar Section -->
    <nav class="navbar navbar-expand-lg custom-navbar">
        <div class="container-fluid">
            <!-- Navbar brand with a logo and text -->
            <a class="navbar-brand" href="adminhomepage.php">
                <img src="Crosby-Logo.jpg" alt="Crosby"> Crosby Merch
            </a>
            <!-- Navbar toggle button for smaller screens (for mobile view) -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Navbar menu items -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <!-- Navigation links for different pages -->
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
        <!-- Links to navigate to different sections of the admin panel -->
        <h1><a style="text-decoration:none; color:inherit;" href="items.php">Items</a></h1><br>
        <h1><a style="text-decoration:none; color:inherit;" href="orders.php">Orders</a></h1><br>
        <h1><a style="text-decoration:none; color:inherit;" href="accounts.php">Accounts</a></h1><br>
    </div>

</body>
</html>
