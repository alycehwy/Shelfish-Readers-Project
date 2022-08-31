<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donate</title>
</head>
<body class="donate">
    <form method="POST" action="<?php $_SERVER['PHP_SELF'];?>">
        <fieldset>
            <legend>Donate Now</legend>
            <div class="donateInfo">
                <label>First Name: </label>
                <input type="text" name="firstName" placeholder="First Name" />
                <label>Last Name: </label>
                <input type="text" name="lastName" placeholder="Last Name" />
                <label>Email: </label>
                <input type="email" name="email" placeholder="Email" />
                <label>Donate to where: </label>
                <select name='donateTo'>
                    <option value="">Choose the mechanism you want to donate</option>
                    <option value=""></option>
                    <option value=""></option>
                    <option value=""></option>
                    <option value=""></option>
                </select>

            </div>
            <button type="submit">Donate</button>
        </fieldset>
    </form>
</body>
</html>