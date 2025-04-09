<?php

session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try{
    include_once("connection.php");

    $stmt = $conn->prepare("UPDATE tblorders SET Status = 'Processed' WHERE BasketID = :BasketID");

    $stmt->bindParam(':BasketID', $_POST["BasketID"]);
    echo($_POST["BasketID"]);

    $stmt->execute();
}

catch(PDOException $e)
	{
		echo "error".$e->getMessage();
	}

$conn=null;

header('Location:unprocessed.php');

?>