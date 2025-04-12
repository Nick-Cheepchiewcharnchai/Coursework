<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crosby Merch</title>
    <!-- Link to Bootstrap CSS for responsive design and styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="mystyle.css" rel="stylesheet"> <!-- Link to custom CSS for additional styling -->
</head>
<body>

    <?php
    // Start the session to access session variables (e.g., user login status)
    session_start(); 

    // Check if the 'name' session variable is set, indicating that the user is logged in
    if (!isset($_SESSION['name'])) {   
        // If the user is not logged in, redirect them to the login page
        header("Location:login.php");
    }
    ?>

    <!-- Navbar section -->
    <nav class="navbar navbar-expand-lg custom-navbar">
        <div class="container-fluid">
            <!-- Logo and link to the admin homepage -->
            <a class="navbar-brand" href="adminhomepage.php">
                <img src="Crosby-Logo.jpg" alt="Crosby"> Crosby Merch
            </a>
            <!-- Button to toggle the navigation bar on smaller screens -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Navbar items (links to different pages) -->
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
        <!-- Heading for the current page -->
        <h1>Accounts</h1><br>

        <!-- Link to the accounts list page -->
        <h2><a style="text-decoration:none; color:#980930;" href="accountslist.php">Accounts list</a></h2><br>

        <!-- Link to the add users page -->
        <h2><a style="text-decoration:none; color:#980930;" href="addaccounts.php">Add account</a></h2><br>

        <!-- Link to the remove users page -->
        <h2><a style="text-decoration:none; color:#980930;" href="removeaccounts.php">Remove account</a></h2><br>
    </div>

</body>
</html>