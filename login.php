<?php
session_start();
require_once 'db_connection.php';
$error_msg = '';
if(isset($_POST['login'])){
    $email = $_POST['username'];
    $pass = $_POST['pass'];
    $sel_user = "select * from logins where username='$email' AND password='$pass'";
    $run_user = mysqli_query($con, $sel_user);
    $check_user = mysqli_num_rows($run_user);
    if($check_user==0){
        $error_msg = 'Password or Email is wrong, try again';
    }
    else{
        $_SESSION['user_email'] = $email;
        if(!empty($_POST['remember'])) {
            setcookie('username', $email, time() + (10 * 365 * 24 * 60 * 60));
            setcookie('pass', $pass, time() + (10 * 365 * 24 * 60 * 60));
        } else {
            setcookie('username','' );
            setcookie('pass', '');
        }
        header('location:index.php?logged_in=You have successfully logged in!');
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SUFI 1's Login</title>
    <link rel="icon" type="image/png" href="images/icons/sufi1icon.png"/>
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
        SUFI 1's Login
    </div>
    <div class="sign">
        Don't Have any Account:
        <a href="register.php" style="color: black"> Register</a>
    </div>
</div>

<div class="body">

    <div class="login-container">

        <div class="wrap-login">
        <form class="login" action="login.php" method="post">

                        <span class="login-form-title p-b-37">
                            Log In
                        </span>

            <div class="wrap-input validate-input-e m-b-20" data-validate="Enter username or email">
                <input class="input" type="text" value="<?php echo @$_COOKIE['username']?>" id="username" name="username" placeholder="username or email" pattern="^(([a-zA-Z0-9_\-\.]+)|([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$)">
                <span class="focus-input"></span>
            </div>

            <div class="wrap-input validate-input-p m-b-25" data-validate = "Enter password">
                <input class="input" value="<?php echo @$_COOKIE['pass']?>" type="password" id="pass" name="pass" placeholder="password" pattern="^([\w\d]{6,})">
                <span class="focus-input"></span>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Remember me</label>
            </div>

            <div class="w-login-form-btn">
                <button type="submit" class="login-form-btn">
                    Log in
                </button>
            </div>
            <div class="fg-password">
                <a href="forget-password.html" style="color: black">
                    Forget password
                </a>
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
