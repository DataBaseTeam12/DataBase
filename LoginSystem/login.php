<?php

session_start();
include_once 'connectDB.php';

if(isset($_SESSION['logged_in']))
{
    header("Location: index.php");
    exit;
}

$error = false;

if(isset($_POST['sign_up']))
{
    $email = mysqli_real_escape_string($con, $_POST['email']);
    // prevent sql injection.

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        echo "Please Enter a Valid Email";
    }



    $sql = "SELECT * FROM Member WHERE email = '$email'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $error = true;
        echo "email already in use";
    }

    if(!$error) // if there is no error, continue to logging in.
    {

    }
}

?>



<!DOCTYPE html>
<html>
<title>Login</title>

<link rel="stylesheet" href="common.css">
<link rel="stylesheet" href="drop-down-menu.css">

<link rel="stylesheet" href="login.css">

<script src="script/common.js"></script>
<script>
    document.addEventListener("DOMContentLoaded",
        function (event) {
            // make stuff happen after page loads
        }
    );
</script>
<body>
<header>
    <div class="main">
        <h1><a href="http://www.databaseteam12.x10host.com"><font color="white">University of Houston</font></a></h1>
        <h3><a href="http://www.databaseteam12.x10host.com"><font color="white">Libraries</font></a></h3>
    </div>
    <div class="subhead">

    </div>
</header>

<nav>
    <a href="index.php" style="float:left;">Home</a>
    <a href="register.php">Register</a>
</nav>

<!-- custom content -->
<main id="login">
    <section id="sign-in">
        <h2 style="text-align:center;">Sign in</h2>
        <form action="processData.php" method="POST">
            <!--action="processData" sends the data that was inputed in the form to the. POST method is used for sensetive data.-->
            <p>
                <label>Email:</label><br>
                <input type="text" name="email" required="">
                <br>
            </p>
            <p>
                <label>Password:</label><br>
                <input type="password" name="password" required="">
                <a href="resetpass.php" style="float:right;">
                    Forgot your Password?
                </a>
                <br><br>
            </p>
            <p>
                <button type="submit">Sign in</button>
            </p>
            <div class="divider">
                <hr style="float:left;"> <small>Need an account?</small> <hr style="float:right;">
            </div>
            <div class="regbox">
                <p>
                    <button class="registerbutton" type="submit">Create an account</button>
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