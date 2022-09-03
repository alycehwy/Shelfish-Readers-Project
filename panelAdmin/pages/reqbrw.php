<?php
    if(isset($_GET['borrow_id']) && isset($_GET['action'])){
        $borrow_id = $_GET['borrow_id'];
        if($dbConection->connect_error){
            die("Connection error");
        }
        else{
            switch($_GET['action']){
                case "accept":
                    $startDate = date("Y-m-d");
                    $expiryDate = date("Y-m-d",strtotime($startDate)+30*86400);
                    $updatebrw = "UPDATE borrow_tb SET issue_date = '".$startDate."', expiry_date = '".$expiryDate."' ,status = 'borrowing' WHERE borrow_id = $ ";
                    $updatebook = "UPDATE books_tb SET available = 'false' WHERE borrow_id = $borrow_id";
                    $resultbrw = $dbConection-> query($updatebrw);
                    $resultbook = $dbConection-> query($updatebook);
                    if($resultbrw === true && $resultbook === true){
                        echo "<script>alert('Accept the Request')</script>";
                    }else{
                        echo "<script>alert('Action failed')</script>";
                    }
                    break;
                case "reject":
                    $updatebrw = "UPDATE borrow_tb SET status = 'rejected' WHERE borrow_id = $borrow_id";
                    $delebrw = "DELETE FROM borrow_tb WHERE  borrow_id = $borrow_id";
                    $result = $dbConection-> query($updatebrw);
                    $delresult = $dbConection-> query($delebrw);
                    if($result === true && $delresult == true){
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
    <article class="reqbrw_body">
        <h3>Borrow Request</h3>
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
                    $bookSelect = "SELECT * FROM borrow_tb INNER JOIN books_tb ON borrow_tb.b_id = books_tb.b_id INNER JOIN user_tb ON borrow_tb.user_id = user_tb.user_id";
                    $result = $dbConection->query($bookSelect);
                    while($row = $result->fetch_assoc()){
                        if($row['status'] == 'requesting'){
                            echo "<tr class='border-secondary'>";
                            echo "<td>".$row['borrow_id']."</td>";
                            echo "<td>".$row['user_id']."</td>";
                            echo "<td>".$row['username']."</td>";
                            echo "<td>".$row['b_id']."</td>";
                            echo "<td>".$row['b_title']."</td>";
                            echo "<td>".$row['b_author']."</td>";
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