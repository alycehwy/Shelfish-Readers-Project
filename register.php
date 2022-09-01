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
        $email = filter_var($email,FILTER_SANITIZE_EMAIL);
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            echo "<script>alert('Invalid Email')</script>";
        }
        else{
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
                                echo "<script>alert('Register Success')</script>";
                                header("Refresh:0.01; url=http://localhost/", true);
                            }else{
                                echo "<script>alert('.$dbConection->error.')</script>";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="register">
    <form method="POST" action="<?php $_SERVER['PHP_SELF'];?>">
        <fieldset>
            <legend>Register Infomation</legend>
            <div class="registerInfo">
                <div>
                    <label class='form-label'for="username">Username: </label>
                    <input type="text" class='form-control' name="username" placeholder="username" required/>
                </div>
                <div>
                    <label class='form-label'for="password">Password: </label>
                    <input type="password" class='form-control' name="password" placeholder="Password" required/>
                </div>
                <div>
                    <label class='form-label'for="cPassword">Confirm Password: </label>
                    <input type="password" class='form-control' name="cPassword" placeholder="Confirm Password" required/>
                </div>
                <div>
                    <label class='form-label'for="firstName">First Name: </label>
                    <input type="text" class='form-control' name="firstName" placeholder="First Name" required/>
                </div>
                <div>
                    <label class='form-label'for="lastName">Last Name: </label>
                    <input type="text" class='form-control' name="lastName" placeholder="Last Name" required/>
                </div>
                <div>
                    <label class='form-label'for="email">Email: </label>
                    <input type="email" class='form-control' name="email" placeholder="Email" required/>
                </div>
            </div>
            <p class="error <?php echo $userError ?>">*Username already existed</p>
            <p class="error <?php echo $pwValid ?>">*Password should be at least 8 characters in length and include at least one upper case letter, one number, and one special character</p>
            <p class="error <?php echo $pwError ?>">*Password mismatch</p>
            <div class="registerBtn">
                <button type="submit" class="btn btn-primary">Register</button>
                <button type="button" class="btn btn-secondary"><a  class="link-light" href='<?php echo "/"; ?> '>Back</a></button>
            </div>
        </fieldset>
    </form>
</body>
</html>