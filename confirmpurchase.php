<?php

// Start the session to access session variables
session_start();

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try{
    // Include the database connection file
    include_once("connection.php");

    // Prepare the SQL query to insert a new order into the tblOrders table
    $stmt = $conn->prepare("INSERT INTO tblOrders (OrderID, UserID, BasketID, Totalcost) VALUES (null, :UserID, :BasketID, :Totalcost)");

    // Bind the session variables to the query parameters
    $stmt->bindParam(':UserID', $_SESSION['name']);
    $stmt->bindParam(':Totalcost', $_SESSION['total']);
    $stmt->bindParam(':BasketID', $_SESSION['basket']);

    // Execute the query to insert the order data into the database
    $stmt->execute();

    // Prepare the SQL query to update the tblBasket table, setting IsOrdered to 1 for the current basket
    $stmt2 = $conn->prepare("UPDATE tblBasket SET IsOrdered = 1 WHERE BasketID = :BasketID");

    // Bind the BasketID session variable to the query parameter
    $stmt2->bindParam(':BasketID', $_SESSION['basket']);

    // Execute the query to update the basket status
    $stmt2->execute();

    // Prepare the SQL query to insert a new basket for the user (set IsOrdered to 0)
    $stmt3 = $conn->prepare("INSERT INTO tblbasket (BasketID, UserID, IsOrdered) VALUES (null, :UserID, 0)");

    // Bind the UserID session variable to the query parameter
    $stmt3->bindParam(':UserID', $_SESSION['name']);

    // Execute the query to create a new basket for the user
    $stmt3->execute();
}

catch(PDOException $e)
{
    // If there's an error, catch the exception and display the error message
    echo "error" . $e->getMessage();
}

// Close the database connection
$conn = null;

// Redirect the user to the 'purchases.php' page after successful order placement
header('Location: purchases.php');

?>