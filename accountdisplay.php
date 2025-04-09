<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Character encoding set to UTF-8 to ensure the proper display of characters -->
    <meta charset="UTF-8">
    <!-- Viewport setting for responsiveness, ensuring proper scaling on different screen sizes -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title displayed on the browser tab -->
    <title>Crosby Merch</title>

    <!-- Linking to Bootstrap 5 CSS for responsive design and pre-built UI components -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Link to a custom CSS file for additional styling -->
    <link href="mystyle.css" rel="stylesheet">
</head>
<body>

    <?php
    // Start the session to access session variables
    session_start(); 
    
    // Check if the session variable 'name' is set. If not, redirect the user to the login page
    if (!isset($_SESSION['name'])) {   
        header("Location:login.php");
    }
    ?>

    <!-- Navbar with links to different sections of the admin panel -->
    <nav class="navbar navbar-expand-lg custom-navbar">
        <div class="container-fluid">
            <!-- Crosby Merch logo and name in the navbar -->
            <a class="navbar-brand" href="adminhomepage.php">
                <img src="Crosby-Logo.jpg" alt="Crosby"> Crosby Merch
            </a>
            <!-- Navbar toggler for mobile responsiveness -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Collapsible navbar items for larger screens -->
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

    <!-- Main content area to display user account details -->
    <div class="container mt-5">
        <?php 
        // Include the connection script to interact with the database
        include_once("connection.php");

        // Sanitize any POST data (for security against XSS attacks)
        array_map("htmlspecialchars", $_POST);
        
        // Prepare an SQL statement to retrieve a specific user's data using their UserID
        $stmt = $conn->prepare("SELECT * FROM tblusers WHERE UserID = :UserID;");

        // Retrieve the UserID from the query string passed via GET method
        $userID = $_GET['ADID'];
        $stmt->bindParam(':UserID', $userID); // Bind the UserID parameter to the query
        $stmt->execute(); // Execute the SQL statement

        // Fetch the user's data and display their first and last name
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo('<h1>'.$row["Firstname"].' '.$row["Lastname"].'</h1><br>');
        }
    
        // Display links for more detailed information about the user's account and their orders
        echo('<h2><a style="text-decoration:none; color:#980930;" href="accountinfo.php?AIID='.$_GET['ADID'].'">Account Info</a></h2><br>');
        echo('<h2><a style="text-decoration:none; color:#980930;" href="accountorders.php?AOID='.$_GET['ADID'].'">Orders</a></h2><br>');
        ?>
    </div>

</body>
</html>
