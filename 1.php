<?php 
    include './config.php';
    if(isset($_GET['b_id']) && isset($_GET['action'])) {
        session_start();
        $id = $_GET['b_id'];
        $dbcon = new mysqli($dbServername,$dbUsername,$dbPass,$dbName);
        if($dbcon->connect_error){
            die("connection error");
        }else{
            while($_GET['action']=="edit"){
                    $selectuser = "SELECT * FROM books_tb WHERE b_id=$id";
                    $result = $dbcon->query($selectuser);
                    $_SESSION['userData'] = $result->fetch_assoc();
                    $dbcon->close();
                    header("Location: http://localhost/teamProject/2.php");
            }
            $dbcon->close();
        }
    }
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
    <table>
        <thead>
            <tr>
                <th>Book ID</th>
                <th>Book name</th>
                <th>Likes</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $dbcon = new mysqli($dbServername,$dbUsername,$dbPass,$dbName);
                if($dbcon->connect_error){
                    die("Connection error");
                }else{
                    $selectCmd = "SELECT * FROM books_tb";
                    $result = $dbcon->query($selectCmd);
                    while($row = $result->fetch_assoc()){
                        echo "<tr>";
                            echo "<td>".$row['b_id']."</td>";
                            echo "<td>".$row['b_name'];
                            echo "<td>".$row['b_likes']."</td>";
                            echo "<td><a href='".$_SERVER['PHP_SELF']."?id=".$row['b_id']."&action=edit'>Edit</a></td>";
                        echo "</tr>";
                    }
                    $dbcon->close();
                }
            ?>
        </tbody>
    </table>
</body>
</html>