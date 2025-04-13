<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crosby Merch</title>
    <!-- Bootstrap CSS: Link to external stylesheet for responsive and styled UI elements -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS: Link to the custom stylesheet for additional styling specific to this page -->
    <link href="mystyle.css" rel="stylesheet">
</head>
<body>

    <?php include("adminloggedin.php"); ?>
    <?php include("adminnavbar.php"); ?>

    <!-- Main content area -->
    <div class="container mt-5">
        <!-- Heading for the page -->
        <h1>Items</h1><br>

        <!-- Link to view the list of items -->
        <h2><a style="text-decoration:none; color:#980930;" href="adminbrowse.php">Items list</a></h2><br>

        <!-- Link to add a new item -->
        <h2><a style="text-decoration:none; color:#980930;" href="additems.php">Add item</a></h2><br>
    </div>

</body>
</html>
