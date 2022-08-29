<?php
    session_start();
    include "./config.php";
    // $dbServername = "localhost";
    // $dbUsername = "root";
    // $dbPass = "";
    // $dbName = "shelfishrd_db";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        if($_SERVER['REQUEST_METHOD']=="GET"){
            if(isset($_SESSION['b_id']) && isset($_SESSION['b_likes'])){
                $id = $_SESSION['b_id'];
                $likes = (Int)$_SESSION['b_likes'];
                $likes++;
               
                $dbcon = new mysqli($dbServername,$dbUsername,$dbPass,$dbName);
                $updateCmd = "UPDATE books_tb SET b_likes=$likes WHERE b_id=$id";

                echo $likes.$id;
                $result = $dbcon->query($updateCmd);
                // header("Location: http://localhost/teamProject/like.php");
                if($result === true){
                    // $dbcon->close();
                    echo "working";
                }
            }else{
                echo "not working";
            }
        }
    ?>
</body>
</html>