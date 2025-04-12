<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crosby Merch</title>
    <!-- Bootstrap CSS: Link to the external stylesheet for responsive and styled UI elements -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS: Link to the custom stylesheet for additional styles -->
    <link href="mystyle.css" rel="stylesheet">
</head>
<body>

    <?php
    session_start();  // Start or resume the current session
    if (!isset($_SESSION['name']))  // Check if the user is logged in
    {   
        header("Location:login.php");  // Redirect to login page if the user is not logged in
    }
    ?>

    <!-- Navbar Section -->
    <nav class="navbar navbar-expand-lg custom-navbar">
        <div class="container-fluid">
            <!-- Logo and brand name section of the navbar -->
            <a class="navbar-brand" href="adminhomepage.php">
                <img src="Crosby-Logo.jpg" alt="Crosby"> Crosby Merch
            </a>
            <!-- Navbar toggle button for smaller screens -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Navbar menu links -->
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
        include_once("connection.php");  // Include the database connection file

        // Prepare a query to select item details from the database based on the ItemID
        $stmt = $conn->prepare("SELECT * FROM tblitems WHERE ItemID = :itemID");
        $itemID = $_GET['ABID'];  // Get the item ID from the URL (admin's click on item)
        $stmt->bindParam(':itemID', $itemID, PDO::PARAM_INT);  // Bind the itemID to the query
        $stmt->execute();  // Execute the query
    
        // Fetch and display the item details
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo('<div class="container mt-5">');
            echo('<div class="row">');
            // Display the front and back pictures of the item
            echo('<div class="col-lg-4"><img src="/Coursework/Coursework-1/Pictures/'.$row["Picfront"].'" class="img-fluid"></div>');
            echo('<div class="col-lg-4"><img src="/Coursework/Coursework-1/Pictures/'.$row["Picback"].'" class="img-fluid"></div>');
            echo('<div class="col-lg-4">');

            // Display item name and cost
            echo('<div class="text-end">');
            echo('<h1 class="fw-bolder">'.$row["Itemname"].'</h1>');
            echo('<h2>£'.$row["Itemcost"].'</h2>');
            echo('</div>');

            // Display size selection
            echo('<div>');
            echo('<p><b>Size</b></p>');
            $sizes = ["XXL", "XL", "L", "M", "S", "XS", "XXS"];
            foreach ($sizes as $size){
                // Generate a radio button for each size
                echo('<input type="radio" class="btn" name="SelectedSize" value="'.$size.'" required>');
                echo('<label class="btn btn-outline-dark" for="'.$size.'">'.$size.'</label>');
            }
            echo('</div>');

            // Display quantity selection dropdown
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
            
            // Display the item's description
            echo('<div>');
            echo('<br><p><b>Description</b></p>');
            echo($row['Itemdescription']);  // Display item description
            echo('</div>');

            echo('</div>');  // Close column for item details
            echo('</div>');  // Close row
            echo('</div>');  // Close container
        }
    ?>

</body>
</html>


