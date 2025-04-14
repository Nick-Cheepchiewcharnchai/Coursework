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

  <!-- Main content section -->
  <div class="container mt-5">
    <!-- Heading for the page -->
    <h1>Add account</h1><br>

    <!-- Form to add a new user account -->
    <form action="addingaccount.php" method="post" enctype="multipart/form-data">
      <div class="row">
        <!-- First column for user details -->
        <div class="col">
          <b>Firstname:</b><br><input type="text" class="form-control" name="firstname" required><br>
          <b>Surname:</b><br><input type="text" class="form-control" name="lastname" required><br>
          <b>Username:</b><br><input type="text" class="form-control" name="username" required><br>
          <b>Password:</b><br><input type="password" class="form-control" name="passwd" required><br>
        </div>
        
        <!-- Second column for user authority selection -->
        <div class="col">
          <input type="radio" name="authority" value="User" checked> User <br>
          <input type="radio" name="authority" value="Admin"> Admin <br>
        </div>
      </div>
      
      <!-- Submit button to submit the form -->
      <div class="row">
        <input type="submit" class="confirm-button" value="Add Account">
      </div>
    </form>
  </div>

</body>
</html>