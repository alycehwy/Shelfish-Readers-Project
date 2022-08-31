<main>
    <form  method='POST' action='<?php echo parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);?>'>
        <input type="search" class='search'name="search" required/>
        <input type="submit" name="submit" class='search-submit'value='Search' required/>
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
                echo "<table border='3'><thead><tr><th>Book</th><th>Book Description</th><th>Book Price</th><th>Likes</th></tr></thead><tbody>";
                while($row=mysqli_fetch_assoc($result)){
                    echo "<tr><td>".$row['b_title']."</br>By: ".$row['b_author']."</td>";
                    echo "<td>".$row['b_description']."</td>";
                    echo "<td>".$row['b_price']."CAD</td>";
                    echo "<td>".$row['b_likes']."</td></tr>";
                }
                echo "</tbody></table>";
            }
        }
    ?>
</main>