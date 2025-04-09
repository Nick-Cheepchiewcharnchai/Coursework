<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Crosby Merch</title>
  <!-- Bootstrap CSS for responsive design and pre-built components -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="mystyle.css" rel="stylesheet"> <!-- Custom styles for the page -->
</head>

<body>

  <!-- Start a PHP session to handle user authentication -->
  <?php
  session_start(); 
  // Check if the session variable 'name' is set, meaning the user is logged in
  if (!isset($_SESSION['name'])) {   
    // If the user is not logged in, redirect them to the login page
    header("Location:login.php");
  }
  ?>

  <!-- Navbar for navigation, includes links to various pages -->
  <nav class="navbar navbar-expand-lg custom-navbar">
    <div class="container-fluid">
      <!-- Brand name with circular logo before the text -->
      <a class="navbar-brand" href="adminhomepage.php">
        <img src="Crosby-Logo.jpg" alt="Crosby"> Crosby Merch
      </a>
      <!-- Navbar toggler for mobile view -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Navbar links that collapse into a menu in mobile view -->
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

  <!-- Main content section -->
  <div class="container mt-5">
    <!-- Heading for the page -->
    <h1>Add account</h1><br>

    <!-- Form to add a new user account -->
    <form action="addinguser.php" method="post" enctype="multipart/form-data">
      <div class="row">
        <!-- First column for user details -->
        <div class="col">
          <b>Firstname:</b><br><input type="text" class="form-control" name="firstname"><br>
          <b>Surname:</b><br><input type="text" class="form-control" name="lastname"><br>
          <b>Username:</b><br><input type="text" class="form-control" name="username"><br>
          <b>Password:</b><br><input type="password" class="form-control" name="passwd"><br>
        </div>
        
        <!-- Second column for user authority selection -->
        <div class="col">
          <input type="radio" name="authority" value="User" checked> User <br>
          <input type="radio" name="authority" value="Admin"> Admin <br>
        </div>
      </div>
      
      <!-- Submit button to submit the form -->
      <div class="row">
        <input type="submit" class="confirm-button" value="Add Account">
      </div>
    </form>
  </div>

</body>
</html>