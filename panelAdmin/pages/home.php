<?php
    if(isset($_GET['id']) && isset($_GET['action'])){
        $id = $_GET['id'];
        if($dbConection->connect_error){
            die("Connection error");
        }
        else{
            switch($_GET['action']){
                case "edit":
                    $selectuser = "SELECT * FROM user_tb WHERE user_id = $id";
                    $result = $dbConection -> query($selectuser);
                    $_SESSION['userData'] = $result->fetch_assoc();
                    header("Location: edituser");

            }
            $dbConection->close();
        }
    }
?>
<section class="main_content">
    <article class="home_body">
        <?php
                    
            $username = $_SESSION['username'];
            if($dbConection->connect_error){
                die("Connection error");
            }
            else{
                $selectCmd = "SELECT * FROM user_tb WHERE username = '$username' AND title = 'admin'";
                $result = $dbConection->query($selectCmd);
                while($row = $result->fetch_assoc()){
                    echo "<div class='user_info'>";
                    echo "<img class='user_img' src='./img/user.png' alt='user' />";
                    echo "<div class='card-body'>";
                    echo "<p><b>Username: </b>".$row['username']."</p>";
                    echo "<p><b>Full Name: </b>".$row['first_name']." ".$row['last_name']."</p>";
                    echo "<p><b>Email ID: </b>".$row['email']."</p>";
                    echo "<a type='button' class='btn btn-primary' href='".parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH)."?id=".$row['user_id']."&action=edit'>Edit</a></div></div>";         
                }
                $dbConection->close();
            }
        ?>
    </article>
</section>