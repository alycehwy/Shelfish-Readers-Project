<?php
    include './config.php';
    session_start();
    // if(!isset($_SESSION['userData'])){
    //     header("Location: http://localhost/teamProject/1.php");
    // }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        if($_SERVER['REQUEST_METHOD']=="POST"){
            $dbcon = new mysqli($dbServername,$dbUsername,$dbPass,$dbName);
            $updateCmd = "UPDATE books_tb SET b_likes='".$_POST['b_likes']."' WHERE b_id=".$_POST['b_id'];
            if($dbcon->query($updateCmd) === true){
                $dbcon->close();
                unset($_SESSION['userData']);
                header("Location: http://localhost/teamProject/1.php");
            }
        }
    ?>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <?php
            foreach($_SESSION['userData'] as $_POST['b_likes']){
                $label = $fieldName;
                switch($fieldName){
                    case "dob":
                        $type = "date";
                        $label = "date of birth";
                    break;
                }
            }
        ?>
        <button type="submit">Update</button>
    </form>
</body>
</html>