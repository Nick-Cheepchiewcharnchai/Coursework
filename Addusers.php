<?php

header('Location:users.php');



include_once("connection.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

switch($_POST["authority"]){
	case "User":
		$authority=0;
		break;
	case "Admin":
		$authority=1;
		break;
}

$stmt = $conn->prepare("INSERT INTO tblusers (UserID,Firstname,Lastname,Username,Password,Authority)VALUES (null,:firstname,:lastname,:username,:password,:authority)");

$stmt->bindParam(':firstname', $_POST["firstname"]);
$stmt->bindParam(':lastname', $_POST["lastname"]);
$stmt->bindParam(':username', $_POST["username"]);
$stmt->bindParam(':password', $_POST["passwd"]);
$stmt->bindParam(':authority', $authority);
$stmt->execute();
$conn=null;

echo $_POST["firstname"]."<br>";
echo $_POST["lastname"]."<br>";
echo $_POST["username"]."<br>";
echo $_POST["passwd"]."<br>";
echo $_POST["authority"]."<br>";

?>