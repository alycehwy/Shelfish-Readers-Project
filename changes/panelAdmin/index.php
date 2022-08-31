<?php
    include '../config.php';
    if(!isset($_SESSION['username'])){
        header("Location: http://".$_SERVER['HTTP_HOST']); 
    }
    include './websettings/routing.php';
    include './masterpages/header.php';
    include $pageCompo;
    include './masterpages/footer.php';
?>