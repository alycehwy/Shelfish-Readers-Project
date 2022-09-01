<?php
    if(isset($_GET['borrow_id']) && isset($_GET['action'])){
        $borrow_id = $_GET['borrow_id'];
        if($dbConection->connect_error){
            die("Connection error");
        }
        else{
            switch($_GET['action']){
                case "accept":
                    $selectCmd = "SELECT * FROM borrow_tb WHERE borrow_id = $borrow_id";
                    $selectresult = $dbConection -> query($selectCmd);
                    $row = $result->fetch_assoc();
                    $startDate = $row['expiry_date'];
                    $expiryDate = date("Y-m-d",strtotime($startDate)+30*86400);
                    $updateCmd = "UPDATE borrow_tb SET expiry_date = '".$expiryDate."' WHERE borrow_id = $borrow_id";
                    $result = $dbConection-> query($updateCmd);
                    if($result === true){
                        echo "<script>alert('Accept the Request')</script>";
                    }else{
                        echo "<script>alert('Action failed')</script>";
                    }
                    break;
                case "reject":
                    $updateCmd = "UPDATE borrow_tb SET status = 'borrowing'  WHERE borrow_id = $borrow_id";
                    $result = $dbConection-> query($updateCmd);
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
    <article class="reqextend_body">
        <h3>Extend Request</h3>
        <table class="table">
            <thead>
                <tr class="table-dark">
                    <th>Borrow #</th>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Book ID</th>
                    <th>Book Name</th>
                    <th>Book Author</th>
                    <th>Extend Times</th>
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
                        if($row['status'] == 'extending'){
                            echo "<tr class='border-secondary'>";
                            echo "<td>".$row['borrow_id']."</td>";
                            echo "<td>".$row['user_id']."</td>";
                            echo "<td>".$row['username']."</td>";
                            echo "<td>".$row['b_id']."</td>";
                            echo "<td>".$row['b_title']."</td>";
                            echo "<td>".$row['b_author']."</td>";
                            echo "<td>".$row['extend_times']."</td>";
                            echo "<td><a class='btn btn-primary' href='".parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH)."?borrow_id=".$row['borrow_id']."&action=accept'>Accept</a></td>";
                            echo "<td><a class='btn btn-danger' href='".parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH)."?borrow_id=".$row['borrow_id']."&action=reject'>Reject</a></td>";
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