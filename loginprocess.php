<?php

include_once ("connection.php");

array_map("htmlspecialchars", $_POST);

$stmt = $conn->prepare("SELECT * FROM tblusers WHERE Username = :username;");

$stmt->bindParam(':username', $_POST["username"]);

$stmt->execute();
  
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$row){
    header('Location: login.php');
}else{
    $hashed = $row['Password'];
    $attempt = $_POST['passwd'];
    if(password_verify($attempt,$hashed)){
        if($row['Authority'] == 1){
            header('Location: homepage.php');
        }else{
            header('Location: basket.php');
        }
    }else{
        header('Location: login.php');
    }
}

$conn=null;
?>