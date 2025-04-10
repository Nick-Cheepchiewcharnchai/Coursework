<?php
// Starts a new session or resumes the current session to store session variables
session_start();

// Includes the connection script to connect to the database
include_once("connection.php");

// Sanitizes the input data using htmlspecialchars to prevent XSS (cross-site scripting)
array_map("htmlspecialchars", $_POST);

// Prepares a SQL query to fetch a user from the 'tblusers' table by their username
$stmt = $conn->prepare("SELECT * FROM tblusers WHERE Username = :username;");

// Binds the provided username from the POST request to the :username parameter in the SQL query
$stmt->bindParam(':username', $_POST["username"]);

// Executes the prepared statement
$stmt->execute();

// Fetches the results as an associative array
$row = $stmt->fetch(PDO::FETCH_ASSOC);

// If no user is found with the provided username, sets a session for a message to be displayed before redirecting back to the login page
if (!$row){
    $_SESSION['usernamemessage'] = 'Incorrect username, please try again';
    header('Location: login.php');
}else{
    // Retrieves the hashed password stored in the database
    $hashed = $row['Password'];
    
    // Retrieves the password entered by the user during login
    $attempt = $_POST['passwd'];
    
    // Verifies if the entered password matches the hashed password in the database
    if(password_verify($attempt, $hashed)){
        // Sets the session variable 'name' to the user's ID for future reference
        $_SESSION['name'] = $row["UserID"];
        
        // If the user has admin authority (Authority = 1), redirects to the admin homepage
        if($row['Authority'] == 1){
            header('Location: adminhomepage.php');
        }else{
            // If the user is not an admin, redirects to the regular homepage
            header('Location: homepage.php');
        }
    }else{
        // If the password verification fails, sets a session for a message to be displayed before redirecting back to the login page
        $_SESSION['passwordmessage'] = 'Incorrect password, please try again';
        echo($_SESSION['passwordmessage']);
        header('Location: login.php');
    }
}

// Closes the database connection
$conn = null;
?>