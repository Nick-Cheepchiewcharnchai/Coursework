<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Crosby Merch</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="mystyle.css" rel="stylesheet">
</head>

<body>

  <?php include("adminloggedin.php"); ?>
  <?php include("adminnavbar.php"); ?>

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
              Front picture:</br><input class="form-control" type="file" id="picfront" name="picfront" accept="image/*" required><br> <!-- File input for front picture -->
            </div>
            <div class="col">
              Back picture:</br><input class="form-control" type="file" id="picback" name="picback" accept="image/*" required><br> <!-- File input for back picture -->
            </div>
          </div>
        </div>
        <div class="col">
          <!-- Section for entering item details (name, price, description, type) -->
          Item name:</br><input type="text" class="form-control" name="itemname" required><br> <!-- Text input for item name -->
          Item price:</br><input type="text" class="form-control" name="itemcost" required><br> <!-- Text input for item price -->
          Item description:</br><textarea class="form-control" name="itemdescription" rows="4" cols="50"></textarea><br> <!-- Textarea for item description -->
          
          <!-- Dropdown to select item type -->
          Item type:</br><select class="form-select" name="itemtype" required>
            <option value="T">Tops</option> <!-- Option for Tops -->
            <option value="B">Bottoms</option> <!-- Option for Bottoms -->
            <option value="A">Accessories</option> <!-- Option for Accessories -->
            <option value="O">Others</option> <!-- Option for Other categories -->
          </select></br>

          </br><input type="submit" class="confirm-button" value="Add Item"> <!-- Submit button -->
        </div>
      </div>
    </form>
  </div>

</body>
</html>
