<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crosby Merch</title>
    <!-- Bootstrap CSS for responsive and styled elements -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="mystyle.css" rel="stylesheet"> <!-- Custom styles from mystyle.css -->
</head>
<body>

    <?php
    // Start the session to manage session variables and user data
    session_start(); 

    // Check if the user is logged in by verifying if the session variable 'name' exists
    if (!isset($_SESSION['name'])) {   
        // If the user is not logged in, redirect them to the login page
        header("Location:login.php");
    }
    ?>

    <!-- Navbar (Navigation Bar) -->
    <nav class="navbar navbar-expand-lg custom-navbar">
        <div class="container-fluid">
            <!-- Circular image and link for "Crosby Merch" brand logo -->
            <a class="navbar-brand" href="adminhomepage.php">
                <img src="Crosby-Logo.jpg" alt="Crosby"> Crosby Merch
            </a>
            <!-- Toggler for smaller screens (hamburger menu) -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Navbar items -->
                <ul class="navbar-nav ms-auto">
                    <!-- Links for different sections of the admin panel -->
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
        <h1>Processed</h1> <!-- Page heading -->

        <!-- Row to hold all the processed orders -->
        <div class="row" id="baskets">
            <?php
            // Include the database connection file
            include_once ("connection.php");
            
            // Prepare the SQL query to fetch orders with the 'Processed' status from the tblorders table
            $stmt = $conn->prepare('SELECT * FROM tblorders INNER JOIN tblusers ON tblorders.UserID = tblusers.UserID WHERE Status = "Processed"');

            // Execute the prepared statement
            $stmt->execute();

            // Loop through the results and display each processed order
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Create a row for each order with a link to the completeorder.php page, passing BasketID and user details as parameters
                echo('<div class="row basket-item">');
                echo('<a style="text-decoration:none; color:inherit;" href="completeorder.php?BID='.$row["BasketID"].'&FN='.$row["Firstname"].'&LN='.$row["Lastname"].'">Basket: '.$row["Firstname"].' '.$row["Lastname"].'</a>');
                echo('</div>');
            }
            ?>
        </div>
    </div>

</body>
</html>
