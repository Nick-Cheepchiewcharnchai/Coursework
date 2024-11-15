<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Location:items.php');

try{
    include_once("connection.php");

    $stmt = $conn->prepare("INSERT INTO tblitems (ItemID,Itemname,Itemdescription,Itemtype,Itemcost,Picfront,Picback)VALUES (null,:itemname,:itemdescription,:itemtype,:itemcost,:picfront,:picback)");

    $stmt->bindParam(':itemname', $_POST["itemname"]);
    $stmt->bindParam(':itemdescription', $_POST["itemdescription"]);
    $stmt->bindParam(':itemtype', $_POST["itemtype"]);
    $stmt->bindParam(':itemcost', $_POST["itemcost"]);
    $stmt->bindParam(':picfront', $_FILES["picfront"]["name"]);
    $stmt->bindParam(':picback', $_FILES["picback"]["name"]);
    $stmt->execute();

    $target_dir = "Pictures/";
    print_r($_FILES);
    $target_file = $target_dir . basename($_FILES["picfront"]["name"]);
    echo $target_file;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if (move_uploaded_file($_FILES["picfront"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["picfront"]["name"])). " has been uploaded.";
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    
    $target_file = $target_dir . basename($_FILES["picback"]["name"]);
    echo $target_file;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if (move_uploaded_file($_FILES["picback"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["picback"]["name"])). " has been uploaded.";
      } else {
        echo "Sorry, there was an error uploading your file.";
      }

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