<?php
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $email = $_POST['email'];
        $email = filter_var($email,FILTER_SANITIZE_EMAIL);
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            echo "<script>alert('Invalid Email')</script>";
        }
        else{
            
        }
    }
?>
<section class="main_content">
    <article class="donate_body">
        <h3>Donate Form</h3>
        <form method="POST" action="<?php $_SERVER['PHP_SELF'];?>">
            <div>
                <label for="firstName" class='form-label'>First Name: </label>
                <input type="text" class='form-control' name="firstName" placeholder="First Name" />
            </div>
            <div>
                <label for="lastName" class='form-label'>Last Name: </label>
                <input type="text" class='form-control' name="lastName" placeholder="Last Name" />
            </div>
            <div>
                <label for="email" class='form-label'>Email: </label>
                <input type="email" class='form-control' name="email" placeholder="Email" />
            </div>
            <div>
                <label for="donateTo" class='form-label'>Donate Amoumt: </label>
                <!-- <select name='donateTo'>
                    <option value="">Choose the amount you want to donate</option>
                    <option value="50">$50</option>
                    <option value="100">$100</option>
                    <option value="200">$200</option>
                    <option value="500">$500</option>
                </select> -->
                <input type="text" class='form-control' name="donateTo" placeholder="Put the amount you want to donate" />
            </div>
            <div class="donateBtn">
                <button type="submit" class="btn btn-primary">Donate</button>
            </div>
        </form>
    </article>
</section>
