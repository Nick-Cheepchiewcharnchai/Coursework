<?php

if(isset($_SESSION['name'])){
    unset($_SESSION['name']);
}

header("Location: login.php");
?>