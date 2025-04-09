<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try{
	include_once("connection.php");
	array_map("htmlspecialchars", $_POST);

	switch($_POST["authority"]){
		case "User":
			$authority=0;
			break;
		case "Admin":
			$authority=1;
			break;
	}

	$stmt = $conn->prepare("INSERT INTO tblusers (UserID,Firstname,Lastname,Username,Password,Authority)VALUES (null,:firstname,:lastname,:username,:password,:authority)");

    $hashed_password = password_hash($_POST["passwd"], PASSWORD_DEFAULT);
	
	$stmt->bindParam(':firstname', $_POST["firstname"]);
	$stmt->bindParam(':lastname', $_POST["lastname"]);
	$stmt->bindParam(':username', $_POST["username"]);
	$stmt->bindParam(':password', $hashed_password);
	$stmt->bindParam(':authority', $authority);
	$stmt->execute();

	$stmt2 = $conn->prepare("SELECT UserID FROM tblusers WHERE Username = :username");
	$stmt2->bindParam(':username', $_POST["username"]);
	$stmt2->execute();
	$row = $stmt2->fetch(PDO::FETCH_ASSOC);

	if($row) {
		$insertStmt = $conn->prepare("INSERT INTO tblbasket (BasketID,UserID,IsOrdered)VALUES (null,:UserID,0)");
		
		$insertStmt->bindParam(':UserID', $row["UserID"]);
		$insertStmt->execute();
	}
}

catch(PDOException $e)
	{
		echo "error".$e->getMessage();
	}

$conn=null;

header('Location:addusers.php');

?>