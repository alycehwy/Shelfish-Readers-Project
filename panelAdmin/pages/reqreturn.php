<?php
    if(isset($_GET['borrow_id']) && isset($_GET['b_id']) && isset($_GET['action'])){
        $borrow_id = $_GET['borrow_id'];
        $b_id = $_GET['b_id'];
        if($dbConection->connect_error){
            die("Connection error");
        }
        else{
            switch($_GET['action']){
                case "accept":
                    $returnDate = date("Y-m-d");
                    $updatebrw = "UPDATE borrow_tb SET return_date = '".$returnDate."' ,status = 'borrowed'  WHERE borrow_id = $borrow_id";
                    $updatebook = "UPDATE book_tb SET b_available = '1' WHERE b_id = $b_id";
                    $resultbrw = $dbConection-> query($updatebrw);
                    $resultbook = $dbConection-> query($updatebook);
                    if($resultbrw === true && $resultbook === true){
                        echo "<script>alert('Accept the Request')</script>";
                    }else{
                        echo "<script>alert('Action failed')</script>";
                    }
                    break;
                case "reject":
                    $updatebrw = "UPDATE borrow_tb SET status = 'borrowing'  WHERE borrow_id = $borrow_id";
                    $result = $dbConection-> query($updatebrw);
                    if($result === true){
                        echo "<script>alert('Reject the Request')</script>";
                    }else{
                        echo "<script>alert('Action failed')</script>";
                    }

            }
            $dbConection->close();
        }
    }
?>
<section class="main_content">
    <article class="reqreturn_body">
        <h3>Return Request</h3>
        <table class="table">
            <thead>
                <tr class="table-dark">
                    <th>Borrow #</th>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Book ID</th>
                    <th>Book Name</th>
                    <th>Book Author</th>
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
                    $bookSelect = "SELECT * FROM borrow_tb INNER JOIN book_tb ON borrow_tb.b_id = book_tb.b_id INNER JOIN user_tb ON borrow_tb.buser_id = user_tb.user_id  WHERE borrow_tb.status = 'returning'";
                    $result = $dbConection->query($bookSelect);
                    while($row = $result->fetch_assoc()){
                        if($row['status'] == 'returning'){
                            echo "<tr class='border-secondary'>";
                            echo "<td>".$row['borrow_id']."</td>";
                            echo "<td>".$row['buser_id']."</td>";
                            echo "<td>".$row['username']."</td>";
                            echo "<td>".$row['b_id']."</td>";
                            echo "<td>".$row['b_title']."</td>";
                            echo "<td>".$row['b_author']."</td>";
                            echo "<td><a class='btn btn-primary' href='".parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH)."?borrow_id=".$row['borrow_id']."&b_id=".$row['b_id']."&action=accept'>Accept</a></td>";
                            echo "<td><a class='btn btn-danger' href='".parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH)."?borrow_id=".$row['borrow_id']."&b_id=".$row['b_id']."&action=reject'>Reject</a></td>";
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