<?php

// Enable error reporting to help debug any issues during development
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    // Include database connection file
    include_once("connection.php");

    // Sanitize user input using htmlspecialchars to prevent XSS attacks
    array_map("htmlspecialchars", $_POST);

    // Switch case to determine the authority level of the user based on the form submission
    switch($_POST["authority"]) {
        case "User":
            $authority = 0;  // 0 represents a regular user
            break;
        case "Admin":
            $authority = 1;  // 1 represents an admin user
            break;
    }

    // Prepare the SQL query to insert a new user into the 'tblusers' table
    $stmt = $conn->prepare("INSERT INTO tblusers (UserID, Firstname, Lastname, Username, Password, Authority) VALUES (null, :firstname, :lastname, :username, :password, :authority)");

    // Hash the password before storing it in the database for security
    $hashed_password = password_hash($_POST["passwd"], PASSWORD_DEFAULT);

    // Bind the user input values to the prepared statement parameters
    $stmt->bindParam(':firstname', $_POST["firstname"]);
    $stmt->bindParam(':lastname', $_POST["lastname"]);
    $stmt->bindParam(':username', $_POST["username"]);
    $stmt->bindParam(':password', $hashed_password);
    $stmt->bindParam(':authority', $authority);

    // Execute the query to insert the new user into the database
    $stmt->execute();

    // After inserting the user, retrieve the UserID based on the username to associate them with a basket
    $stmt2 = $conn->prepare("SELECT UserID FROM tblusers WHERE Username = :username");
    $stmt2->bindParam(':username', $_POST["username"]);
    $stmt2->execute();
    $row = $stmt2->fetch(PDO::FETCH_ASSOC);

    // If a valid user is found, create a new basket for that user
    if ($row) {
        // Prepare the SQL query to insert a new basket for the user
        $insertStmt = $conn->prepare("INSERT INTO tblbasket (BasketID, UserID, IsOrdered) VALUES (null, :UserID, 0)");

        // Bind the UserID retrieved from the previous query to the basket insertion statement
        $insertStmt->bindParam(':UserID', $row["UserID"]);

        // Execute the query to create the basket
        $insertStmt->execute();
    }

} catch(PDOException $e) {
    // Catch any exceptions and display the error message
    echo "Error: " . $e->getMessage();
}

// Close the database connection
$conn = null;

// Redirect the user back to the add user page after the operation is completed
header('Location:addusers.php');
?>