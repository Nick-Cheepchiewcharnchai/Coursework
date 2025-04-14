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

    <?php include("customerloggedin.php"); ?>
    <?php include("navbar.php"); ?>
    
    <div class="container mt-5">
        <h1>Purchases</h1>
        
        <div class="row" id="baskets">
            <h3>Unprocessed</h3>
        </div>

        <div class="row" id="baskets">
            <h3>Processed</h3>
        </div>

        <div class="row" id="baskets">
            <h3>Completed</h3>
        </div>
    </div>

</body>
</html>
