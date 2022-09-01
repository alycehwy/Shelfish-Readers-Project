<section class="main_content">
    <article class="curbrw_body">
        <h3>Current Borrow</h3>
        <table class="table">
            <thead>
                <tr class="table-dark">
                    <th>Borrow #</th>
                    <th>Book ID</th>
                    <th>Book Name</th>
                    <th>Book Author</th>
                    <th>Issue Date</th>
                    <th>Expiry Date</th>
                    <th colspan=2 >Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $dbConection = new mysqli($dbServername,$dbUsername,$dbPass,$dbname);           
                if($dbConection->connect_error){
                    die("Connection error");
                }
                else{
                    $bookSelect = "SELECT * FROM borrow_tb INNER JOIN books_tb ON borrow_tb.b_id = books_tb.b_id INNER JOIN user_tb ON borrow_tb.user_id = user_tb.user_id";
                    $result = $dbConection->query($bookSelect);
                    while($row = $result->fetch_assoc()){
                        if($row['status'] == 'borrowing'){
                            if($row['username'] == $_SESSION['username']){
                                echo "<tr class='border-secondary'>";
                                echo "<td>".$row['borrow_id']."</td>";
                                echo "<td>".$row['b_id']."</td>";
                                echo "<td>".$row['b_title']."</td>";
                                echo "<td>".$row['b_author']."</td>";
                                echo "<td>".$row['issue_date']."</td>";
                                echo "<td>".$row['expiry_date']."</td>";
                                echo "<td><a class='btn btn-primary' href='".parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH)."?borrow_id=".$row['borrow_id']."&action=return'>Return</a></td>";
                                echo "<td><a class='btn btn-warning' href='".parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH)."?borrow_id=".$row['borrow_id']."&action=extend'>Extend</a></td>";
                                echo "</tr>";
                            }
                        }
                    }
                    $dbConection->close();
                }
            ?>
            </tbody>
        </table>
    </article>
</section>