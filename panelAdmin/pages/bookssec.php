<?php
    if(isset($_GET['id']) && isset($_GET['action'])){
        $id = $_GET['id'];
        if($dbConection->connect_error){
            die("Connection error");
        }
        else{
            switch($_GET['action']){
                case "del":
                    $delCmd = "DELETE FROM book_tb WHERE b_id = $id";
                    if($dbConection -> query($delCmd) === true){
                        echo "<script>alert('Book Deleted')</script>";
                    }
                    else{
                        echo "<script>alert('Action failed')</script>";
                    }
                    break;
                case "edit":
                    $selectuser = "SELECT * FROM book_tb WHERE b_id = $id";
                    $result = $dbConection -> query($selectuser);
                    $_SESSION['bookData'] = $result->fetch_assoc();
                    header("Location: editbook");

            }
            $dbConection->close();
        }
    }
?>
<section class="main_content">
    <article class="books_body">
        <h3>Second-hand Books</h3>
        <form class='search' method='POST' action='<?php echo parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);?>'>
            <p>Search: </p>
            <input type="search" class="border border-secondary search_bar" name="search" required/>
            <input type="submit" class="btn btn-outline-secondary" name="submit" value='Search' />
            <a type="button" class="btn btn-outline-secondary" href="<?php echo parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);?>">Reset</a>
        </form>
        <?php
            $dbConection = new mysqli($dbServername,$dbUsername,$dbPass,$dbname);
            if(isset($_POST['submit'])){
                $search = mysqli_real_escape_string($dbConection,$_POST['search']);
                $selectCmd = "SELECT * FROM book_tb WHERE b_id LIKE '%$search%' OR b_title LIKE '%$search%' OR b_author LIKE '%$search%' OR b_keywords LIKE '%$search%' AND b_type = 0";
                $result=mysqli_query($dbConection,$selectCmd);
                if(mysqli_num_rows($result)>0){
                    echo "<table class='table'><thead><tr class='table-dark'><th>Book</th><th>Book Description</th><th>Book Price</th><th>Likes</th><th colspan=2 >Actions</th></tr></thead><tbody>";
                    while($row=mysqli_fetch_assoc($result)){
                        echo "<tr class='border-secondary'><td>".$row['b_title']."</br>By: ".$row['b_author']."</td>";
                        echo "<td>".$row['b_description']."</td>";
                        echo "<td>".$row['b_price']."CAD</td>";
                        echo "<td>".$row['b_like']."</td>";
                        echo "<td><a class='btn btn-primary' href='".parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH)."?id=".$row['b_id']."&action=edit'>Edit</a></td>";
                        echo "<td><a class='btn btn-danger' href='".parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH)."?id=".$row['b_id']."&action=del'>Delete</a></td></tr>";
                    }
                echo "</tbody></table>";
                }else{
                echo "No book found";
                }
            }
            elseif(isset($_POST['reset'])){
                $selectCmd = "SELECT * FROM book_tb WHERE b_type = 0";
                $result=mysqli_query($dbConection,$selectCmd);
                if(mysqli_num_rows($result)>0){
                    echo "<table class='table'><thead><tr class='table-dark'><th>Book</th><th>Book Description</th><th>Book Price</th><th>Likes</th><th colspan=2 >Actions</th></tr></thead><tbody>";
                    while($row=mysqli_fetch_assoc($result)){
                        echo "<tr class='border-secondary'><td>".$row['b_title']."</br>By: ".$row['b_author']."</td>";
                        echo "<td>".$row['b_description']."</td>";
                        echo "<td>".$row['b_price']."CAD</td>";
                        echo "<td>".$row['b_like']."</td>";
                        echo "<td><a class='btn btn-primary' href='".parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH)."?id=".$row['b_id']."&action=edit'>Edit</a></td>";
                        echo "<td><a class='btn btn-danger' href='".parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH)."?id=".$row['b_id']."&action=del'>Delete</a></td></tr>";
                    }
                    echo "</tbody></table>";
                }
            }
            else{
                $selectCmd = "SELECT * FROM book_tb WHERE b_type = 0";
                $result=mysqli_query($dbConection,$selectCmd);
                if(mysqli_num_rows($result)>0){
                    echo "<table class='table'><thead><tr class='table-dark'><th>Book</th><th>Book Description</th><th>Book Price</th><th>Likes</th><th colspan=2 >Actions</th></tr></thead><tbody>";
                    while($row=mysqli_fetch_assoc($result)){
                        echo "<tr class='border-secondary'><td>".$row['b_title']."</br>By: ".$row['b_author']."</td>";
                        echo "<td>".$row['b_description']."</td>";
                        echo "<td>".$row['b_price']."CAD</td>";
                        echo "<td>".$row['b_like']."</td>";
                        echo "<td><a class='btn btn-primary' href='".parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH)."?id=".$row['b_id']."&action=edit'>Edit</a></td>";
                        echo "<td><a class='btn btn-danger' href='".parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH)."?id=".$row['b_id']."&action=del'>Delete</a></td></tr>";
                    }
                    echo "</tbody></table>";
                }
            }
        ?>
    </article>
</section>