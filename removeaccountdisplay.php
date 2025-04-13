<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Crosby Merch</title>
  <!-- Bootstrap CSS for styling -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="mystyle.css" rel="stylesheet"> <!-- Custom stylesheet -->
</head>

<body>

  <?php include("adminloggedin.php"); ?>
  <?php include("adminnavbar.php"); ?>

  <!-- Main content area -->
  <div class="container mt-5">
    <h1>Remove</h1><br> <!-- Title for the page -->
    <div class="row">
      <div class="col">
        <?php
        // Include the database connection file
        include_once ("connection.php");

        // Sanitize any POST data (though the form in this case uses GET for UserID)
        array_map("htmlspecialchars", $_POST);

        // Prepare a SQL query to select a user by their UserID
        $stmt = $conn->prepare("SELECT * FROM tblusers WHERE UserID = :UserID;");

        // Get the UserID from the query parameter in the URL (GET request)
        $userID = $_GET['RAID'];

        // Bind the UserID parameter to the prepared statement
        $stmt->bindParam(':UserID', $userID);
        $stmt->execute();  // Execute the query to fetch the user details

        // Loop through the fetched results and display user information
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          // Display the user's details such as Firstname, Lastname, Username, and Password (commented out becausse it is hashed)
          echo("<p><b>Firstname:</b></p><p>".$row["Firstname"]."</p>");
          echo("<p><b>Surname:</b></p><p>".$row["Lastname"]."</p>");
          echo("<p><b>Username:</b></p><p>".$row["Username"]."</p>");
          //echo("<p><b>Password:</b></p><p>".$row["Password"]."</p>");
        }
        ?>
      </div>
      <div class="col">
        <!-- This empty column is reserved for layout or future use -->
      </div>
    </div>

    <!-- Form for removing the account -->
    <div class="row">
      <form action="removingaccount.php" method="post">
        <!-- Hidden input to pass the UserID to the removing user script -->
        <?php
        echo('<input type="hidden" name="UserID" value ="'.$_GET['RAID'].'">');
        ?>
        <!-- Submit button to confirm removal of the account -->
        <input type="submit" class="confirm-button" value="Remove Account">
      </form>
    </div>
  </div>

</body>
</html>