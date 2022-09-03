<section class="main_content">
    <article class="brwrec_body">
        <h3>Borrowed Record</h3>
        <table class="table">
            <thead>
                <tr class="table-dark">
                    <th>Borrow #</th>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Book ID</th>
                    <th>Book Name</th>
                    <th>Book Author</th>
                    <th>Issue Date</th>
                    <th>Return Date</th>
                </tr>
            </thead>
            <tbody>
            <?php
                if($dbConection->connect_error){
                    die("Connection error");
                }
                else{
                    $bookSelect = "SELECT * FROM borrow_tb INNER JOIN book_tb ON borrow_tb.b_id = book_tb.b_id INNER JOIN user_tb ON borrow_tb.buser_id = user_tb.user_id";
                    $result = $dbConection->query($bookSelect);
                    while($row = $result->fetch_assoc()){
                        if($row['status'] == 'borrowed'){
                            echo "<tr class='border-secondary'>";
                            echo "<td>".$row['borrow_id']."</td>";
                            echo "<td>".$row['buser_id']."</td>";
                            echo "<td>".$row['username']."</td>";
                            echo "<td>".$row['b_id']."</td>";
                            echo "<td>".$row['b_title']."</td>";
                            echo "<td>".$row['b_author']."</td>";
                            echo "<td>".$row['issue_date']."</td>";
                            echo "<td>".$row['return_date']."</td>";
                            echo "</tr>";
                        }
                    }
                    $dbConection->close();
                }
            ?>
            </tbody>
        </table>
    </article>
</section>