<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Set the character encoding for the webpage to UTF-8, which supports all characters -->
  <meta charset="UTF-8">
  
  <!-- Viewport meta tag ensures proper scaling on different screen sizes (for responsive design) -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!-- Title displayed on the browser tab -->
  <title>Crosby Merch</title>

  <!-- Include Bootstrap CSS from a CDN for pre-built styling and components -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Link to a custom CSS file for additional styling -->
  <link href="mystyle.css" rel="stylesheet">
</head>

<body>

  <?php
  // Start a session to track user authentication status
  session_start(); 
  
  // Check if the user is logged in by verifying the 'name' session variable
  if (!isset($_SESSION['name'])) {   
      // If the user is not logged in, redirect them to the login page
      header("Location:login.php");
  }
  ?>

  <!-- Navigation Bar with links to different admin pages -->
  <nav class="navbar navbar-expand-lg custom-navbar">
    <div class="container-fluid">
      <!-- Logo before "Crosby Merch" text in the navbar -->
      <a class="navbar-brand" href="adminhomepage.php">
        <img src="Crosby-Logo.jpg" alt="Crosby"> Crosby Merch
      </a>
      <!-- Navbar toggle button for mobile screens -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <!-- Navbar links (menu items) for different sections of the admin page -->
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <!-- Link to items page -->
          <li class="nav-item"><a class="nav-link" href="items.php">Items</a></li>
          <!-- Link to orders page -->
          <li class="nav-item"><a class="nav-link" href="orders.php">Orders</a></li>
          <!-- Link to accounts page -->
          <li class="nav-item"><a class="nav-link" href="accounts.php">Accounts</a></li>
          <!-- Link to logout page -->
          <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Main content area -->
  <div class="container mt-5">
    <!-- Page heading -->
    <h1>Account Info</h1></br>

    <div class="row">
      <!-- First column to display account information -->
      <div class="col">
        <?php
          // Include the database connection script to interact with the database
          include_once ("connection.php");

          // Sanitize the incoming POST data to avoid XSS attacks (although no POST data is actually used here)
          array_map("htmlspecialchars", $_POST);
          
          // Prepare a SQL statement to fetch data for a specific user based on the UserID
          $stmt = $conn->prepare("SELECT * FROM tblusers WHERE UserID = :UserID;");

          // Retrieve the 'AIID' parameter from the URL query string (GET method)
          $userID = $_GET['AIID'];
          // Bind the UserID parameter to the SQL query
          $stmt->bindParam(':UserID', $userID);
          // Execute the SQL query
          $stmt->execute();

          // Fetch the data and display it
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            // Display the first name of the user
            echo("<p><b>Firstname:</b></p><p>".$row["Firstname"]."</p>");
            // Display the last name of the user
            echo("<p><b>Surname:</b></p><p>".$row["Lastname"]."</p>");
            // Display the username of the user
            echo("<p><b>Username:</b></p><p>".$row["Username"]."</p>");
            // Display the password of the user
            // However, it is commented out because it displays the hashed password which is unhelpful
            //echo("<p><b>Password:</b></p><p>".$row["Password"]."</p>");
          }
        ?>
      </div>
    </div>
  </div>

</body>
</html>