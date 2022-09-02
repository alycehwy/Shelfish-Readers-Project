<?php
    include './config.php';
    session_unset();
    $loginError = 'noshow';
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $username = $_POST['username'];
        $password = $_POST['password'];
        if($dbConection -> connect_error){
            die("Connection error");
        }
        else{
            $selectCmd = "SELECT * FROM user_tb WHERE username='$username';";
            $result = $dbConection->query($selectCmd);
            if($result-> num_rows > 0){
                $user = $result -> fetch_assoc();
                $hashedPass = $user['password'];
                if(password_verify($password,$hashedPass)){
                    if($user['title'] == 'admin'){
                        $_SESSION['username'] = $username;
                        header("location:panelAdmin/");
                    }
                    else{
                        $_SESSION['username'] = $username;
                        header("location:panelUser/");
                    }
                }
                else{
                    $loginError = 'show';
                }
            }
            else{
                $loginError = 'show';
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
    <title>Shelfish Readers Libaray</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body class="loginPage">
    <header>
        <h1>Shelfish Readers Libaray</h1>
    </header>
    <main class="login">
        <form method="POST" action="<?php $_SERVER['PHP_SELF'];?>">
            <fieldset class="border border-2">
                <div class="info">
                    <div>
                        <label class='form-label'>Username: </label>
                        <input type="text" class='form-control' name="username" placeholder="Type your username" required/>
                    </div>
                    <div>
                        <label class='form-label'>Password: </label>
                        <input type="password" class='form-control' name="password" placeholder="Type your password" required/>
                    </div>
                </div>
                <p class="error <?php echo $loginError ?>">*username/password invalid</p>
                <!-- <div class="checkbox">
                    <input type="checkbox" />
                    <label>Remember Me</label>
                </div> -->
                <button type="submit" class="btn btn-secondary">Log in</button>
                <div class="reg">
                    <p>Not a member?</p>
                    <a href="./register.php" class="link-dark">Register</a>
                </div>
            </fieldset>
        </form>
    </main>
    <footer>
        <span>Copyright &copy; 2022 AMS Company | Disign by Alyce, Marcelo, Samridh</span>
    </footer>
</body>
</html>