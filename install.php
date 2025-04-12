<?php

include_once("connection.php");

$stmt = $conn->prepare("DROP TABLE IF EXISTS Tblusers;
CREATE TABLE Tblusers 
(UserID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
Firstname VARCHAR(30) NOT NULL,
Lastname VARCHAR(30) NOT NULL,
Username VARCHAR(40) NOT NULL,
Password VARCHAR(250) NOT NULL,
Authority TINYINT(1))");
$stmt->execute();
$stmt->closeCursor();

$stmt = $conn->prepare("DROP TABLE IF EXISTS TblItems;
CREATE TABLE Tblitems 
(ItemID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
Itemname VARCHAR(30) NOT NULL,
Itemdescription VARCHAR(500),
Itemtype VARCHAR(1) NOT NULL,
Itemcost DECIMAL(5,2) NOT NULL,
Picfront VARCHAR(255) NOT NULL,
Picback VARCHAR(255) NOT NULL)");
$stmt->execute();
$stmt->closeCursor();

$stmt = $conn->prepare("DROP TABLE IF EXISTS TblBaskets;
CREATE TABLE TblBaskets 
(BasketID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
UserID INT(4) UNSIGNED NOT NULL,
IsOrdered TINYINT(1) DEFAULT 0)");
$stmt->execute();
$stmt->closeCursor();

$stmt = $conn->prepare("DROP TABLE IF EXISTS TblBasketItems;
CREATE TABLE TblBasketItems
(BasketItemID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
BasketID INT(4) UNSIGNED NOT NULL,
ItemID INT(4) UNSIGNED NOT NULL,
ItemSize VARCHAR(3) NOT NULL,
Quantity INT(1) NOT NULL)");
$stmt->execute();
$stmt->closeCursor();

$stmt = $conn->prepare("DROP TABLE IF EXISTS TblOrders;
CREATE TABLE TblOrders
(OrderID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
UserID INT(4) UNSIGNED NOT NULL,
BasketID INT(4) UNSIGNED NOT NULL,
Status VARCHAR(11) DEFAULT 'Unprocessed',
TotalCost DECIMAL(6,2) NOT NULL)");
$stmt->execute();
$stmt->closeCursor();

?>
