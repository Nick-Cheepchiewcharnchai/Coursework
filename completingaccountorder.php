<?php

// Start a session to manage user session data
session_start();

// Enable error reporting for debugging purposes
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    // Include the connection file to establish a connection to the database
    include_once("connection.php");

    // Prepare an SQL statement to update the status of the order to 'Completed' based on the BasketID
    $stmt = $conn->prepare("UPDATE tblorders SET Status = 'Completed' WHERE BasketID = :BasketID");

    // Bind the BasketID from the POST request to the SQL query
    $stmt->bindParam(':BasketID', $_POST["BasketID"]);
    // Debugging: echo($_POST["BasketID"]);

    // Execute the query to update the order status
    $stmt->execute();

    // Prepare another SQL query to fetch details about the order and its associated user
    $stmt2 = $conn->prepare("SELECT * FROM tblorders INNER JOIN tblusers ON tblorders.UserID = tblusers.UserID WHERE tblorders.BasketID = :BasketID");
    
    // Bind the BasketID from the POST request to this second query
    $stmt2->bindParam(':BasketID', $_POST["BasketID"]);
    // Debugging: echo($_POST["BasketID"]);

    // Execute the second query to fetch the result
    $result = $stmt2->execute();

    // Check if the query execution is successful
    if ($result) {
        // Fetch the user details from the result of the second query
        $row = $stmt2->fetch(PDO::FETCH_ASSOC);
        
        // Redirect to the 'accountorders.php' page with parameters for UserID, Firstname, and Lastname
        // The URL parameter 'AOID' is passed along with the user's ID and name
        header('Location:accountorders.php?AOID=' . $row["UserID"] . '>' . $row["Firstname"] . ' ' . $row["Lastname"]);
    }
} catch (PDOException $e) {
    // Catch any PDO exceptions and display an error message if something goes wrong
    echo "error" . $e->getMessage();
}

// Close the database connection
$conn = null;

?>