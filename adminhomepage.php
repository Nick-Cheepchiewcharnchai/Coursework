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
        <!-- Links to navigate to different sections of the admin panel -->
        <h1><a style="text-decoration:none; color:inherit;" href="items.php">Items</a></h1><br>
        <h1><a style="text-decoration:none; color:inherit;" href="orders.php">Orders</a></h1><br>
        <h1><a style="text-decoration:none; color:inherit;" href="accounts.php">Accounts</a></h1><br>
    </div>

</body>
</html>
