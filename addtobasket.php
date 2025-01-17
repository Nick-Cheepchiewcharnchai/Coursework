<?php

session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try{
    include_once("connection.php");

    $stmt = $conn->prepare("SELECT BasketID FROM tblBasket WHERE UserID = :UserID;");

    $stmt->bindParam(':UserID', $_SESSION['name']);
    #echo($_SESSION['name']);
    #echo($_POST["ItemID"]);
    #echo($_POST["SelectedSize"]);
    #echo($_POST["SelectedQuantity"]);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($row){
        $insertStmt = $conn->prepare("INSERT INTO tblBasketItems (BasketItemID,BasketID,ItemID,ItemSize,Quantity)VALUES (null,:BasketID,:ItemID,:SelectedSize,:SelectedQuantity)");
        
        $insertStmt->bindParam(':BasketID', $row["BasketID"]);
        $insertStmt->bindParam(':ItemID', $_POST["ItemID"]);
        $insertStmt->bindParam(':SelectedSize', $_POST["SelectedSize"]);
        $insertStmt->bindParam(':SelectedQuantity', $_POST["SelectedQuantity"]);
        #echo($row["BasketID"]);
        #echo($_POST["ItemID"]);
        #echo($_POST["SelectedSize"]);
        #echo($_POST["SelectedQuantity"]);
        $insertStmt->execute();
    }

}

catch(PDOException $e)
	{
		echo "error".$e->getMessage();
	}

$conn=null;

header('Location:homepage.php');

?>