<?php
    if(isset($_GET['b_id']) && isset($_GET['action'])){
        $id = $_GET['b_id'];
        if($dbConection->connect_error){
            die("Connection error");
        }
        else{
            switch($_GET['action']){
                case "borrow":
                    $username = $_SESSION['username'];
                    if($dbConection->connect_error){
                        die("Connection error");
                    }
                    else{
                        $selectCmd = "SELECT * FROM user_tb WHERE username = '$username' AND title = 'user'";
                        $resultSelect = $dbConection->query($selectCmd);
                        $row = $resultSelect->fetch_assoc();
                        $user_id = $row['user_id'];
                    }
                    echo $_GET['b_id'];
                    echo $user_id;
                    // $insertCmd = "INSERT INTO borrow_tb (status,b_id,user_id) VALUES ('requesting','".$_GET['b_id']."','".$user_id."')";
                    // $updateCmd = "UPDATE books_tb SET available = 'false' WHERE t_id = '".$_GET['b_id']."'";
                    // $result = $dbConection->query($insertCmd);
                    // if($result === true){
                    //     echo "<script>alert('Send the borrow request success')</script>";;
                    // }else{
                    //     echo "<script>alert('Action failed')</script>";
                    // }
                    break;
                case "addlike":
                    $updateCmd = "UPDATE books_tb SET b_likes = b_likes+1 WHERE b_id = $id";
                    $update = $dbConection->query($updateCmd);
                    break;
                case "dellike":
                    $updateCmd = "UPDATE books_tb SET b_likes = b_likes-1 WHERE b_id = $id";
                    $update = $dbConection->query($updateCmd);
                    break;
            }
            $dbConection->close();
        }
    }
