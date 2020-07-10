<?php
session_start();

     // test if variable Empty for access file listing.php
     if(empty($_SESSION['username'])&& empty($_SESSION['password'])){
        header('Location: index.php');
    }

session_destroy();
header('Location: index.php');
exit;
?>