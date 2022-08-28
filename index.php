<?php
    include './config.php';
    
    $loginError = 'noshow';
    $fileHandler = fopen('./files/user.json','r');
    $jsonData = json_decode(fread($fileHandler,filesize('./files/user.json')));
    fclose($fileHandler);
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $username = $_POST['username'];
        $password = $_POST['password'];
        foreach($jsonData as $array){
            if($array->username == $username){
                if($array->password == $password){
                    $error = 'noshow';
                    header("Location: http://localhost/PHP/Final/");
                    break;
                }
                else{
                    $loginError = 'show';
                }
            }
            else{
                $loginError = 'show';
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
    <title>Shelfish Readers Libaray</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body class="loginPage">
    <header>
        <h1>Shelfish Readers Libaray Manager System</h1>
    </header>
    <main class="login">
        <form method="POST" action="<?php $_SERVER['PHP_SELF'];?>">
            <fieldset>
                <legend>Log In</legend>
                <div class="info">
                    <label>Username: </label>
                    <input type="text" name="username" placeholder="Type your username" />
                    <label>Password: </label>
                    <input type="password" name="password" placeholder="Type your password" />
                </div>
                <p class="error <?php echo $loginError ?>">*username/password invalid</p>
                <div class="checkbox">
                    <input type="checkbox" />
                    <label>Remember Me</label>
                </div>
                <button type="submit">Log in</button>
                <div class="reg">
                    <p>Not a member?</p>
                    <a href="./register.php">Register</a>
                </div>
            </fieldset>
        </form>
    </main>
    <footer>
        <span>Copyright &copy; 2022 AMS Company | Disign by Alyce, Marcelo, Samridh</span>
    </footer>
</body>
</html>