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

  <div class="container mt-5">
    <h1>Add item</h1><br>

    <form action="addingitem.php" method="post" enctype="multipart/form-data">
      Front picture:</br><input type="file" id="picfront" name="picfront" accept="image/*"><br>
      Back picture:</br><input type="file" id="picback" name="picback" accept="image/*"><br>
      Item name:</br><input type="text" name="itemname"><br>
      Item price:</br><input type="text" name="itemcost"><br>
      Item description:</br><textarea name="itemdescription" rows="4" cols="50"></textarea><br>
      Item type:</br><select name="itemtype">
        <option value="T">Tops</option>
        <option value="B">Bottoms</option>
        <option value="A">Accessories</option>
        <option value="O">Others</option>
      </select></br>
      </br><input type="submit" class="button" value="Add Item">
    </form>
  </div>

</body>
</html>
