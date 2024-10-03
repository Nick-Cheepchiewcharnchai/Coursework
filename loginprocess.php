<?php

include_once ("connection.php");

array_map("htmlspecialchars", $_POST);

$stmt = $conn->prepare("SELECT * FROM tblusers");
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{ 
    if($row['Password']== $_POST['Pword']){
        header('Location: homepage.php');
    }else{

        header('Location: login.php');
    }
}
$conn=null;
?>
