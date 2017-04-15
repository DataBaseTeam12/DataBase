<?php
session_start();
include_once 'connectDB.php';
if(isset($_SESSION['logged_in']))
{
    header("location: http://www.databaseteam12.x10host.com/");

}
$error = false;
if(isset($_COOKIE['login']) > 5)
{
    $error = true;
    $error_message = "Incorrect Username or Password";
}
else {
    if (isset($_POST['log_in'])) {
        // prevent sql injection.
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $result = $con->query("SELECT * FROM Member WHERE username = '$username'");
        if ($result->num_rows == 0) {
            $error = true;
            $error_message = "Incorrect Username or Password";

            if (isset($_COOKIE['login'])) {
                if ($_COOKIE['login'] < 5) {
                    $attempts = $_COOKIE['login'] + 1;
                    setcookie('login', $attempts, time() + 60 * 10);
                } else {
                    $error_message = "Too many failed login attempts, try again in 10 minutes.";
                }


            } else {
                setcookie('login', 1, time() + 60 * 10);
            }


        } else {
            $user = $result->fetch_assoc();
            if (password_verify($_POST['password'], $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['first_name'] = $user['first_name'];
                $_SESSION['last_name'] = $user['last_name'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['active'] = $user['active'];
                $_SESSION['userAccount'] = $user['userAccount'];
                $_SESSION['total_fines'] = $user['total_fines'];
                $_SESSION['logged_in'] = true;

                if ($user['total_fines'] > 0) {
                    echo "<script type='text/javascript'>alert('You have unpaid fines.');</script>";
                }

                header("refresh: 1; location: http://www.databaseteam12.x10host.com/");
                header("refresh: 0");
            } else {
                $error = true;
                $error_message = "Incorrect Username or Password";

                if (isset($_COOKIE['login'])) {
                    if ($_COOKIE['login'] < 5) {
                        $attempts = $_COOKIE['login'] + 1;
                        setcookie('login', $attempts, time() + 60 * 10);
                    } else {
                        $error_message = "Too many failed login attempts, try again in 10 minutes.";
                    }
                } else {
                    setcookie('login', 1, time() + 60 * 10);
                }
            }
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
    <?php include "../new_page/common-header.html"; ?>
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
                <label>Username:</label><br>
                <input type="text" name="username" required="" class="form-control input-md" maxlength="30">
                <a href="http://www.databaseteam12.x10host.com/login/forgotUsername.php#" style="float:right;">
                    Forgot your Username?
                </a>
                <br>
            </p>
            <p>
                <label>Password:</label><br>
                <input type="password" name="password" required="" class="form-control input-md" maxlength="25">
                <a href="/login/forgotpass.php" style="float:right;">
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
                    <a href="http://www.databaseteam12.x10host.com/login/register.php" class="btn btn-default btn-block">Create an account</a>
                </p>
            </div>
        </form>
    </section>
</main>

<?php include "../new_page/common-footer.html"; ?>
</body>
</html>