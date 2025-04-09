<?php

// Start a session to track user login and other session-related information
session_start();

// Enable error reporting for development purposes (it will display all errors)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Try block to handle database operations and avoid crashes due to errors
try {
    // Include the database connection file to get access to the $conn variable for database queries
    include_once("connection.php");

    // Prepare a SQL statement to update the order status to 'Processed'
    $stmt = $conn->prepare("UPDATE tblorders SET Status = 'Processed' WHERE BasketID = :BasketID");

    // Bind the :BasketID parameter in the SQL statement to the BasketID sent via POST
    $stmt->bindParam(':BasketID', $_POST["BasketID"]);

    // Execute the update query to mark the order as 'Processed'
    $stmt->execute();

    // Prepare a second SQL statement to retrieve details about the order and the user associated with it
    $stmt2 = $conn->prepare("SELECT * FROM tblorders INNER JOIN tblusers ON tblorders.UserID = tblusers.UserID WHERE tblorders.BasketID = :BasketID");
    
    // Bind the :BasketID parameter to the POST value of BasketID
    $stmt2->bindParam(':BasketID', $_POST["BasketID"]);

    // Execute the select query to get order and user details
    $result = $stmt2->execute();

    // If the result of the query is successful, fetch the user's details and redirect
    if ($result) {
        $row = $stmt2->fetch(PDO::FETCH_ASSOC);
        
        // Redirect to the 'accountorders.php' page, passing the UserID and the user's full name as parameters in the URL
        // This will allow the admin to view the user's order details
        header('Location:accountorders.php?AOID='.$row["UserID"].'>'.$row["Firstname"].' '.$row["Lastname"]);
    }
} 
// Catch block to handle any PDO exceptions (e.g., if the database query fails)
catch(PDOException $e) {
    // Output the error message if an exception is caught
    echo "error" . $e->getMessage();
}

// Close the database connection to free up resources
$conn = null;

?>