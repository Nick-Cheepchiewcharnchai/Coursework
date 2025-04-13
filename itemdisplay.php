<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crosby Merch</title>
    <!-- Bootstrap CSS for styling the page -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="mystyle.css" rel="stylesheet">
</head>
<body>

    <?php include("customerloggedin.php"); ?>
    <?php include("navbar.php"); ?>
    
    <?php
    // Include database connection
    include_once("connection.php");
    
    // Prepare SQL statement to fetch the item based on ItemID passed in the URL
    $stmt = $conn->prepare("SELECT * FROM tblitems WHERE ItemID = :itemID");
    // Get ItemID from the URL parameter (e.g., itemdisplay.php?IID=123)
    $itemID = $_GET['IID'];
    // Bind the ItemID parameter to the prepared statement
    $stmt->bindParam(':itemID', $itemID, PDO::PARAM_INT);
    // Execute the query to retrieve item details
    $stmt->execute();
    
    // Fetch the item details from the query result
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Display item details in the HTML
        echo('<div class="container mt-5">');
        echo('<div class="row">');
        // Display item front image in a column
        echo('<div class="col-lg-4"><img src="/Coursework/Coursework-1/Pictures/'.$row["Picfront"].'" class="img-fluid"></div>');
        // Display item back image in another column
        echo('<div class="col-lg-4"><img src="/Coursework/Coursework-1/Pictures/'.$row["Picback"].'" class="img-fluid"></div>');
        // Display item name, cost, and form for adding to the basket in the last column
        echo('<div class="col-lg-4">');
        
        echo('<div class="text-end">');
        // Display the item name in a bold heading
        echo('<h1 class="fw-bolder">'.$row["Itemname"].'</h1>');
        // Display the item price
        echo('<h2>£'.$row["Itemcost"].'</h2>');
        echo('</div>');
        
        // Display a form for selecting size, quantity, and adding the item to the basket
        echo('<div>');
        echo('<form action="addtobasket.php" method="post">');
        // Hidden input to store the ItemID (passed when form is submitted)
        echo('<input type="hidden" name="ItemID" value ="'.$row["ItemID"].'">');

        // Size selection: list of sizes to choose from (XXL, XL, etc.)
        echo('<div>');
        echo('<p><b>Size</b></p>');
        $sizes = ["XXL", "XL", "L", "M", "S", "XS", "XXS"];
        // Loop through the available sizes and create radio buttons
        foreach ($sizes as $size){
            echo('<input type="radio" class="btn" name="SelectedSize" value ="'.$size.'" required>');
            echo('<label class="btn btn-outline-dark" for="'.$size.'">'.$size.'</label>');
        }
        echo('</div>');
        
        // Quantity selection: dropdown for selecting the number of items
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
        
        // Submit button to add the selected item to the basket
        echo('<button type="submit" class="btn btn-dark mt-3">Add to Basket</button>');
        echo('</form>');
        
        // Display the item description
        echo('<div>');
        echo('<br><p><b>Description</b></p>');
        echo($row['Itemdescription']);
        echo('</div>');

        echo('</div>'); // Close the item description and form section
        
        echo('</div>'); // Close the column with item information
        echo('</div>'); // Close the row
        echo('</div>'); // Close the container
    }
    ?>

</body>
</html>