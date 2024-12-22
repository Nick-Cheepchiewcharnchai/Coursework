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
        <li class="nav-item"><a class="nav-link" href="login.php">Logout</a></li>
        </ul>
      </div>
    </div>
  </nav>

<form action="addingitem.php" method = "post" enctype="multipart/form-data">
  Item name:<input type="text" name="itemname"><br>
  Item description:<input type="text" name="itemdescription"><br>
  Item type:<select name="itemtype">
    <option value="T">Tops</option>
    <option value="B">Bottoms</option>
    <option value="A">Accessories</option>
    <option value="O">Others</option>
  </select><br>
  Item cost:<input type="text" name="itemcost"><br>
  Picture front:<input type="file" id="picfront" name="picfront" accept="image/*"><br>
  Picture back:<input type="file" id="picback" name="picback" accept="image/*"><br>
  <input type="submit" value="Add Item">
</form>

<?php
  include_once('connection.php');

  $stmt = $conn->prepare("SELECT * FROM tblitems");
  $stmt->execute();

  while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
      echo($row["Itemname"].' '.$row["Itemcost"]."<br>");
    }
?>

</body>
</html>

