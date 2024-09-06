<!DOCTYPE html>

<html lang="en">

<head>
  <title>Crosby Merch</title>
</head>

<body>

<form action="addusers.php" method = "post">
  First name:<input type="text" name="firstname"><br>
  Last name:<input type="text" name="lastname"><br>
  Username:<input type="text" name="username"><br>
  Password:<input type="password" name="passwd"><br>
  <br>
  <input type="radio" name="role" value= "User" checked> User <br>
  <input type="radio" name="role" value="Admin"> Admin <br>
  <input type="submit" value="Add User">
</form>

</body>
</html>