?>
<section class="main_content">
    <article class="books_body">
        <h3>Books</h3>
        <form class='search' method='POST' action='<?php echo parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);?>'>
            <p>Search: </p>
            <input type="search" class="border border-secondary search_bar" name="search" required/>
            <input type="submit" class="btn btn-outline-secondary" name="submit" value='Search' />
            <a type="button" class="btn btn-outline-secondary" href="<?php echo parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);?>">Reset</a>
        </form>
        <?php
            $dbConection = new mysqli($dbServername,$dbUsername,$dbPass,$dbname);           
            if(isset($_POST['submit'])){
                $selectUser = "SELECT * FROM user_tb WHERE username = '".$_SESSION['username']."' AND title = 'user'";
                $resultUser = $dbConection->query($selectUser);
                $rowUser = $resultUser->fetch_assoc();
                $user_id = $rowUser['user_id'];
                $borrowList = [];
                $borrowCmd = "SELECT * FROM borrow_tb WHERE user_id = '$user_id'";
                $resultborrow = $dbConection->query($borrowCmd);
                while($rowborrow = $resultborrow->fetch_assoc()){
                    if($rowborrow['user_id'] == $user_id){
                        array_push($borrowList,$rowborrow['b_id']);
                    }
                }
                $search = mysqli_real_escape_string($dbConection,$_POST['search']);
                $selectCmd = "SELECT * FROM books_tb LEFT JOIN borrow_tb ON books_tb.b_id = borrow_tb.b_id WHERE 'b_id' LIKE '%$search%' OR b_title LIKE '%$search%' OR b_author LIKE '%$search%' OR b_keywords LIKE '%$search%'";
                $result=mysqli_query($dbConection,$selectCmd);
                if(mysqli_num_rows($result)>0){
                    echo "<table class='table'><thead><tr class='table-dark'><th>Book</th><th>Book Description</th><th colspan=3>Likes</th><th>Actions</th></tr></thead><tbody>";
                    // echo "<table class='table'><thead><tr class='table-dark'><th>Book</th><th>Book Description</th><th>Likes</th><th>Actions</th></tr></thead><tbody>";
                    while($row=mysqli_fetch_assoc($result)){
                        echo "<tr class='border-secondary'><td>".$row['b_title']."</br>By: ".$row['b_author']."</td>";
                        echo "<td>".$row['b_description']."</td>";
                        echo "<td>".$row['b_likes']."</td>";
                        echo "<td><a class='btn btn-heart' id='like' href='".parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH)."?b_id=".$row['b_id']."&action=addlike'><i class='fas fa-heart' style='font-size:18px;color:red''></i></a></td>";
                        echo "<td><a class='btn btn-heart' id='unlike' href='".parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH)."?b_id=".$row['b_id']."&action=dellike'><i class='far fa-heart' style='font-size:18px;''></i></a></td>";
                        if($row['available'] == 'false'){
                            if(in_array($row['b_id'],$borrowList)){
                                if($row['status'] == 'requesting'){
                                    echo "<td><a class='btn btn-btn btn-warning disabled' href='".parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH)."?b_id=".$row['b_id']."&action=borrow' disable>requesting</a></td></tr>";
                                }
                                else{
                                    echo "<td><a class='btn btn-success disabled' href='".parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH)."?b_id=".$row['b_id']."&action=borrow' disable>Borrowing</a></td></tr>";
                                }
                            }
                            else{
                                echo "<td><a class='btn btn-secondary disabled' href='".parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH)."?b_id=".$row['b_id']."&action=borrow'>Unavailable</a></td></tr>";
                            }
                        }
                        else{
                            echo "<td><a class='btn btn-primary' href='".parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH)."?b_id=".$row['b_id']."&action=borrow'>Borrow</a></td></tr>";
                        }
                    }
                    echo "</tbody></table>";
                    $dbConection->close();
                }else{
                echo "No book found";
                }
            }else{
                $selectUser = "SELECT * FROM user_tb WHERE username = '".$_SESSION['username']."' AND title = 'user'";
                $resultUser = $dbConection->query($selectUser);
                $rowUser = $resultUser->fetch_assoc();
                $user_id = $rowUser['user_id'];
                $borrowList = [];
                $borrowCmd = "SELECT * FROM borrow_tb WHERE user_id = '$user_id'";
                $resultborrow = $dbConection->query($borrowCmd);
                while($rowborrow = $resultborrow->fetch_assoc()){
                    if($rowborrow['user_id'] == $user_id){
                        array_push($borrowList,$rowborrow['b_id']);
                    }
                }
                $selectCmd = "SELECT * FROM books_tb LEFT JOIN borrow_tb ON books_tb.b_id = borrow_tb.b_id";
                // $selectCmd = "SELECT * FROM books_tb LEFT JOIN borrow_tb ON books_tb.b_id = borrow_tb.b_id JOIN like_control ON books_tb.b_id = like_control.b_id JOIN user_tb ON like_control.user_id = user_tb.user_id";
                $result=mysqli_query($dbConection,$selectCmd);
                if(mysqli_num_rows($result)>0){
                    // echo "<table class='table'><thead><tr class='table-dark'><th>Book</th><th>Book Description</th><th>Likes</th><th>Actions</th></tr></thead><tbody>";
                    echo "<table class='table'><thead><tr class='table-dark'><th>Book</th><th>Book Description</th><th colspan=3>Likes</th><th>Actions</th></tr></thead><tbody>";
                    while($row=mysqli_fetch_assoc($result)){

                        echo "<tr class='border-secondary'><td>".$row['b_title']."</br>By: ".$row['b_author']."</td>";
                        echo "<td>".$row['b_description']."</td>";
                        echo "<td>".$row['b_likes']."</td>";
                        echo "<td><a class='btn btn-heart' id='like' href='".parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH)."?b_id=".$row['b_id']."&action=addlike'><i class='fas fa-heart' style='font-size:18px;color:red''></i></a></td>";
                        echo "<td><a class='btn btn-heart' id='unlike' href='".parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH)."?b_id=".$row['b_id']."&action=dellike'><i class='far fa-heart' style='font-size:18px;''></i></a></td>";
                        // if($row['like_chk'] == 'false'){
                        //     echo "<td><a class='btn btn-heart' id='like' href='".parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH)."?b_id=".$row['b_id']."&action=addlike'><i class='fas fa-heart' style='font-size:18px;color:red''></i></a></td>";
                        //     $updateCmd = "UPDATE like_control SET like_chk = 'true' WHERE b_id = '".$row['b_id']."' AND user_id = '".$row['user_id']."'";
                        // }else{
                        //     echo "<td><a class='btn btn-heart' id='unlike' href='".parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH)."?b_id=".$row['b_id']."&action=dellike'><i class='far fa-heart' style='font-size:18px;''></i></a></td>";
                        //     $updateCmd = "UPDATE like_control SET like_chk = 'false' WHERE b_id = '".$row['b_id']."'";
                        // }
                        if($row['available'] == 'false'){
                            if(in_array($row['b_id'],$borrowList)){
                                if($row['status'] == 'requesting'){
                                    echo "<td><a class='btn btn-btn btn-warning disabled' href='".parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH)."?b_id=".$row['b_id']."&action=borrow' disable>Requesting</a></td></tr>";
                                }
                                else{
                                    echo "<td><a class='btn btn-success disabled' href='".parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH)."?b_id=".$row['b_id']."&action=borrow' disable>Borrowing</a></td></tr>";
                                }
                            }
                            else{
                                echo "<td><a class='btn btn-secondary disabled' href='".parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH)."?b_id=".$row['b_id']."&action=borrow'>Unavailable</a></td></tr>";
                            }
                        }
                        else{
                            echo "<td><a class='btn btn-primary' href='".parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH)."?b_id=".$row['b_id']."&action=borrow'>Borrow</a></td></tr>";
                        }

                    }
                    echo "</tbody></table>";
                    $dbConection->close();
                }
            }
        ?>
    </article>
</section>