<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
$session=isset($_SESSION['isLoggedIn'])? $_SESSION['isLoggedIn']: false;
if(!$session){
 
    header("Location: ../login.php");
    exit();
}

    $session_user=isset($_SESSION['user'])? $_SESSION['user']: '';

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Admin Dashboard</title>
       
         <link href="assets/css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="assets/js/all.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
        
    </head>
    <body class="sb-nav-fixed">
    