<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Location:items.php');

try{
    include_once("connection.php");

    $stmt = $conn->prepare("INSERT INTO tblitems (ItemID,Itemname,Itemdescription,Itemtype,Itemcost)VALUES (null,:itemname,:itemdescription,:itemtype,:itemcost)");

    $stmt->bindParam(':itemname', $_POST["itemname"]);
    $stmt->bindParam(':itemdescription', $_POST["itemdescription"]);
    $stmt->bindParam(':itemtype', $_POST["itemtype"]);
    $stmt->bindParam(':itemcost', $_POST["itemcost"]);
    $stmt->execute();
}

catch(PDOException $e)
	{
		echo "error".$e->getMessage();
	}

$conn=null;

echo $_POST["itemname"]."<br>";
echo $_POST["itemdescription"]."<br>";
echo $_POST["itemtype"]."<br>";
echo $_POST["itemcost"]."<br>";


?>