<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crosby Merch</title>
    <!-- Link to Bootstrap CSS for responsive design and styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="mystyle.css" rel="stylesheet"> <!-- Link to custom CSS for additional styling -->
</head>
<body>

    <?php include("adminloggedin.php"); ?>
    <?php include("adminnavbar.php"); ?>

    <!-- Main content area -->
    <div class="container mt-5">
        <!-- Heading for the current page -->
        <h1>Accounts</h1><br>

        <!-- Link to the accounts list page -->
        <h2><a style="text-decoration:none; color:#980930;" href="accountslist.php">Accounts list</a></h2><br>

        <!-- Link to the add users page -->
        <h2><a style="text-decoration:none; color:#980930;" href="addaccounts.php">Add account</a></h2><br>

        <!-- Link to the remove users page -->
        <h2><a style="text-decoration:none; color:#980930;" href="removeaccounts.php">Remove account</a></h2><br>
    </div>

</body>
</html>