<?php
    include './config.php';
    
    $pwError = 'noshow';
    $pwValid = 'noshow';
    $userError = 'noshow';
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $cPassword = $_POST['cPassword'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];

        if($dbConection -> connect_error){
            die("Connection error");
        }
        else{
            $selectCmd = "SELECT * FROM `user_tb` WHERE username='$username';";
            $result = $dbConection->query($selectCmd);
            if($result-> num_rows <= 0){
                // Validate password strength
                $uppercase = preg_match('@[A-Z]@', $password);
                $lowercase = preg_match('@[a-z]@', $password);
                $number = preg_match('@[0-9]@', $password);
                $specialChars = preg_match('@[^\w]@', $password);
                if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
                    $pwValid = 'show';
                }else{
                    if($cPassword == $password){
                        $password =  password_hash($_POST['password'],PASSWORD_BCRYPT,["cost"=>9]);
                        $insertCmd = "INSERT INTO user_tb (username, password, first_name, last_name, email, title) VALUES ('".$username."', '".$password."', '".$firstName."', '".$lastName."', '".$email."','user')";
                        $result = $dbConection-> query($insertCmd);
                        if($result === true){
                            // echo "<h1 style ='color: green;'>Register success!</h1>";
                            header("Location: http://localhost/PHP/Final/");
                        }else{
                            echo "<h1 style ='color: red;'>".$dbConection->error."</h1>";
                        }
                    }
                    else{   
                        $pwError = 'show';
                    }
                } 
            }
            else{
                $userError = 'show';
            }
            $dbConection -> close();
        }
    }
?>    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body class="register">
    <form method="POST" action="<?php $_SERVER['PHP_SELF'];?>">
        <fieldset>
            <legend>Register Infomation</legend>
            <div class="registerInfo">
                <label>Username: </label>
                <input type="text" name="username" placeholder="username" required/>
                <label>Password: </label>
                <input type="password" name="password" placeholder="Password" required/>
                
                <label>Confirm Password: </label>
                <input type="password" name="cPassword" placeholder="Confirm Password" required/>
                <label>First Name: </label>
                <input type="text" name="firstName" placeholder="First Name" required/>
                <label>Last Name: </label>
                <input type="text" name="lastName" placeholder="Last Name" required/>
                <label>Email: </label>
                <input type="email" name="email" placeholder="Email" required/>
            </div>
            <p class="error <?php echo $userError ?>">*Username already existed</p>
            <p class="error <?php echo $pwValid ?>">*Password should be at least 8 characters in length and include at least one upper case letter, one number, and one special character</p>
            <p class="error <?php echo $pwError ?>">*Password mismatch</p>
            <button type="submit">Register</button>
        </fieldset>
    </form>
</body>
</html>