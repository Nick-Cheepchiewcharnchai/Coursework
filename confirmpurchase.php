<?php

session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try{
    include_once("connection.php");

    $stmt = $conn->prepare("INSERT INTO tblOrders (OrderID,UserID,BasketID,Totalcost)VALUES (null,:UserID,:BasketID,:Totalcost)");

    $stmt->bindParam(':UserID', $_SESSION['name']);
    $stmt->bindParam(':Totalcost', $_SESSION['total']);
    $stmt->bindParam(':BasketID', $_SESSION['basket']);

    $stmt->execute();

    $stmt2 = $conn->prepare("UPDATE tblBasket SET IsOrdered = 1 WHERE BasketID = :BasketID");

    $stmt2->bindParam(':BasketID', $_SESSION['basket']);

    $stmt2->execute();

    $stmt3 = $conn->prepare("INSERT INTO tblbasket (BasketID,UserID,IsOrdered)VALUES (null,:UserID,0)");

    $stmt3->bindParam(':UserID', $_SESSION['name']);

    $stmt3->execute();
}

catch(PDOException $e)
	{
		echo "error".$e->getMessage();
	}

$conn=null;

header('Location:purchases.php');

?>