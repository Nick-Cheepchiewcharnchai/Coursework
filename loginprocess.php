<?php

session_start();

include_once("connection.php");

array_map("htmlspecialchars", $_POST);

$stmt = $conn->prepare("SELECT * FROM tblusers WHERE Username = :username;");
$stmt->bindParam(':username', $_POST["username"]);
$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$row){
    echo("wrong username");
    //header('Location: login.php');
}else{
    $hashed = $row['Password'];
    
    $attempt = $_POST['passwd'];
    
    if(password_verify($attempt, $hashed)){
        $_SESSION['name'] = $row["UserID"];
        
        if($row['Authority'] == 1){
            echo("adminhomepage.php");
            //header('Location: adminhomepage.php');
        }else{
            echo("homepage.php");
            //header('Location: homepage.php');
        }
    }else{
        echo("wrong password");
        //header('Location: login.php');
    }
}

$conn = null;
?>