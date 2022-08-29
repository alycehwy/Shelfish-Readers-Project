<?php
    include '../config.php';
?>
<main>
    <form  method='POST' action='<?php echo "http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/addBook";?>'>
        <input type="text" name="b_title" placeholder="Book name" require/>
        <input type="text" name="b_author" placeholder="Author" require/>
        <textarea name="b_description" placeholder="Book description" require></textarea>
        <input type="text" name="b_price" placeholder="Price" require/>
        <textarea name="b_keywords" placeholder="Keywords associated to your book" require></textarea>
        <input type="hidden" name="b_likes" value="0">
        <button type="submit">Post a book</button>
    </form>
    <?php
        if($_SERVER["REQUEST_METHOD"]=="POST"){

            //making my life easier
            $b_title = $_POST['b_title'];
            $b_author = $_POST['b_author'];
            $b_description = $_POST['b_description'];
            $b_p = (Float)$_POST['b_price'];
            $b_pri = floatval($b_p);
            $b_price = round($b_pri,2);
            $b_keywords = $_POST['b_keywords'];
            $b_likes = (Int)$_POST['b_likes'];

            //making the connection

            if($dbConection->connect_error){
                die("Connection error");
            }else{
                //if the connection is succesfull insert this data into the databse
               if($b_title!="" && $b_author!="" && $b_description!="" && $b_keywords!=""){
                $insertCmd = "INSERT INTO books_tb (b_title,b_author,b_price,b_description,b_keywords,b_likes) VALUES ('".$b_title."','".$b_author."','".(Float)$b_price."','".$b_description."','".$b_keywords."','".(Int)$b_likes."')";
                $result = $dbConection->query($insertCmd);
                if($result === true){
                    echo '<h1 style="color: green;">Your book, "'.$b_title.'", has been registered</h1>';
                    // $addr = "http://localhost/teamProject/like.php";
                    // header("Location: $addr");
                }else{
                    echo '<h1 style="color: red;">Unable to register your book: "'.$b_title.'"</h1>';
                }
                $dbConection->close();
               }else{
                    echo "<p style='color:red;'>Please be sure to fill all the inputs";
               }
            }
        }
    ?>
</main>