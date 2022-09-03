<?php
    if(isset($_GET['borrow_id']) && isset($_GET['action'])){
        $borrow_id = $_GET['borrow_id'];
        if($dbConection->connect_error){
            die("Connection error");
        }
        else{
            switch($_GET['action']){
                case "return":
                    $updatebrw = "UPDATE borrow_tb SET status = 'returning' WHERE borrow_id = $borrow_id ";
                    $resultbrw = $dbConection-> query($updatebrw);
                    if($resultbrw === true){
                        echo "<script>alert('Send the return request success')</script>";
                    }else{
                        echo "<script>alert('Action failed')</script>";
                    }
                    break;
                case "extend":
                    $updatebrw = "UPDATE borrow_tb SET status = 'extending' WHERE borrow_id = $borrow_id ";
                    $result = $dbConection-> query($updatebrw);
                    if($result === true){
                        echo "<script>alert('Send the extend request success')</script>";
                    }else{
                        echo "<script>alert('Action failed')</script>";
                    }
                    break;            
            }
            $dbConection->close();
        }
    }
?>
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
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $dbConection = new mysqli($dbServername,$dbUsername,$dbPass,$dbname);           
                if($dbConection->connect_error){
                    die("Connection error");
                }
                else{
                    $selectCmd = "SELECT * FROM user_tb WHERE username = '".$_SESSION['username']."' AND title = 'user'";
                    $result = $dbConection->query($selectCmd);
                    $row = $result->fetch_assoc();
                    $bookSelect = "SELECT * FROM borrow_tb INNER JOIN books_tb ON borrow_tb.b_id = books_tb.b_id INNER JOIN user_tb ON borrow_tb.buser_id = user_tb.user_id WHERE borrow_tb.buser_id = ".$row['user_id']." AND borrow_tb.status !='borrowed'";
                    $result = $dbConection->query($bookSelect);
                    while($row = $result->fetch_assoc()){
                        echo "<tr class='border-secondary'>";
                        echo "<td>".$row['borrow_id']."</td>";
                        echo "<td>".$row['b_id']."</td>";
                        echo "<td>".$row['b_title']."</td>";
                        echo "<td>".$row['b_author']."</td>";
                        echo "<td>".$row['issue_date']."</td>";
                        echo "<td>".$row['expiry_date']."</td>";
                        switch($row['status']){
                            case "borrowing":
                                echo "<td class='curbrwAction'><a class='btn btn-primary' href='".parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH)."?borrow_id=".$row['borrow_id']."&action=return'>Return</a>";
                                echo "<a class='btn btn-success' href='".parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH)."?borrow_id=".$row['borrow_id']."&action=extend'>Extend</a></td>";
                                echo "</tr>";
                                break;
                            case "requesting":
                                echo "<td><a class='btn btn-warning disabled'>Requsting</a></td>";
                                break;
                            case "returning":
                                echo "<td><a class='btn btn-warning disabled'>Returning</a></td>";
                                break;
                            case "extending":
                                echo "<td><a class='btn btn-warning disabled'>Extending</a></td>";
                                break;
                        }
                    }
                    $dbConection->close();
                }
            ?>
            </tbody>
        </table>
    </article>
</section>