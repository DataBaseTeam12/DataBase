<?php
include_once 'connectDB.php';

if(isset($_POST['send'])){

    $email = mysqli_real_escape_string($con, $_POST['email']);
    $result = $con->query("SELECT * FROM Member WHERE email = '$email'");

    if($result->num_rows > 0)
    {
        $user = $result->fetch_assoc();

        $subject = 'Forgotten Username';
        $message = 'Your username is: '.$user['username'].'';
        $header = 'Header';

        mail($user['email'], $subject, $message, $header);
        echo "<script>alert('Email was sent')</script>";
    }
    else
    {
        echo "<script>alert('Email was sent')</script>";
    }
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
        <h2>Enter your email</h2>
        <form class="form2" action="" method="POST" >   <!-- action="processData" sends the data that was inputed in the form to the. POST method is used for sensetive data. -->
            <p>
                Enter your user associated with your account and we will send your username.
            </p>
            <p>
                <label>Email:</label>
                <input class="form-control input-md" type="email" name="email" maxlength="30" required>
            </p>
            <p>
                <input type="submit" name="send" value="Send Email" class="btn btn-primary btn-block">
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