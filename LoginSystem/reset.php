<?php
include_once 'connectDB.php';

if( isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash']) ){

    $email = mysqli_real_escape_string($con, $_GET['email']);
    $hash = mysqli_real_escape_string($con, $_GET['hash']);

    $result = $con->query("SELECT * FROM Member WHERE email = '$email' AND hash = '$hash'");

    if($result->num_rows == 0)
    {
        echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Invalid URL for password reset link')
    window.location.href='http://databaseteam12.x10host.com/login/login.php';
    </SCRIPT>");
    }
}
else
{
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Password reset failed, try again later')
    window.location.href='http://databaseteam12.x10host.com/login/login.php';
    </SCRIPT>");
}

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="common.css">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>

<div>
    <header>
        <div class="main">
            <h1><a href="http://www.databaseteam12.x10host.com"><font color="white">University of Houston</font></a></h1>
            <h3><a href="http://www.databaseteam12.x10host.com"><font color="white">Libraries</font></a></h3>
        </div>
        <div class="subhead">

        </div>
    </header>
</div>
<div class="container">
    <div class="innerboxForgotpassword">
        <div class="wrapper">
        <h2>Enter your new password</h2>
        </div>
        <form class="form2" action="/login/reset-password.php" method="post" >
            <p>
                <label>New Password:</label>
                <input class="form-control input-md" type="password" name="password" maxlength="25" required>
            </p>
            <p>
                <label>Confirm New Password:</label>
                <input class="form-control input-md" type="password" name="passwordAgain" maxlength="25" required>
            </p>
            <input type="hidden" name="email" value="<?= $email ?>">
            <input type="hidden" name="hash" value="<?= $hash ?>">
            <p>
                <button class="btn btn-primary btn-block">Change Password</button>
            </p>
        </form>
    </div>
</div>

<footer>
    &copy; Spring 2017 COSC 3380 Team 12
    <br><br>
    4333 University Drive
    <br>
    Houston, TX 77204-2000
</footer>
</body>
</html>