<?php
session_start();
$session=isset($_SESSION['isLoggedIn'])? $_SESSION['isLoggedIn']: false;

if($session){
    session_destroy();
    header('Location: index.php');
    exit();
}

?>