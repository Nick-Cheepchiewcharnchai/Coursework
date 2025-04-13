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
        <h1>Basket</h1>

        <div class="row" id="basketContainer">
            <?php
                include_once ("connection.php");
                
                $stmt = $conn->prepare("SELECT * FROM tblbasketitems INNER JOIN tblitems ON tblbasketitems.ItemID = tblitems.ItemID INNER JOIN tblbaskets ON tblbasketitems.BasketID = tblbaskets.BasketID WHERE UserID = :UserID AND IsOrdered = 0");

                $stmt->bindParam(':UserID', $_SESSION['name']);
                $stmt->execute();

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    echo($row["Itemname"]);
                    echo($row["ItemSize"]);
                    echo($row["Quantity"]);
                    echo($row["Itemcost"]);
                }
            ?>
        </div>
        
    </div>
</body>
</html>
