<?php

// Start the session to manage user data across pages
session_start();

// Enable error reporting to display all errors for debugging purposes
ini_set('display_errors', 1);  // Display all errors
ini_set('display_startup_errors', 1);  // Display startup errors
error_reporting(E_ALL);  // Report all types of errors

try {
    // Include the database connection file to access the database
    include_once("connection.php");

    // Prepare an SQL query to update the 'Status' of the order identified by BasketID to 'Processed'
    $stmt = $conn->prepare("UPDATE tblorders SET Status = 'Processed' WHERE BasketID = :BasketID");

    // Bind the BasketID from the POST data to the prepared statement to prevent SQL injection
    $stmt->bindParam(':BasketID', $_POST["BasketID"]);
    
    // Debugging step: print the BasketID to ensure it's received correctly
    echo($_POST["BasketID"]);

    // Execute the SQL query to update the order status
    $stmt->execute();
} catch(PDOException $e) {
    // If an exception is caught (e.g., database error), display the error message
    echo "error" . $e->getMessage();
}

// Close the database connection to free up resources
$conn = null;

// Redirect the user back to the 'unprocessed.php' page to show the updated list of orders
header('Location: unprocessed.php');
?>