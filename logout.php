<?php
// Starts the session to access session variables
session_start();

// Checks if the session variable 'name' is set (i.e., the user is logged in)
if(isset($_SESSION['name'])){
    // Unsets the session variable 'name' to log the user out
    unset($_SESSION['name']);
}

// Redirects the user to the login page after logging out
header("Location: login.php");
?>