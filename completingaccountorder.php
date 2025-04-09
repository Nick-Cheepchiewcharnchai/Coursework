<?php

session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try{
    include_once("connection.php");

    $stmt = $conn->prepare("UPDATE tblorders SET Status = 'Completed' WHERE BasketID = :BasketID");

    $stmt->bindParam(':BasketID', $_POST["BasketID"]);
    #echo($_POST["BasketID"]);

    $stmt->execute();

    $stmt2 = $conn->prepare("SELECT * FROM tblorders INNER JOIN tblusers ON tblorders.UserID = tblusers.UserID WHERE tblorders.BasketID = :BasketID");
    
    $stmt2->bindParam(':BasketID', $_POST["BasketID"]);
    #echo($_POST["BasketID"]);

    $result = $stmt2->execute();

    if($result){
        $row = $stmt2->fetch(PDO::FETCH_ASSOC);
        header('Location:accountorders.php?AOID='.$row["UserID"].'>'.$row["Firstname"].' '.$row["Lastname"]);
    }
}

    catch(PDOException $e)
	{
		echo "error".$e->getMessage();
	}

$conn=null;

?>