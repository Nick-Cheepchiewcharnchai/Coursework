<!DOCTYPE html>

<html lang="en">

<head>
  <title>Crosby Merch</title>
</head>

<body>

<form action="addusers.php" method = "post">
  Firstname:<input type="text" name="firstname"><br>
  Lastname:<input type="text" name="lastname"><br>
  Username:<input type="text" name="username"><br>
  Password:<input type="password" name="passwd"><br>
  <br>
  <input type="radio" name="authority" value= "User" checked> User <br>
  <input type="radio" name="authority" value="Admin"> Admin <br>
  <input type="submit" value="Add User">
</form>

<?php
  include_once('connection.php');

  $stmt = $conn->prepare("SELECT * FROM tblusers");
  $stmt->execute();

  while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
      echo($row["Firstname"].' '.$row["Lastname"]."<br>");
    }
?>

</body>
</html>

