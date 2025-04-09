<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crosby Merch</title>
    <!-- Bootstrap CSS for styling and responsiveness -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="mystyle.css" rel="stylesheet"> <!-- Link to custom CSS for additional styling -->
</head>
<body>

    <?php
    // Start the session to access session variables (e.g., user's information)
    session_start(); 

    // Check if the user is logged in, if not redirect to login page
    if (!isset($_SESSION['name'])) {   
        header("Location:login.php");
    }
    ?>

    <!-- Navbar Section -->
    <nav class="navbar navbar-expand-lg custom-navbar">
        <div class="container-fluid">
            <!-- Navbar brand with a logo and text -->
            <a class="navbar-brand" href="homepage.php">
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
                    <li class="nav-item"><a class="nav-link" href="homepage.php">Browse</a></li>
                    <li class="nav-item"><a class="nav-link" href="basket.php">Basket</a></li>
                    <li class="nav-item"><a class="nav-link" href="purchases.php">Purchases</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Main content area -->
    <div class="container mt-5">
        <h1>Purchases</h1>
        
        <!-- Unprocessed orders section -->
        <div class="row" id="baskets">
            <h3>Unprocessed</h3>
            <?php
            // Include the database connection
            include_once ("connection.php");

            // Prepare a SQL query to fetch orders with 'Unprocessed' status for the logged-in user
            $stmt = $conn->prepare('SELECT * FROM tblorders WHERE UserID = :UserID AND Status = "Unprocessed"');
            $stmt->bindParam(':UserID', $_SESSION['name']); // Bind user ID to the query
            $stmt->execute();

            // Loop through the results and display each unprocessed order as a link to the basket
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                echo('<div class="row basket-item">');
                echo('<a style="text-decoration:none; color:inherit;" href="purchasebasket.php?BID='.$row["BasketID"].'">Basket '.$row["BasketID"].'</a>');
                echo('</div>');
            }
            ?>
        </div>

        <!-- Processed orders section -->
        <div class="row" id="baskets">
            <h3>Processed</h3>
            <?php
            // Fetch processed orders in a similar way to unprocessed ones
            $stmt = $conn->prepare('SELECT * FROM tblorders WHERE UserID = :UserID AND Status = "Processed"');
            $stmt->bindParam(':UserID', $_SESSION['name']);
            $stmt->execute();

            // Loop through and display processed orders
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                echo('<div class="row basket-item">');
                echo('<a style="text-decoration:none; color:inherit;" href="purchasebasket.php?BID='.$row["BasketID"].'">Basket '.$row["BasketID"].'</a>');
                echo('</div>');
            }
            ?>
        </div>

        <!-- Completed orders section -->
        <div class="row" id="baskets">
            <h3>Finished</h3>
            <?php
            // Fetch completed orders in a similar way to processed ones
            $stmt = $conn->prepare('SELECT * FROM tblorders WHERE UserID = :UserID AND Status = "Completed"');
            $stmt->bindParam(':UserID', $_SESSION['name']);
            $stmt->execute();

            // Loop through and display completed orders
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                echo('<div class="row basket-item">');
                echo('<a style="text-decoration:none; color:inherit;" href="purchasebasket.php?BID='.$row["BasketID"].'">Basket '.$row["BasketID"].'</a>');
                echo('</div>');
            }
            ?>
        </div>
    </div>

</body>
</html>
