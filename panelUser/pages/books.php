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
                    $insertCmd = "INSERT INTO borrow_tb (status,b_id,user_id) VALUES ('requsting','".$id."','".$user_id."')";
                    $result = $dbConection->query($insertCmd);
                    if($result === true){
                        echo "<script>alert('Send the borrow request success')</script>";;
                    }else{
                        echo "<script>alert('Action failed')</script>";
                    }
                    break;
            }
        }
    }
?>
<main>
    <form  method='POST' action='<?php echo parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);?>'>
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
            $selectCmd = "SELECT * FROM books_tb";
            $result=mysqli_query($dbConection,$selectCmd);
            if(mysqli_num_rows($result)>0){
                echo "<table border='3'><thead><tr><th>Book</th><th>Book Description</th><th>Book Price</th><th>Likes</th></tr></thead><tbody>";
                while($row=mysqli_fetch_assoc($result)){
                    echo "<tr><td>".$row['b_title']."</br>By: ".$row['b_author']."</td>";
                    echo "<td>".$row['b_description']."</td>";
                    echo "<td>".$row['b_price']."CAD</td>";
                    echo "<td>".$row['b_likes']."</td>";
                    if(in_array($row['b_id'],$borrowList)){
                        echo "<td><a class='btn btn-success disabled' href='".parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH)."?b_id=".$row['b_id']."&action=borrow' disable>Borrowing</a></td></tr>";
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
</main>