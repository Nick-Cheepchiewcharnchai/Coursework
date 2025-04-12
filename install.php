<?php

include_once("connection.php");

$stmt = $conn->prepare("DROP TABLE IF EXISTS TblUsers;
CREATE TABLE TblUsers 
(UserID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
Firstname VARCHAR(30) NOT NULL,
Lastname VARCHAR(30) NOT NULL,
Username VARCHAR(40) NOT NULL,
Password VARCHAR(250) NOT NULL,
Authority TINYINT(1))");
$stmt->execute();
$stmt->closeCursor();

//inserting user and admin data into the table
$stmt = $conn->prepare("INSERT INTO TblUsers(Firstname, Lastname, Username, Password, Authority)
VALUES('Nick', 'Cheepchiewcharnchai', 'Cheepchiewcharnch.k', :upassword, 0),
      ('Admin', 'Install', 'admin', :apassword, 1)");

$hashed_upassword = password_hash("1234", PASSWORD_DEFAULT);
$stmt->bindParam(':upassword', $hashed_upassword);

$hashed_apassword = password_hash("admin", PASSWORD_DEFAULT);
$stmt->bindParam(':apassword', $hashed_apassword);
$stmt->execute();

$stmt = $conn->prepare("DROP TABLE IF EXISTS TblItems;
CREATE TABLE TblItems 
(ItemID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
Itemname VARCHAR(30) NOT NULL,
Itemdescription VARCHAR(500),
Itemtype VARCHAR(1) NOT NULL,
Itemcost DECIMAL(5,2) NOT NULL,
Picfront VARCHAR(255) NOT NULL,
Picback VARCHAR(255) NOT NULL)");
$stmt->execute();
$stmt->closeCursor();

//inserting items data into the table
$stmt = $conn->prepare("INSERT INTO TblItems(Itemname, Itemdescription, Itemtype, Itemcost, Picfront, Picback)
VALUES('Item 1', 'The first item', 'T', 10.00, '1-front.jpg', '1-back.jpg'),
      ('Item 2', 'The second item', 'T', 25.00, '2-front.jpg', '2-back.jpg'),
      ('Item 3', 'The third item', 'B', 50.00, '3-front.jpg', '3-back.jpg'),
      ('Item 4', 'The fourth item', 'A', 100.00, '4-front.jpg', '4-back.jpg'),
      ('Item 5', 'The fifth item', 'O', 199.99, '5-front.jpg', '5-back.jpg')");
$stmt->execute();

$stmt = $conn->prepare("DROP TABLE IF EXISTS TblBaskets;
CREATE TABLE TblBaskets 
(BasketID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
UserID INT(4) UNSIGNED NOT NULL,
IsOrdered TINYINT(1) DEFAULT 0)");
$stmt->execute();
$stmt->closeCursor();

//creating basket for the test accounts
$stmt = $conn->prepare("INSERT INTO TblBaskets(BasketID, UserID)
VALUES(1, 1),
      (2, 2)");
$stmt->execute();

$stmt = $conn->prepare("DROP TABLE IF EXISTS TblBasketItems;
CREATE TABLE TblBasketItems
(BasketItemID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
BasketID INT(4) UNSIGNED NOT NULL,
ItemID INT(4) UNSIGNED NOT NULL,
ItemSize VARCHAR(3) NOT NULL,
Quantity INT(1) NOT NULL)");
$stmt->execute();
$stmt->closeCursor();

?>
