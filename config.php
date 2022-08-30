<?php
    session_start();
    // if(!isset($_SESSION['username'])){
    //     header("Location: http://".$_SERVER['HTTP_HOST']); 
    // }
    $dbServername = "localhost";
    $dbUsername = "root";
    $dbPass = "";
    $dbname = "shelfishrd_db";
    $dbConection = new mysqli($dbServername, $dbUsername, $dbPass, $dbname);
?>