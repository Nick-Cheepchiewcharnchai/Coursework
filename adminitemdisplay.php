<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crosby Merch</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="mystyle.css" rel="stylesheet">
</head>
<body>

    <?php
    session_start(); 
    if (!isset($_SESSION['name']))
    {   
        header("Location:login.php");
    }
    ?>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg custom-navbar">
        <div class="container-fluid">
            <!-- Circular image before "Crosby Merch" -->
            <a class="navbar-brand" href="adminhomepage.php">
                <img src="Crosby-Logo.jpg" alt="Crosby"> Crosby Merch
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="items.php">Items</a></li>
                    <li class="nav-item"><a class="nav-link" href="orders.php">Orders</a></li>
                    <li class="nav-item"><a class="nav-link" href="accounts.php">Accounts</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    
    <?php
        
        include_once ("connection.php");
        
        $stmt = $conn->prepare("SELECT * FROM tblitems WHERE ItemID = :itemID");
        $itemID = $_GET['ABID'];
        $stmt->bindParam(':itemID', $itemID, PDO::PARAM_INT);
        $stmt->execute();
    
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo('<div class="container mt-5">');
            echo('<div class="row">');
            echo('<div class="col-lg-4"><img src="/Coursework/Coursework-1/Pictures/'.$row["Picfront"].'" class="img-fluid"></div>');
            echo('<div class="col-lg-4"><img src="/Coursework/Coursework-1/Pictures/'.$row["Picback"].'" class="img-fluid "></div>');
            echo('<div class="col-lg-4">');

            echo('<div class="text-end">');
            echo('<h1 class="fw-bolder">'.$row["Itemname"].'</h1>');
            echo('<h2>'.$row["Itemcost"].'</h>');
            echo('</div>');

            echo('<div>');

            echo('<div>');
            echo('<p><b>Size</b></p>');
            $sizes = ["XXL", "XL", "L", "M", "S", "XS", "XXS"];
            foreach ($sizes as $size){
                echo('<input type="radio" class="btn" name="SelectedSize" value ="'.$size.'" required>');
                echo('<label class="btn btn-outline-dark" for="'.$size.'">'.$size.'</label>');
            }
            
            echo('</div>');

            echo('<div>');
            echo('<br><p><b>Quantity</b></p>');
            echo('<select name="SelectedQuantity">');
            echo('<option value="1" checked>1</option>');
            echo('<option value="2">2</option>');
            echo('<option value="3">3</option>');
            echo('<option value="4">4</option>');
            echo('<option value="5">5</option>');
            echo('</select>');
            echo('</div>');
            
            echo('<div>');
            echo('<br><p><b>Description</b></p>');
            echo($row['Itemdescription']);
            echo('</div>');

            echo('</div>');
            
            echo('</div>');
            echo('</div>');
            echo('</div>');
        }
    ?>

</body>
</html>