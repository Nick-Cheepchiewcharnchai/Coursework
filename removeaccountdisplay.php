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

  <!-- Main content area -->
  <div class="container mt-5">
    <!-- Page heading -->
    <h1>Remove</h1></br>

    <div class="row">
      <!-- column to display account information -->
      <div class="col">
        <?php
          // Include the database connection script to interact with the database
          include_once ("connection.php");

          // Sanitize the incoming POST data to avoid XSS attacks (although no POST data is actually used here)
          array_map("htmlspecialchars", $_POST);
          
          // Prepare a SQL statement to fetch data for a specific user based on the UserID
          $stmt = $conn->prepare("SELECT * FROM tblusers WHERE UserID = :UserID;");

          // Retrieve the 'RAID' parameter from the URL query string (GET method)
          $userID = $_GET['RAID'];
          // Bind the UserID parameter to the SQL query
          $stmt->bindParam(':UserID', $userID);
          // Execute the SQL query
          $stmt->execute();

          // Fetch the data and display it
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            // Display the first name of the user
            echo("<p><b>Firstname:</b></p><p>".$row["Firstname"]."</p>");
            // Display the last name of the user
            echo("<p><b>Surname:</b></p><p>".$row["Lastname"]."</p>");
            // Display the username of the user
            echo("<p><b>Username:</b></p><p>".$row["Username"]."</p>");
            // Display the password of the user
            // However, it is commented out because it displays the hashed password which is unhelpful
            //echo("<p><b>Password:</b></p><p>".$row["Password"]."</p>");
          }
        ?>
      </div>
    </div>

    <!-- Form for removing the account -->
    <div class="row">
      <form action="removingaccount.php" method="post">
        <?php
        echo('<input type="hidden" name="UserID" value ="'.$_GET['RAID'].'">');
        ?>
        <input type="submit" class="confirm-button" value="Remove Account">
      </form>
    </div>
  </div>

</body>
</html>