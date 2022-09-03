<?php
    if(isset($_GET['b_id']) && isset($_GET['action'])){
        $id = $_GET['b_id'];
        if($dbConection->connect_error){
            die("Connection error");
        }
        else{
            $username = $_SESSION['username'];
            $selectCmd = "SELECT * FROM user_tb WHERE username = '$username' AND title = 'user'";
            $resultSelect = $dbConection->query($selectCmd);
            $row = $resultSelect->fetch_assoc();
            $user_id = $row['user_id'];
            switch($_GET['action']){
                case "borrow":
                    $insertCmd = "INSERT INTO borrow_tb (status,b_id,buser_id) VALUES ('requesting','".$id."','".$user_id."')";
                    $updateCmd = "UPDATE books_tb SET available='false' WHERE b_id =$id";
                    $insertresult = $dbConection->query($insertCmd);
                    $updateresult = $dbConection->query($updateCmd);
                    if($insertresult === true && $updateresult === true){
                        echo "<script>alert('Send the borrow request success')</script>";;
                    }else{
                        echo "<script>alert('Action failed')</script>";
                    }
                    break;
                case "addlike":
                    $updateCmd = "UPDATE books_tb SET b_likes = b_likes+1 WHERE b_id = $id";
                    $updateCmdlike = "UPDATE like_control SET like_chk = 'true' WHERE b_id = $id AND user_id = $user_id";
                    $updateresult = $dbConection->query($updateCmd);
                    $updatelikeresult = $dbConection->query($updateCmdlike);
                    if($updateresult !== true && $updatelikeresult !== true){
                        echo "<script>alert('Action failed')</script>";
                    }
                    break;
                case "dellike":
                    $updateCmd = "UPDATE books_tb SET b_likes = b_likes-1 WHERE b_id = $id";
                    $updateCmdlike = "UPDATE like_control SET like_chk = 'false' WHERE b_id = $id AND user_id = $user_id";
                    $updateresult = $dbConection->query($updateCmd);
                    $updatelikeresult = $dbConection->query($updateCmdlike);
                    if($updateresult !== true && $updatelikeresult !== true){
                        echo "<script>alert('Action failed')</script>";
                    }
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
            $selectUser = "SELECT * FROM user_tb WHERE username = '".$_SESSION['username']."' AND title = 'user'";
            $resultUser = $dbConection->query($selectUser);
            $rowUser = $resultUser->fetch_assoc();
            $user_id = $rowUser['user_id'];      
            if(isset($_POST['submit'])){
                $search = mysqli_real_escape_string($dbConection,$_POST['search']);
                $selectCmd = "SELECT * FROM books_tb LEFT JOIN borrow_tb ON books_tb.b_id = borrow_tb.b_id AND borrow_tb.status != 'borrowed' LEFT JOIN like_control ON books_tb.b_id = like_control.b_id AND like_control.user_id = $user_id WHERE 'b_id' LIKE '%$search%' OR b_title LIKE '%$search%' OR b_author LIKE '%$search%' OR b_keywords LIKE '%$search%'";
                $result=mysqli_query($dbConection,$selectCmd);
                if(mysqli_num_rows($result)>0){
                    echo "<table class='table'><thead><tr class='table-dark'><th>Book</th><th>Book Description</th><th colspan=2>Likes</th><th>Actions</th></tr></thead><tbody>";
                    while($row=mysqli_fetch_assoc($result)){
                        echo "<tr class='border-secondary'><td>".$row['b_title']."</br>By: ".$row['b_author']."</td>";
                        echo "<td>".$row['b_description']."</td>";
                        echo "<td>".$row['b_likes']."</td>";
                        if($row['like_chk'] == 'false'){
                            echo "<td><a class='btn btn-heart' id='like' href='".parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH)."?b_id=".$row['b_id']."&action=addlike'><i class='far fa-heart' style='font-size:18px;''></i></a></td>";
                            $updateCmd = "UPDATE like_control SET like_chk = 'true' WHERE b_id = '".$row['b_id']."' AND user_id = '".$row['user_id']."'";
                        }else{
                            echo "<td><a class='btn btn-heart' id='unlike' href='".parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH)."?b_id=".$row['b_id']."&action=dellike'><i class='fas fa-heart' style='font-size:18px;color:red''></i></a></td>";
                            $updateCmd = "UPDATE like_control SET like_chk = 'false' WHERE b_id = '".$row['b_id']."'";
                        }
                        if($row['available'] == 'false'){
                            if($row['buser_id'] == $user_id){
                                if($row['status'] == 'borrowing'){
                                    echo "<td><a class='btn btn-success disabled'>Borrowing</a></td></tr>";
                                }
                                elseif($row['status'] == 'requesting'){
                                    echo "<td><a class='btn btn-warning disabled'>Requesting</a></td></tr>";
                                }
                                elseif($row['status'] == 'returning'){
                                    echo "<td><a class='btn btn-warning disabled'>Returning</a></td></tr>";
                                }
                                elseif($row['status'] == 'extending'){
                                    echo "<td><a class='btn btn-warning disabled'>Extending</a></td></tr>";
                                }
                            }
                            else{
                                echo "<td><a class='btn btn-secondary disabled'>Unavailable</a></td></tr>";
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
                $selectCmd = "SELECT * FROM books_tb LEFT JOIN borrow_tb ON books_tb.b_id = borrow_tb.b_id AND borrow_tb.status != 'borrowed' LEFT JOIN like_control ON books_tb.b_id = like_control.b_id AND like_control.user_id = $user_id";
                $result=mysqli_query($dbConection,$selectCmd);
                if(mysqli_num_rows($result)>0){
                    echo "<table class='table'><thead><tr class='table-dark'><th>Book</th><th>Book Description</th><th colspan=2>Likes</th><th>Actions</th></tr></thead><tbody>";
                    while($row=mysqli_fetch_assoc($result)){
                        echo "<tr class='border-secondary'><td>".$row['b_title']."</br>By: ".$row['b_author']."</td>";
                        echo "<td>".$row['b_description']."</td>";
                        echo "<td>".$row['b_likes']."</td>";
                        if($row['like_chk'] == 'false'){
                            echo "<td><a class='btn btn-heart' id='like' href='".parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH)."?b_id=".$row['b_id']."&action=addlike'><i class='far fa-heart' style='font-size:18px;''></i></a></td>";
                            $updateCmd = "UPDATE like_control SET like_chk = 'true' WHERE b_id = '".$row['b_id']."' AND user_id = '".$row['user_id']."'";
                        }else{
                            echo "<td><a class='btn btn-heart' id='unlike' href='".parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH)."?b_id=".$row['b_id']."&action=dellike'><i class='fas fa-heart' style='font-size:18px;color:red''></i></a></td>";
                            $updateCmd = "UPDATE like_control SET like_chk = 'false' WHERE b_id = '".$row['b_id']."'";
                        }
                        if($row['available'] == 'false'){
                            if($row['buser_id'] == $user_id){
                                if($row['status'] == 'borrowing'){
                                    echo "<td><a class='btn btn-success disabled'>Borrowing</a></td></tr>";
                                }
                                elseif($row['status'] == 'requesting'){
                                    echo "<td><a class='btn btn-warning disabled'>Requesting</a></td></tr>";
                                }
                                elseif($row['status'] == 'returning'){
                                    echo "<td><a class='btn btn-warning disabled'>Returning</a></td></tr>";
                                }
                                elseif($row['status'] == 'extending'){
                                    echo "<td><a class='btn btn-warning disabled'>Extending</a></td></tr>";
                                }
                            }
                            else{
                                echo "<td><a class='btn btn-secondary disabled'>Unavailable</a></td></tr>";
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