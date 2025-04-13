<?php

if(isset($_SESSION['name'])){
    unset($_SESSION['name']);
}

echo($_SESSION['name']);
//header("Location: login.php");
?>