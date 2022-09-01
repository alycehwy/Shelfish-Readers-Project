<section class="main_content">
    <article class="addbook_body">
        <h3>Add Book</h3>
        <form class='addbook' method='POST' action='<?php echo parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);?>'>
            <div>
                <label for="b_title" class='form-label'>Book Title: </label>
                <input type="text" class='form-control' name="b_title" placeholder="Book name" require/>
            </div>
            <div>
                <label for="b_author" class='form-label'>Book Author: </label>
                <input type="text" class='form-control' name="b_author" placeholder="Author" require/>
            </div>
            <div>
                <label for="b_price" class='form-label'>Book Price: </label>
                <input type="text" class='form-control' name="b_price" placeholder="Price" require/>
            </div>
            <div>
                <label for="b_description" class='form-label'>Book Description: </label>
                <textarea class='form-control' name="b_description" placeholder="Book description" require></textarea>
            </div>
            <div>
                <label for="b_keywords" class='form-label'>Books Keyword: </label>
                <textarea name="b_keywords" class='form-control' placeholder="Keywords associated to your book" require></textarea>
            </div>
            <div class="addbookBtn">
                <button type="submit" class="btn btn btn-primary">Post a book</button>
            </div>        
        </form>
        <?php
            if($_SERVER["REQUEST_METHOD"]=="POST"){

                //making my life easier
                $b_title = htmlspecialchars($_POST['b_title']);
                $b_author = htmlspecialchars($_POST['b_author']);
                $b_description = htmlspecialchars($_POST['b_description']);
                $b_p = htmlspecialchars((Float)$_POST['b_price']);
                $b_pri = htmlspecialchars(floatval($b_p));
                $b_price = htmlspecialchars(round($b_pri,2));
                $b_keywords = htmlspecialchars($_POST['b_keywords']);
                $b_likes = ((Int)$_POST['b_likes']);

                //making the connection
                if($dbConection->connect_error){
                    die("Connection error");
                }else{
                    //if the connection is succesfull insert this data into the databse
                if($b_title!="" && $b_author!="" && $b_description!="" && $b_keywords!=""){
                    $insertCmd = "INSERT INTO books_tb (b_title,b_author,b_price,b_description,b_keywords,b_likes) VALUES ('".$b_title."','".$b_author."','".(Float)$b_price."','".$b_description."','".$b_keywords."','".(Int)$b_likes."')";
                    $result = $dbConection->query($insertCmd);
                    if($result === true){
                        echo "<script>alert('".$b_title."', register Success')</script>";  
                    }else{
                        echo "<script>alert('Action failed')</script>";
                    }
                    $dbConection->close();
                }else{
                        echo "<script>alert('All data should be filled')</script>";;
                }
                }
            }
        ?>
    </article>
</section>