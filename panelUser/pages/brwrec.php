<main>
    <section>
        <table border="1">
            <thead>
                <tr>
                    <th>Borrow #</th>
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
                    $bookSelect = "SELECT * FROM borrow_tb INNER JOIN books_tb ON borrow_tb.b_id = books_tb.b_id INNER JOIN user_tb ON borrow_tb.user_id = user_tb.user_id";
                    $result = $dbConection->query($bookSelect);
                    while($row = $result->fetch_assoc()){
                        if($row['status'] == 'borrowed'){
                            if($row['username'] == $_SESSION['username']){
                                echo "<tr>";
                                echo "<td>".$row['borrow_id']."</td>";
                                echo "<td>".$row['b_id']."</td>";
                                echo "<td>".$row['b_title']."</td>";
                                echo "<td>".$row['b_author']."</td>";
                                echo "<td>".$row['issue_date']."</td>";
                                echo "<td>".$row['return_date']."</td>";
                                echo "</tr>";
                            }
                        }
                    }
                    $dbConection->close();
                }
            ?>
            </tbody>
        </table>
    </section>
</main>