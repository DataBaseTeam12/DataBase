<?php

session_start();
include_once 'connectDB.php';

if(isset($_SESSION['logged_in']))
{
    header("Location: http://www.databaseteam12.x10host.com/");
}

$error = false;

if(isset($_POST['log_in']))
{
    // prevent sql injection.
    $email = mysqli_real_escape_string($con, $_POST['email']);

    $result = $con->query("SELECT * FROM Member WHERE email = '$email'");

    if ($result->num_rows == 0) {
        $error = true;
        $error_message = "Incorrect Email or Password";
    }
    else
    {
        $user = $result->fetch_assoc();

        if(password_verify($_POST['password'], $user['password']))
        {
            $_SESSION['email'] = $user['email'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];
            $_SESSION['active'] = $user['active'];
            $_SESSION['userAccount'] = $user['userAccount'];
            $_SESSION['logged_in'] = $user['logged_in'];

            header("Location: http://www.databaseteam12.x10host.com/");


        }
        else
        {
            $error = true;
            $error_message = "Incorrect Email or Password";
        }
    }
}

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

<nav>

</nav>

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
                <label>Email:</label><br>
                <input type="email" name="email" required="" class="form-control input-md">
                <br>
            </p>
            <p>
                <label>Password:</label><br>
                <input type="password" name="password" required="" class="form-control input-md">
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