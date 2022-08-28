<?php
    class register{
        private $userid;
        private $username;
        private $password;
        private $firstName;
        private $lastName;
        private $email;
        function __construct($userid,$username,$password,$firstName,$lastName,$email)
        {
            $this->userid = $userid;
            $this->username = $username;
            $this->password = $password;
            $this->firstName = $firstName;
            $this->lastName = $lastName;
            $this->email = $email;
        }
        function writeToJson(){
            return array("userid"=> $this->userid, "username"=> $this->username,"password"=> $this->password,"first_name"=> $this->firstName,"last_name"=> $this->lastName,"email"=> $this->email);
        }
    }
    $pwError = 'noshow';
    $pwValid = 'noshow';
    $userError = 'noshow';
    $fileHandler = fopen('./files/user.json','r');
    $jsonData = json_decode(fread($fileHandler,filesize('./files/user.json')));
    fclose($fileHandler);
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $cPassword = $_POST['cPassword'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        foreach($jsonData as $array){
            if($array->username != $username){
                $checkUser = true;
            }
            else{
                $userError = 'show';
                $checkUser = false;
                break;
            }
        }
        if($checkUser){
            // Validate password strength
            $uppercase = preg_match('[A-Z]', $password);
            $lowercase = preg_match('[a-z]', $password);
            $number    = preg_match('[0-9]', $password);
            $specialChars = preg_match('[^\w]', $password);
            
    
            if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
                echo $pwValid = 'show';
            }else{
                if($cPassword == $password){        
                    $userid = ($jsonData[count($jsonData)-1]->EmployeeID) + 1;
                    $passHash=  password_hash($password,PASSWORD_BCRYPT,["cost"=>9]);
                    $new = new register($userid,$username,$passHash,$firstName,$lastName,$email);
                    array_push($jsonData,$new->writeToJson());
                    $fileHandler = fopen('./files/user.json','w');
                    $newData = json_encode($jsonData);
                    fwrite($fileHandler,$newData);
                    fclose($fileHandler);
                    header("Location: http://localhost/PHP/Final/");
                }
                else{   
                    $pwError = 'show';
                }
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
</head>
<body class="register">
    <form method="POST" action="<?php $_SERVER['PHP_SELF'];?>">
        <fieldset>
            <legend>Register Infomation</legend>
            <div class="registerInfo">
                <label>Username: </label>
                <input type="text" name="username" placeholder="username" />
                <label>Password: </label>
                <input type="password" name="password" placeholder="Password" />
                <p class="error <?php echo $pwValid ?>">*Password should be at least 8 characters in length and include at least one upper case letter, one number, and one special character</p>
                <label>Confirm Password: </label>
                <input type="password" name="cPassword" placeholder="Confirm Password" />
                <label>First Name: </label>
                <input type="text" name="firstName" placeholder="First Name" />
                <label>Last Name: </label>
                <input type="text" name="lastName" placeholder="Last Name" />
                <label>Email: </label>
                <input type="email" name="email" placeholder="Email" />
            </div>
            <p class="error <?php echo $pwError ?>">*Password mismatch</p>
            <p class="error <?php echo $userError ?>">*Username already existed</p>
            <button type="submit">Register</button>
        </fieldset>
    </form>
</body>
</html>