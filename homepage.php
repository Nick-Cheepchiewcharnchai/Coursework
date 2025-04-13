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
        <div class="row" id="itemContainer">
            <?php
                include_once("connection.php");

                $stmt = $conn->prepare("SELECT * FROM tblitems");
                $stmt->execute();

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo('<div class="col-lg-3 item-card" data-type="' . $row['Itemtype'] . '">');
                    echo('<a style="text-decoration:none; color:inherit;" href="itemdisplay.php?IID=' . $row["ItemID"] . '">');
                    echo('<div><img src="/Coursework/Coursework-1/Pictures/' . $row["Picfront"] . '" width="200" height="200"></div>');
                    echo('<div class="item-name"><b>' . $row["Itemname"] . '</b></div>');
                    echo('<div class="item-price">£' . $row["Itemcost"] . '</div>');
                    echo('</a>');
                    echo('</div>');
                }
            ?>
        </div>
    </div>
            
</body>

</html>