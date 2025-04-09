<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try{
	include_once("connection.php");
	array_map("htmlspecialchars", $_POST);

	$stmt = $conn->prepare("SELECT BasketID FROM tblbasket WHERE UserID = :UserID AND IsOrdered = '1'");
	$stmt->bindParam(':UserID', $_POST["UserID"]);
	$stmt->execute();
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		$deleteStmt = $conn->prepare("DELETE FROM tblbasketitems WHERE BasketID = ".$row['BasketID']);
		$deleteStmt->execute();
	}

	$stmt1 = $conn->prepare("DELETE tblorders FROM tblorders INNER JOIN tblusers ON tblorders.UserID = tblusers.UserID WHERE tblorders.UserID = :UserID");
	$stmt1->bindParam(':UserID', $_POST["UserID"]);
	$stmt1->execute();

	$stmt2 = $conn->prepare("DELETE tblbasket FROM tblbasket INNER JOIN tblusers ON tblbasket.UserID = tblusers.UserID WHERE tblbasket.UserID = :UserID");
	$stmt2->bindParam(':UserID', $_POST["UserID"]);
	$stmt2->execute();

	$stmt3 = $conn->prepare("DELETE FROM tblusers WHERE UserID = :UserID");
	$stmt3->bindParam(':UserID', $_POST["UserID"]);
	$stmt3->execute();
}

catch(PDOException $e)
	{
		echo "error".$e->getMessage();
	}

$conn=null;

header('Location:removeusers.php');

?>