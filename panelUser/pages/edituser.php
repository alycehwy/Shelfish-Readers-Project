<?php
    if(!isset($_SESSION['userData'])){
        header("Location: http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/manager"); 
    }
?>
<section class="main_content">
    <article class="edituser_body">
        <h3>Edit User</h3>
        <?php
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                if($_POST['password']!="" && $_POST['first_name']!="" && $_POST['last_name']!="" && $_POST['email']!=""){
                    $updateuser = "UPDATE user_tb SET password='".$_POST['password']."',first_name='".$_POST['first_name']."',last_name='".$_POST['last_name']."',email='".$_POST['email']."' WHERE user_id=".$_SESSION['id'];
                    if($dbConection -> query($updateuser) === true){
                        $selectuser = "SELECT * FROM user_tb WHERE user_id = ".$_SESSION['id'];
                        $result = $dbConection -> query($selectuser);
                        $row = $result->fetch_assoc();
                        $dbConection -> close();
                        unset($_SESSION['userData']);
                        unset($_SESSION['id']);
                        echo "<script>alert('Edit Success')</script>";  
                        header("Refresh:0.01; url=http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/", true);
                    }
                }
                else{
                    echo "<script>alert('All data should be filled')</script>";
                }
            }
        ?>
        <form method="POST" action="<?php echo parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH) ?>">
            <?php
                foreach($_SESSION['userData'] as $fieldName => $value){  
                    switch($fieldName){
                        case "email":
                            $type = "email";
                            break;
                        case "password":
                            $type = "password";
                            break;
                        default:
                            $type = "text";
                    }
                    if($fieldName == "user_id"){
                        $_SESSION['id'] = $value;
                        echo "<h4>User ID: $value</h4>";
                    }
                    elseif($fieldName == "username"){
                        echo "<h4 class='edituser_h4'>Username: $value</h4>";
                    }
                    elseif($fieldName != "title"){
                        echo "<div><label for='fieldName' class='form-label'>$fieldName: </label>";
                        echo "<input type='$type' class='form-control' name='$fieldName' value='$value' required/></div>";
                    }
                }
                echo "<div class='edituserBtn'><button type='submit' class='btn btn-primary'>Update</button>";
                echo "<a type='button' class='btn btn btn-secondary' href='".dirname($_SERVER['PHP_SELF'])."/'>Back</a></div>";
            ?>
        </form>
    </article>
</section>