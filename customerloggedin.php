<?php

    session_start(); 

    // Check if the user is not logged in (i.e., 'name' is not set in session)
    if (!isset($_SESSION['name'])) {
        // If not logged in, redirect them to the login page
        header("Location:login.php");
    } else {
        // If logged in, include the database connection file
        include_once("connection.php");

        // SQL query to retrieve the user's Authority level from the database
        $stmt = $conn->prepare("SELECT Authority FROM tblusers WHERE UserID = :UserID");
        $stmt->bindParam(':UserID', $_SESSION['name']);
        $stmt->execute();

        // Fetch the result row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // If a matching user was found
        if ($row) {
            // If the user's Authority level is 1 (aa admin)
            if ($row['Authority'] == 1) {
                // Redirect them to the admin homepage
                header("Location:adminhomepage.php");
            }
        }
    }
    
?>