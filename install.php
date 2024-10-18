<?php

include_once("connection.php");

$stmt = $conn->prepare("DROP TABLE IF EXISTS Tblusers;
CREATE TABLE Tblusers 
(UserID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
Firstname VARCHAR(30) NOT NULL,
Lastname VARCHAR(30) NOT NULL,
Username VARCHAR(40) NOT NULL,
Password VARCHAR(200) NOT NULL,
Role TINYINT(1))");
$stmt->execute();
$stmt->closeCursor();

$stmt = $conn->prepare("DROP TABLE IF EXISTS TblItems;
CREATE TABLE Tblitems 
(ItemID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
Itemname VARCHAR(30) NOT NULL,
Itemdescription VARCHAR(500),
Itemtype VARCHAR(1) NOT NULL,
Itemcost FLOAT(5,2) NOT NULL,");
$stmt->execute();
$stmt->closeCursor();

?>
