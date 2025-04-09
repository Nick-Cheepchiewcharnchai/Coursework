<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"> <!-- Specifies the character encoding for the document -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Ensures proper scaling on mobile devices -->
  <title>Crosby Merch</title> <!-- Title of the page in the browser tab -->
  <!-- Link to Bootstrap CSS for responsive and styled components -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Link to custom CSS file for additional styling -->
  <link href="mystyle.css" rel="stylesheet">
</head>

<body>

  <?php
  session_start(); 
  // Start a session and check if the session variable 'name' exists (indicating the user is logged in)
  if (!isset($_SESSION['name']))
  {   
    // If the user is not logged in, redirect them to the login page
    header("Location:login.php");
  }
  ?>

  <!-- Navbar Section -->
  <nav class="navbar navbar-expand-lg custom-navbar">
    <div class="container-fluid">
      <!-- The navigation bar with a brand logo and link to admin homepage -->
      <a class="navbar-brand" href="adminhomepage.php">
        <img src="Crosby-Logo.jpg" alt="Crosby"> Crosby Merch
      </a>
      <!-- Toggle button for responsive design (for mobile views) -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Navbar links to different pages -->
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

  <!-- Main Content Section -->
  <div class="container mt-5">
    <h1>Add item</h1><br>
    <!-- Form to add an item, submits to 'addingitem.php' -->
    <form action="addingitem.php" method="post" enctype="multipart/form-data">
      <div class="row">
        <div class="col">
          <!-- Section to upload front and back pictures of the item -->
          <div class="row">
            <div class="col">
              Front picture:</br><input type="file" id="picfront" name="picfront" accept="image/*"><br> <!-- File input for front picture -->
            </div>
            <div class="col">
              Back picture:</br><input type="file" id="picback" name="picback" accept="image/*"><br> <!-- File input for back picture -->
            </div>
          </div>
        </div>
        <div class="col">
          <!-- Section for entering item details (name, price, description, type) -->
          Item name:</br><input type="text" class="form-control" name="itemname"><br> <!-- Text input for item name -->
          Item price:</br><input type="text" class="form-control" name="itemcost"><br> <!-- Text input for item price -->
          Item description:</br><textarea class="form-control" name="itemdescription" rows="4" cols="50"></textarea><br> <!-- Textarea for item description -->
          
          <!-- Dropdown to select item type -->
          Item type:</br><select name="itemtype">
            <option value="T">Tops</option> <!-- Option for Tops -->
            <option value="B">Bottoms</option> <!-- Option for Bottoms -->
            <option value="A">Accessories</option> <!-- Option for Accessories -->
            <option value="O">Others</option> <!-- Option for Other categories -->
          </select></br>

          </br><input type="submit" class="confirm-button" value="Add Item"> <!-- Submit button to add the item -->
        </div>
      </div>
    </form>
  </div>

</body>
</html>
