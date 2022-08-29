<?php
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
</head>
<body>
    <form  method='POST' action="<?php echo $_SERVER['PHP_SELF'];?>">
        <input type="text" name="b_name" placeholder="Book name" require/>
        <textarea name="b_description" placeholder="Book description" require></textarea>
        <textarea name="b_keywords" placeholder="Keywords associated to your book" require></textarea>
        <input type="hidden" name="b_likes" value="0">
        <button type="submit">Post a book</button>
    </form>
    <?php
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            //making my life easier
            $b_title = $_POST['b_title'];
            $b_descrip = $_POST['b_description'];
            $b_keywords = $_POST['b_keywords'];
            $b_likes = (Int)$_POST['b_likes'];
            //making the connection
            $dbCon = new mysqli($dbServername,$dbUsername,$dbPass,$dbName);
            if($dbCon->connect_error){
                die("Connection error ");
            }else{
                //if the connection is succesfull insert this data into the databse
               if($b_name!=""){
                $insertCmd = "INSERT INTO books_tb (b_title,b_author,b_description,b_price,b_keywords,b_likes) VALUES ('$b_title','$b_author',$b_descrip','$b_keywords',$b_likes)";
                $result = $dbCon->query($insertCmd);
                if($result === true){
                    echo '<h1 style="color: green;">Your book, "'.$b_name.'", has been registered</h1>';
                    // $addr = "http://localhost/teamProject/like.php";
                    // header("Location: $addr");
                }else{
                    echo '<h1 style="color: red;">Unable to register your book: "'.$b_name.'"</h1>';
                }
                $dbCon->close();
               }else{
                    echo "<p style='color:red;'>Please check the name of your book";
               }
            }
        }
    ?>
</body>
