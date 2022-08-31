<?php
    if(!isset($_SESSION['bookData'])){
        header("Location: http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/books"); 
    }
?>
<main>
    <?php
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            if($_POST['b_title']!="" && $_POST['b_author']!="" && $_POST['b_price']!="" && $_POST['b_description']!="" && $_POST['b_keywords']!=""){
                $updatebook = "UPDATE books_tb SET b_title='".$_POST['b_title']."',b_author='".$_POST['b_author']."',b_price='".$_POST['b_price']."',b_description='".$_POST['b_description']."',b_keywords='".$_POST['b_keywords']."' WHERE b_id=".$_SESSION['b_id'];
                if($dbConection -> query($updatebook) === true){
                    $selectuser = "SELECT * FROM books_tb WHERE b_id = ".$_SESSION['b_id'];
                    $result = $dbConection -> query($selectuser);
                    $row = $result->fetch_assoc();
                    $dbConection -> close();
                    unset($_SESSION['userData']);
                    unset($_SESSION['b_id']);
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
            foreach($_SESSION['bookData'] as $fieldName => $value){
                if($fieldName == 'b_id'){
                    $_SESSION['b_id'] = $value;
                    echo "<h2>User ID: $value</h2>";
                }
                elseif($fieldName != "b_likes"){
                    echo "<label for='fieldName'>$fieldName: </label>";
                    echo "<input type='text' name='$fieldName' value='$value' required/>";
                }
            }
            echo "<button type='submit' class='btn btn-primary'>Update</button>";
            echo "<a type='button' class='btn btn btn-secondary' href='".dirname($_SERVER['PHP_SELF'])."/books'>Back</a>";
        ?>
    </form>
</main>