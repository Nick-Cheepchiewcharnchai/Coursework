<!DOCTYPE html>

<html>

<head>
  <title>Crosby Merch</title>
</head>

<body>

<form action="additems.php" method = "post">
  Itemname:<input type="text" name="itemname"><br>
  Itemdescription:<input type="text" name="itemdescription"><br>
  Itemtype:<select name="itemtype">
    <option value="T">Tops</option>
    <option value="B">Bottoms</option>
    <option value="A">Accessories</option>
    <option value="O">Others</option>
  </select><br>
  Itemcost:<input type="text" name="itemcost"><br>
  <input type="submit" value="Add User">
                    <!--PICTURESSSS-->
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

