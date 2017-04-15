<?php
session_start();
include 'php/connect-begin.php';


if(isset($_POST['log_in']))
{
    $username = $pdo->quote($_POST['username']);
    $password = $_POST['password'];
    //$result = $pdo->query("SELECT * FROM Member WHERE username = '{$username}'");
    $hash = password_hash($password, PASSWORD_DEFAULT);
    //$isValid = password_verify($plainTextPassword, $hashedPassword);

    if (!($error)) // if there are no errors, then proceed to add the data to the database.
    {
        if($pdo->query("INSERT INTO Member (username,password) VALUES('".$username."','".$hash."')"))
        {
            $_SESSION['logged_in'] = true;
            echo "register successful";
        }
        else
        {
            echo "register failed";
        }
    }else
    {
    echo 'errors';
    }
    
}
include 'php/connect-end.php';
?>


<!DOCTYPE html>
<html>
<title>Login</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="common.css">
<link rel="stylesheet" href="login.css">
<link rel="stylesheet" href="drop-down-menu.css">

<body>
<header>
    <div class="main">
        <h1><a href="http://www.databaseteam12.x10host.com"><font color="white">University of Houston</font></a></h1>
        <h3><a href="http://www.databaseteam12.x10host.com"><font color="white">Libraries</font></a></h3>
    </div>
</header>

<!-- custom content -->
<main id="login">
    <section id="sign-in">
        <div class="wrapper">
        <span class="text-danger"><?php if(isset($error_message)) echo $error_message; ?> </span>
        </div>
        <h2 style="text-align:center;">Sign in</h2>
        <form action="" method="POST">
            <!--action="processData" sends the data that was inputed in the form to the. POST method is used for sensitive data.-->
            <p>
                <label>Username:</label><br>
                <input type="text" name="username" required="" class="form-control input-md" maxlength="30">
                <br>
            </p>
            <p>
                <label>Password:</label><br>
                <input type="password" name="password" required="" class="form-control input-md" maxlength="25">
                <a href="resetpass.php" style="float:right;">
                    Forgot your Password?
                </a>
                <br><br>
            </p>
            <div class="wrapper">
            <p>
                <input type="submit" name="log_in" value="Sign In" class="btn btn-danger btn-block">
            </p>
            </div>
            <div class="divider">
                <hr class="hr" style="float:left;"> <small>Need an account?</small> <hr class="hr" style="float:right;">
            </div>
            <div class="regbox">
                <p>
                    <a href="http://www.databaseteam12.x10host.com" class="btn btn-default btn-block">Create an account</a>
                </p>
            </div>
        </form>
    </section>
</main>

<footer>
    &copy; Spring 2017 COSC 3380 Team 12
    <br><br>
    4333 University Drive
    <br>
    Houston, TX 77204-2000
</footer>
</body>
</html>