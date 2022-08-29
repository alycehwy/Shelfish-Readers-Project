<?php
    session_start();
    include './config.php';
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Book ID</th>
                <th>Book Name</th>
                <th>Likes</th>
            </tr>
        </thead>
        <tbody>
    <?php   
            if(isset($_POST['submit'])){
                $_SESSION['b_id'] = $_POST['b_id'];
                (Int)$_SESSION['b_likes'] = (Int)$_POST['b_likes'];

                header("Location: http://localhost/teamProject/likeUpdate.php");
            }
            $dbcon = new mysqli($dbServername,$dbUsername,$dbPass,$dbName);
            if($dbcon->connect_error){
                die("Unable to connect");
            }else{
                //Selecting only the information I want to show 
                $selectCmd = "SELECT b_id,b_name,b_likes FROM books_tb";
                //making the loop to display everything we already have on the database
                $result = $dbcon->query($selectCmd);
                while($row = $result->fetch_assoc()){
                    echo "<form method='POST' action='".$_SERVER['PHP_SELF']."'><tr>";
                    echo "<td>".$row['b_id']."</td>";
                    echo "<td>".$row['b_name']."</td>";
                    echo "<td>".$row['b_likes']."</td>";
                    echo "<td><button type='submit' name='submit' class='fa-solid fa-heart'>Add Like</button></td>";
                    echo "</tr></form>";
                }
            }
        ?>
        </tbody>
    </table>
</body>
</html>