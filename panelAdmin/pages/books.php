<?php
    if(isset($_GET['id']) && isset($_GET['action'])){
        $id = $_GET['id'];
        if($dbConection->connect_error){
            die("Connection error");
        }
        else{
            switch($_GET['action']){
                case "del":
                    $delCmd = "DELETE FROM books_tb WHERE b_id = $id";
                    if($dbConection -> query($delCmd) === true){
                        echo "<script>alert('Book Deleted')</script>";
                    }
                    else{
                        echo "<script>alert('Action failed')</script>";
                    }
                    break;
                case "edit":
                    $selectuser = "SELECT * FROM books_tb WHERE b_id = $id";
                    $result = $dbConection -> query($selectuser);
                    $_SESSION['bookData'] = $result->fetch_assoc();
                    header("Location: editbook");

            }
            $dbConection->close();
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
            }else{
            echo "No book found";
            }
        }else{
            $selectCmd = "SELECT * FROM books_tb";
            $result=mysqli_query($dbConection,$selectCmd);
            if(mysqli_num_rows($result)>0){
                echo "<table border='3'><thead><tr><th>Book</th><th>Book Description</th><th>Book Price</th><th>Likes</th><th colspan=2 >Actions</th></tr></thead><tbody>";
                while($row=mysqli_fetch_assoc($result)){
                    echo "<tr><td>".$row['b_title']."</br>By: ".$row['b_author']."</td>";
                    echo "<td>".$row['b_description']."</td>";
                    echo "<td>".$row['b_price']."CAD</td>";
                    echo "<td>".$row['b_likes']."</td>";
                    echo "<td><a class='btn btn-primary' href='".parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH)."?id=".$row['b_id']."&action=edit'>Edit</a></td>";
                    echo "<td><a class='btn btn-danger' href='".parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH)."?id=".$row['b_id']."&action=del'>Delete</a></td></tr>";
                }
                echo "</tbody></table>";
            }
        }
    ?>
</main>