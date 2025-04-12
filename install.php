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

//inserting user and admin data into the table
$stmt = $conn->prepare("INSERT INTO Tblusers(Firstname, Lastname, Username, Password, Authority)
VALUES('Nick', 'Cheepchiewcharnchai', 'Cheepchiewcharnch.k', :upassword, 0),
      ('Admin', 'Install', 'admin', :apassword, 1)");

$hashed_upassword = password_hash("1234", PASSWORD_DEFAULT);
$stmt->bindParam(':upassword', $hashed_upassword);

$hashed_apassword = password_hash("admin", PASSWORD_DEFAULT);
$stmt->bindParam(':apassword', $hashed_apassword);
$stmt->execute();

?>
