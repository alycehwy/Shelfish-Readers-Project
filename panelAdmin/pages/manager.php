<?php
    if(isset($_GET['id']) && isset($_GET['action'])){
        $id = $_GET['id'];
        if($dbConection->connect_error){
            die("Connection error");
        }
        else{
            switch($_GET['action']){
                case "del":
                    $delCmd = "DELETE FROM user_tb WHERE user_id = $id";
                    if($dbConection -> query($delCmd) === true){
                        echo "<script>alert('User Deleted')</script>";
                    }
                    else{
                        echo "<script>alert('Action failed')</script>";
                    }
                    break;
                case "edit":
                    $selectuser = "SELECT * FROM user_tb WHERE user_id = $id";
                    $result = $dbConection -> query($selectuser);
                    $_SESSION['userData'] = $result->fetch_assoc();
                    header("Location: edituser");

            }
            $dbConection->close();
        }
    }
?>
<main>
    <section>
        <table border="1">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>User Name</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>email</th>
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
                    $selectCmd = "SELECT * FROM user_tb WHERE title = 'user'";
                    $result = $dbConection->query($selectCmd);
                    while($row = $result->fetch_assoc()){
                        echo "<tr>";
                        echo "<td>".$row['user_id']."</td>";
                        echo "<td>".$row['username']."</td>";
                        echo "<td>".$row['first_name']."</td>";
                        echo "<td>".$row['last_name']."</td>";
                        echo "<td>".$row['email']."</td>";
                        echo "<td><a class='btn btn-primary' href='".parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH)."?id=".$row['user_id']."&action=edit'>Edit</a></td>";
                        echo "<td><a class='btn btn-danger' href='".parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH)."?id=".$row['user_id']."&action=del'>Delete</a></td>";
                        echo "</tr>";
                    }
                    $dbConection->close();
                }
            ?>
            </tbody>
        </table>
    </section>
</main>