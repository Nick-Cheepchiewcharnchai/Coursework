<?php
// Sets the hostname for the MySQL database server
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "CrosbyMerch";

try {
    // Creates a new PDO object to connect to the database using the provided credentials
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // Configures the PDO connection to throw exceptions if an error occurs
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    //echo("Connected successfully");

} catch(PDOException $e) {
    // Retrieves the error message if the connection fails
    //echo("Connection failed: ");
    $e->getMessage();
}
?>