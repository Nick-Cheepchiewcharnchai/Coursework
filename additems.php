<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Crosby Merch</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="mystyle.css" rel="stylesheet">
</head>

<body>

  <?php
  session_start(); 
  if (!isset($_SESSION['name']))
  {   
  header("Location:login.php");
  }
  ?>

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

  <div class="container mt-5">
    <h1>Add item</h1><br>
    <form action="addingitem.php" method = "post" enctype="multipart/form-data">
      <div class="row">
        <div class="col">
          <div class="row">
            <div class="col">
              Front picture:</br><input type="file" id="picfront" name="picfront" accept="image/*"><br>
            </div>
            <div class="col">
              Back picture:</br><input type="file" id="picback" name="picback" accept="image/*"><br>
            </div>
          </div>
        </div>
        <div class="col">
          Item name:</br><input type="text" class="form-control" name="itemname"><br>
          Item price:</br><input type="text" class="form-control" name="itemcost"><br>
          Item description:</br><textarea class="form-control" name="itemdescription" rows="4" cols="50"></textarea><br>
          Item type:</br><select name="itemtype">
            <option value="T">Tops</option>
            <option value="B">Bottoms</option>
            <option value="A">Accessories</option>
            <option value="O">Others</option>
          </select></br>
          </br><input type="submit" class="confirm-button" value="Add Item">
        </div>
      </div>
    </form>
  </div>

</body>
</html>

