<?php
$con = mysqli_connect("localhost","root","","1sdb");
if(!$con)
    die("Connection failed");

$name='';
$email ='';
$username='';
$phonenumber='';
$pass = '';
$repass='1';
if(isset($_POST['register'])){
    $name=$_POST['name'];
    $email = $_POST['email'];
    $username=$_POST['username'];
    $phonenumber=$_POST['phonenumber'];
    $pass = $_POST['password'];
    $repass=$_POST['repassword'];
}
$sql_u = "SELECT * FROM register WHERE username='$username'";
$sql_e = "SELECT * FROM register WHERE email='$email'";
$res_u = mysqli_query($con, $sql_u);
$res_e = mysqli_query($con, $sql_e);

if (mysqli_num_rows($res_u) > 0) {
    $name_error = "Sorry... username already taken";
}else if(mysqli_num_rows($res_e) > 0){
    $email_error = "Sorry... email already taken";
}
if($pass!=$repass)
{
    echo 'password error';
}
$insert_data = "INSERT INTO 'register'('name', 'email', 'username', 'phonenumber', 'password') VALUES ($name,$email,$username,$phonenumber,$pass)";
$insert_logins="INSERT INTO 'logins'('email', 'username', 'password', 'rank') VALUES ($email,$username,$pass,'user')";
$reg_data = mysqli_query($con, $insert_data);
$log_data=mysqli_query($con,@$insert_logins);
if ($insert_data && $insert_logins) {
    //header("location: ".$_SERVER['PHP_SELF']);
    $response = array(
        "type" => "success",
        "message" => "Registered successfully."
    );
}
else {
    $response = array(
        "type" => "warning",
        "message" => "Problem in Registering."
    );
}

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SUFI 1's Register</title>
    <link rel="icon" type="image/png" href="images/icons/sufi1icon.png">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/icons.css">
    <link rel="stylesheet" type="text/css" href="css/min.css">
    <link rel="stylesheet" type="text/css" href="css/util.css">

</head>
<body>


<div class="head">
    <a class="home" href="index.php" style="color: whitesmoke" translate="yes">
        <img  src="images/icons/sufi1icon.png" alt="Home" title="Home" style="color: transparent" >
    </a>
    <div class="name" >
        SUFI 1's Register
    </div>
    <div class="sign">
        Already Have Account:
        <a href="login.php" style="color: black">Login </a>
    </div>
</div>


<div class="body">

    <div class="reg-container">

        <div class="wrap-reg">

            <form class="register"action="register.php" method="post">

                        <span class="reg-form-title p-b-37">
                            Register
                        </span>

                <div class="wrap-input validate-input-e m-b-20" data-validate="Enter Your Name">
                    <input class="input" type="text" id="name" name="name" placeholder="name" pattern="^\w(\-|\_)*">
                    <span class="focus-input"></span>
                </div>

                <div class="wrap-input validate-input-e m-b-20" data-validate="Enter email">
                    <input class="input" type="text" id="email" name="email" placeholder="email" pattern="^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$">
                    <span class="focus-input"></span>
                </div>

                <div class="wrap-input validate-input-e m-b-20" data-validate="Select a Username">
                    <input class="input" type="text" id="username" name="username" placeholder="username" pattern="^([a-zA-Z0-9_\-\.]+)">
                    <span class="focus-input"></span>
                </div>

                <div class="wrap-input validate-input-e m-b-20" data-validate="Enter a Phone Number">
                    <input class="input" type="number" id="phonenumber"  name="phone number" placeholder="Phone Number" pattern="^(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{7})$">
                    <span class="focus-input"></span>
                </div>

                <div class="wrap-input validate-input-p m-b-25" data-validate = "Enter password">
                    <input class="input" type="password" id="password"  name="pass" placeholder="password" pattern="^([\w\d]{6,})">
                    <span class="focus-input"></span>
                </div>

                <div class="wrap-input validate-input-e m-b-20" data-validate="ReEnter password">
                    <input class="input" type="password" id="repassword" name="pass" placeholder="re_enter password" pattern="^([\w\d]{6,})">
                    <span class="focus-input"></span>
                </div>

                <div class="w-reg-form-btn">
                    <button type="submit" class="reg-form-btn" id="register">
                        Register
                    </button>
                </div>

            </form>

        </div>

    </div>


</div>

</body>
<footer style="align-items: baseline">
    Developed by <b> SUFI 1's Developer</b> <br>
    <a href="about.html" style="color: black">About </a>|
    <a href="contact.html" style="color: black"> Contact</a> <br>
    Copyrights &copy; 2019 All rights reserved.
</footer>
</html>
