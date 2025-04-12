<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Crosby Merch</title>
  <!-- Bootstrap CSS for styling -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="mystyle.css" rel="stylesheet"> <!-- Custom stylesheet -->
</head>

<body>

  <?php
  // Start the session to access session variables
  session_start(); 

  // If the user is not logged in (session 'name' does not exist), redirect them to the login page
  if (!isset($_SESSION['name'])) {   
    header("Location:login.php");  // Redirect to login page
  }
  ?>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg custom-navbar">
    <div class="container-fluid">
      <!-- Circular image before "Crosby Merch" -->
      <a class="navbar-brand" href="adminhomepage.php">
        <img src="Crosby-Logo.jpg" alt="Crosby"> Crosby Merch
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
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
    <h1>Remove</h1><br> <!-- Title for the page -->
    <div class="row">
      <div class="col">
        <?php
        // Include the database connection file
        include_once ("connection.php");

        // Sanitize any POST data (though the form in this case uses GET for UserID)
        array_map("htmlspecialchars", $_POST);

        // Prepare a SQL query to select a user by their UserID
        $stmt = $conn->prepare("SELECT * FROM tblusers WHERE UserID = :UserID;");

        // Get the UserID from the query parameter in the URL (GET request)
        $userID = $_GET['RAID'];

        // Bind the UserID parameter to the prepared statement
        $stmt->bindParam(':UserID', $userID);
        $stmt->execute();  // Execute the query to fetch the user details

        // Loop through the fetched results and display user information
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          // Display the user's details such as Firstname, Lastname, Username, and Password (commented out becausse it is hashed)
          echo("<p><b>Firstname:</b></p><p>".$row["Firstname"]."</p>");
          echo("<p><b>Surname:</b></p><p>".$row["Lastname"]."</p>");
          echo("<p><b>Username:</b></p><p>".$row["Username"]."</p>");
          //echo("<p><b>Password:</b></p><p>".$row["Password"]."</p>");
        }
        ?>
      </div>
      <div class="col">
        <!-- This empty column is reserved for layout or future use -->
      </div>
    </div>

    <!-- Form for removing the account -->
    <div class="row">
      <form action="removinguser.php" method="post">
        <!-- Hidden input to pass the UserID to the removing user script -->
        <?php
        echo('<input type="hidden" name="UserID" value ="'.$_GET['RAID'].'">');
        ?>
        <!-- Submit button to confirm removal of the account -->
        <input type="submit" class="confirm-button" value="Remove Account">
      </form>
    </div>
  </div>

</body>
</html>