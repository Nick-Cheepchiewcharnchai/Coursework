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
    
    <?php

    include_once("connection.php");
    
    // Prepare a SQL statement to select item details by item ID
    $stmt = $conn->prepare("SELECT * FROM tblitems WHERE ItemID = :itemID");
    // Get the item ID from the URL (query parameter IID)
    $itemID = $_GET['IID'];
    $stmt->bindParam(':itemID', $itemID, PDO::PARAM_INT);
    $stmt->execute();

    // Fetch and display the item data if it exists
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        // Container for layout and spacing
        echo('<div class="container mt-5">');
            echo('<div class="row">');

                // First column: front image of the item
                echo('<div class="col-lg-4"><img src="/Coursework/Coursework-1/Pictures/'.$row["Picfront"].'" class="img-fluid"></div>');

                // Second column: back image of the item
                echo('<div class="col-lg-4"><img src="/Coursework/Coursework-1/Pictures/'.$row["Picback"].'" class="img-fluid"></div>');

                // Third column: details and form
                echo('<div class="col-lg-4">');

                    // Item name and price, aligned to the right
                    echo('<div class="text-end">');
                        echo('<h1 class="fw-bolder">'.$row["Itemname"].'</h1>');
                        echo('<h2>£'.$row["Itemcost"].'</h2>');
                    echo('</div>');

                    // Start of add-to-basket form
                    echo('<div>');
                    echo('<form action="addtobasket.php" method="post">');

                    // Hidden input to pass the item ID to the form
                    echo('<input type="hidden" name="ItemID" value ="'.$row["ItemID"].'">');

                    // --- Size Selection ---
                    echo('<div>');
                        echo('<p><b>Size</b></p>');

                        // Array of available sizes
                        $sizes = ["XXL", "XL", "L", "M", "S", "XS", "XXS"];
                        $first = true; // Used to auto-check the first size option

                        // Create radio buttons styled as Bootstrap buttons
                        foreach ($sizes as $size) {
                            $id = "size_" . $size;

                            // Radio input with .btn-check (Bootstrap toggle styling)
                            echo('<input type="radio" class="btn-check" name="SelectedSize" id="'.$id.'" value="'.$size.'" autocomplete="off" '.($first ? 'checked' : '').' required>');

                            // Matching label for the button (toggle effect)
                            echo('<label class="btn btn-outline-dark me-1 mb-1" style="border-radius: 0;" for="'.$id.'">'.$size.'</label>');

                            $first = false; // Only the first button should be checked
                        }

                    echo('</div>');

                    // --- Quantity Selection ---
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

                    // Submit button - styled to stretch across the container
                    echo('<button type="submit" class="btn btn-dark mt-3 fw-bolder w-100" style="border-radius: 0;">Add to Basket</button>');
                    echo('</form>');

                    // --- Item Description ---
                    echo('<div>');
                        echo('<br><p><b>Description</b></p>');
                        echo($row['Itemdescription']); // Display the item description
                    echo('</div>');

                echo('</div>'); // End of third column
            echo('</div>'); // End of row
        echo('</div>'); // End of container
    }
    ?>

</body>
</html>