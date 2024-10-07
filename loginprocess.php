<?php

include_once ("connection.php");

array_map("htmlspecialchars", $_POST);

$stmt = $conn->prepare("SELECT * FROM tblusers WHERE Username =:username;");

$stmt->bindParam(':username', $_POST["username"]);
$stmt->bindParam(':password', $_POST["passwd"]);

$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{ 
    if($row['Password']== $_POST['passwd']){
        header('Location: users.php');
        echo "Yes";
    }else{
        header('Location: items.php');
        echo "No";
    }
}

$conn=null;
?>
