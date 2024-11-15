<!DOCTYPE html>

<html>

<head>
  <title>Users</title>
</head>

<body>

<h2>Add a new user</h2>

<form action="addusers.php" method = "post">
  Firstname:<input type="text" name="firstname" required><br>
  Lastname:<input type="text" name="lastname" required><br>
  Username:<input type="text" name="username" required><br>
  Password:<input type="password" name="passwd" required><br>
  <br>
  <input type="radio" name="authority" value= "User" checked> User <br>
  <input type="radio" name="authority" value="Admin"> Admin <br>
  <input type="submit" value="Add User">
</form>

<h2>Existing users</h2>

<?php
  include_once('connection.php');

  $stmt = $conn->prepare("SELECT * FROM tblusers");
  $stmt->execute();

  while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
      echo htmlspecialchars($row["Firstname"].' '.$row["Lastname"]."\n");
    }
?>

</body>
</html>

