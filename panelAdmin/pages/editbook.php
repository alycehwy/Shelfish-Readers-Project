<?php
    if(!isset($_SESSION['bookData'])){
        header("Location: http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/books"); 
    }
?>
<section class="main_content">
    <article class="editbook_body">
        <h3>Edit Book</h3>
        <?php
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                if($_POST['b_title']!="" && $_POST['b_author']!="" && $_POST['b_price']!="" && $_POST['b_description']!="" && $_POST['b_keywords']!="" && $_POST['b_likes']!=""){
                    $updatebook = "UPDATE books_tb SET b_title='".$_POST['b_title']."',b_author='".$_POST['b_author']."',b_price='".$_POST['b_price']."',b_description='".$_POST['b_description']."',b_keywords='".$_POST['b_keywords']."' ,b_likes='".$_POST['b_likes']."'WHERE b_id=".$_SESSION['bookData']['b_id'];
                    if($dbConection -> query($updatebook) === true){
                        $selectuser = "SELECT * FROM books_tb WHERE b_id = ".$_SESSION['bookData']['b_id'];
                        $result = $dbConection -> query($selectuser);
                        $row = $result->fetch_assoc();
                        $dbConection -> close();
                        unset($_SESSION['bookData']);
                        echo "<script>alert('Edit Success')</script>";  
                        header("Refresh:0.01; url=http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/books", true);
                    }
                }
                else{
                    echo "<script>alert('All data should be filled')</script>";;
                }
            }
        ?>
        <form method="POST" action="<?php echo parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH) ?>">
            <?php
                echo "<h4>Book ID: ".$_SESSION['bookData']['b_id']."</h4>";
                echo "<div><label class='form-label' for='b_title'>Book Title:</label>";
                echo "<input type='text' class='form-control' name='b_title' value='".$_SESSION['bookData']['b_title']."'required/></div>";
                echo "<div><label class='form-label' for='b_author'>Book Author:</label>";
                echo "<input type='text' class='form-control' name='b_author' value='".$_SESSION['bookData']['b_author']."'required/></div>";
                echo "<div><label class='form-label' for='b_price'>Book Price:</label>";
                echo "<input type='text' class='form-control' name='b_price' value='".$_SESSION['bookData']['b_price']."' required/></div>";
                echo "<div><label class='form-label'for='b_description'>Book Description:</label>";
                echo "<input type='text' class='form-control' name='b_description' value='".$_SESSION['bookData']['b_description']."' required/></div>";
                echo "<div><label class='form-label' for='b_keywords'>Book Keywords:</label>";
                echo "<input type='text' class='form-control' name='b_keywords' value='".$_SESSION['bookData']['b_keywords']."' required/></div>";
                echo "<div><label class='form-label' for='b_likes'>Likes:</label>";
                echo "<input type='text' class='form-control' name='b_likes' value='".$_SESSION['bookData']['b_likes']."' required/></div>";
                echo "<div class='editbookBtn'><button type='submit' class='btn btn-primary'>Update</button>";
                echo "<a type='button' class='btn btn btn-secondary' href='".dirname($_SERVER['PHP_SELF'])."/books'>Back</a></div>";
            ?>
        </form>
    </article>
</section>