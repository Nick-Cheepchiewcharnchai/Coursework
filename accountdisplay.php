<!DOCTYPE html>

<html>

<head>
  <title>Users</title>
</head>

<body>

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

