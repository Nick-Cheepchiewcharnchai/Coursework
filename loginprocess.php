<?php

include_once ("connection.php");

array_map("htmlspecialchars", $_POST);

$stmt = $conn->prepare("SELECT * FROM tblusers WHERE Username =:username;");

$stmt->bindParam(':username', $_POST["username"]);

$stmt->execute();

#HASH THE PASSWORD

while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{ 
    if($row['Password']== $_POST['passwd']){
        header('Location: homepage.php');
    }else{
        header('Location: login.php');
    }
}
header('Location: user.php');

$conn=null;
?>
