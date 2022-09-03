<?php
    session_start();
    $dbServername = "localhost";
    $dbUsername = "root";
    $dbPass = "";
    $dbname = "r_shelfishrd_db";
    $dbConection = new mysqli($dbServername, $dbUsername, $dbPass, $dbname);
?>