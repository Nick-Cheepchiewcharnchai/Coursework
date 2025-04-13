<?php

session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    include_once("connection.php");

    $stmt = $conn->prepare("SELECT BasketID FROM tblBaskets WHERE UserID = :UserID AND IsOrdered = 0;");
    
    $stmt->bindParam(':UserID', $_SESSION['name']);
    
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($row) {
        echo($row["BasketID"]);
    }

} catch (PDOException $e) {

    echo "error" . $e->getMessage();
}

$conn = null;

//header('Location:homepage.php');

?>