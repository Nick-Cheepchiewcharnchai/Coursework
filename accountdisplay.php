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

    <div class="container mt-5">
        <?php 
        echo('<h1>'.$_GET['FN'].' '.$_GET['LN'].'</h1><br>');
    
        echo('<h2><a style="text-decoration:none; color:#980930;" href="accountinfo.php?AIID='.$_GET['ADID'].'">Account Info</a></h2><br>');
        echo('<h2><a style="text-decoration:none; color:#980930;" href="accountorders.php?AOID='.$_GET['ADID'].'">Orders</a></h2><br>');
        ?>
    </div>

</body>
</html>
