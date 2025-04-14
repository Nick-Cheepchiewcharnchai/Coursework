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

    <!-- Main content area for displaying the orders page -->
    <div class="container mt-5">
        <!-- Heading for the Orders section -->
        <h1>Orders</h1><br>

        <!-- Links to different order statuses -->
        <!-- Each link points to a separate page showing orders for each status -->
        <h2><a style="text-decoration:none; color:#980930;" href="unprocessed.php">Unprocessed</a></h2><br>
        <h2><a style="text-decoration:none; color:#980930;" href="processed.php">Processed</a></h2><br>
        <h2><a style="text-decoration:none; color:#980930;" href="completed.php">Completed</a></h2><br>
    </div>

</body>
</html>