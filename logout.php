<?php

if(isset($_SESSION['Name'])){
    unset($_SESSION['Name']);
}

header("Location: login.php");
?>