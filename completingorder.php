<?php

// Start the session to keep track of session variables (useful for managing login status, etc.)
session_start();

// Enable error reporting for debugging. This is helpful during development to track issues.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); // Report all types of errors, warnings, and notices

try{
    // Include the database connection file to access the database. 
    // This file should contain the logic to establish the $conn (database connection).
    include_once("connection.php");

    // Prepare the SQL statement to update the order status in the database.
    // It updates the 'Status' field of the tblorders table, setting it to 'Completed' 
    // where the BasketID matches the given value.
    $stmt = $conn->prepare("UPDATE tblorders SET Status = 'Completed' WHERE BasketID = :BasketID");

    // Bind the value of BasketID from the POST request to the SQL query. This prevents SQL injection.
    $stmt->bindParam(':BasketID', $_POST["BasketID"]);
    
    // For debugging purposes: Display the BasketID that was passed in the POST request.
    echo($_POST["BasketID"]);

    // Execute the prepared statement to run the SQL query and update the status in the database.
    $stmt->execute();
}
catch(PDOException $e)
{
    // If an error occurs during the execution of the query, catch it and display the error message.
    echo "error".$e->getMessage();
}

// Close the database connection after the operation is completed.
$conn=null;

// After the operation is successful, redirect the user to the 'processed.php' page.
header('Location:processed.php');

?>