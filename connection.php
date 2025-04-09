<?php
// Sets the hostname for the MySQL database server
$servername = "localhost";

// Sets the username used to access the database
$username = "root";

// Sets the password used to access the database
$password = "";

// Specifies the name of the database to connect to
$dbname = "CrosbyMerch";

try {
    // Creates a new PDO object to connect to the database using the provided credentials
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // Configures the PDO connection to throw exceptions if an error occurs
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    // Retrieves the error message if the connection fails
    $e->getMessage();
}
?>