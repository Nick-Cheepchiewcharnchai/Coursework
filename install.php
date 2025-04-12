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

?>
