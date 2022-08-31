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
                        echo '<h1 style="color: red;">Unable to borrow the book"</h1>';
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
            $selectCmd = "SELECT * FROM books_tb";
            $result=mysqli_query($dbConection,$selectCmd);
            if(mysqli_num_rows($result)>0){
                echo "<table border='3'><thead><tr><th>Book</th><th>Book Description</th><th>Book Price</th><th>Likes</th></tr></thead><tbody>";
                while($row=mysqli_fetch_assoc($result)){
                    echo "<tr><td>".$row['b_title']."</br>By: ".$row['b_author']."</td>";
                    echo "<td>".$row['b_description']."</td>";
                    echo "<td>".$row['b_price']."CAD</td>";
                    echo "<td>".$row['b_likes']."</td>";
                    echo "<td><a class='btn btn-success' href='".parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH)."?b_id=".$row['b_id']."&action=borrow'>Borrow</a></td></tr>";
                }
                echo "</tbody></table>";
                $dbConection->close();
            }
        }
    ?>
</main>