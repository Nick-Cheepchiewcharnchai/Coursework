<?php

ini_set('display_errors', 1);  // Enable error reporting for display
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);  // Report all errors

try {
    include_once("connection.php");  // Include the database connection
    array_map("htmlspecialchars", $_POST);  // Sanitize POST data

    // Prepare a statement to fetch BasketID for the user with IsOrdered = 1
    $stmt = $conn->prepare("SELECT BasketID FROM tblbaskets WHERE UserID = :UserID AND IsOrdered = '1'");
    $stmt->bindParam(':UserID', $_POST["UserID"]);  // Bind UserID from POST data
    $stmt->execute();  // Execute the query

    // Loop through the results and delete associated basket items
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Prepare the statement to delete items from tblbasketitems
        $deleteStmt = $conn->prepare("DELETE FROM tblbasketitems WHERE BasketID = " . $row['BasketID']);
        $deleteStmt->execute();  // Execute the delete query
    }

    // Delete the user's orders from tblorders by joining tblusers on UserID
    $stmt1 = $conn->prepare("DELETE tblorders FROM tblorders INNER JOIN tblusers ON tblorders.UserID = tblusers.UserID WHERE tblorders.UserID = :UserID");
    $stmt1->bindParam(':UserID', $_POST["UserID"]);  // Bind UserID from POST data
    $stmt1->execute();  // Execute the delete query

    // Delete the user's basket from tblbaskets by joining tblusers on UserID
    $stmt2 = $conn->prepare("DELETE tblbaskets FROM tblbaskets INNER JOIN tblusers ON tblbaskets.UserID = tblusers.UserID WHERE tblbaskets.UserID = :UserID");
    $stmt2->bindParam(':UserID', $_POST["UserID"]);  // Bind UserID from POST data
    $stmt2->execute();  // Execute the delete query

    // Finally, delete the user from tblusers table
    $stmt3 = $conn->prepare("DELETE FROM tblusers WHERE UserID = :UserID");
    $stmt3->bindParam(':UserID', $_POST["UserID"]);  // Bind UserID from POST data
    $stmt3->execute();  // Execute the delete query
}
catch (PDOException $e) {
    echo "error" . $e->getMessage();  // Catch and display any errors
}

$conn = null;  // Close the database connection

header('Location:removeaccounts.php');  // Redirect to the page where users are removed
?>