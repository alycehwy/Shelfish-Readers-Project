<?php
    include "./config.php";
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
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <input type="search" name="search" required/>
        <input type="submit" name="submit" value='Search' required/>
    </form>
    <?php 
        if(isset($_POST['submit'])){
            $search = mysqli_real_escape_string($dbConection,$_POST['search']);
            $selectCmd = "SELECT * FROM books_tb WHERE b_id LIKE '%$search%' OR b_title LIKE '%$search%' OR b_author LIKE '%$search%' OR b_keywords LIKE '%$search%'";
            $result=mysqli_query($dbConection,$selectCmd);
            if(mysqli_num_rows($result)>0){
                echo "<table border='3'><thead><tr><th>Book</th><th>Book Description</th><th>Book Price</th><th>Likes</th></tr></thead><tbody>";
                while($row=mysqli_fetch_assoc($result)){
                    echo "<tr><td>".$row['b_title']."</br>By: ".$row['b_author']."</td>";
                    echo "<td>".$row['b_description']."</td>";
                    echo "<td>".$row['b_price']."CAD</td>";
                    echo "<td>".$row['b_likes']."</td></tr>";
                }
            echo "</tbody></table>";
            }else{
            echo "No book found";
            }
        }else{
            $selectCmd = "SELECT * FROM books_tb";
            $result=mysqli_query($dbConection,$selectCmd);
            if(mysqli_num_rows($result)>0){
                echo "<table border='3'><thead><tr><th>Book</th><th>Book Description</th><th>Book Price</th><th>Likes</th></tr></thead><tbody>";
                while($row=mysqli_fetch_assoc($result)){
                    echo "<tr><td>".$row['b_title']."</br>By: ".$row['b_author']."</td>";
                    echo "<td>".$row['b_description']."</td>";
                    echo "<td>".$row['b_price']."CAD</td>";
                    echo "<td>".$row['b_likes']."</td></tr>";
                }
                echo "</tbody></table>";
            }
        }
    ?>