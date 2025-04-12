<?php

// Start a session to track user data and shopping basket
session_start();

// Enable error reporting for debugging (only in development, should be turned off in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    // Include the database connection file to interact with the database
    include_once("connection.php");

    // Prepare an SQL query to check if there is an existing basket for the logged-in user
    $stmt = $conn->prepare("SELECT BasketID FROM tblBaskets WHERE UserID = :UserID AND IsOrdered = 0;");
    
    // Bind the user ID from the session to the query
    $stmt->bindParam(':UserID', $_SESSION['name']);
    
    // Execute the query to fetch the basket ID for the current user (only baskets that are not ordered)
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the result
    
    // If the user has an existing basket (basket exists and is not ordered), insert the item into the basket
    if ($row) {
        // Prepare an SQL query to insert the selected item into the tblBasketItems table
        $insertStmt = $conn->prepare("INSERT INTO tblBasketItems (BasketItemID,BasketID,ItemID,ItemSize,Quantity)VALUES (null,:BasketID,:ItemID,:SelectedSize,:SelectedQuantity)");
        
        // Bind the parameters for the insert query (BasketID, ItemID, ItemSize, SelectedQuantity)
        $insertStmt->bindParam(':BasketID', $row["BasketID"]);
        $insertStmt->bindParam(':ItemID', $_POST["ItemID"]);
        $insertStmt->bindParam(':SelectedSize', $_POST["SelectedSize"]);
        $insertStmt->bindParam(':SelectedQuantity', $_POST["SelectedQuantity"]);
        
        // Execute the insert statement to add the item to the user's basket
        $insertStmt->execute();
    }

} catch (PDOException $e) {
    // If there is an error, display the error message
    echo "error" . $e->getMessage();
}

// Close the database connection
$conn = null;

// Redirect the user back to the homepage after adding the item to the basket
header('Location:homepage.php');

?>