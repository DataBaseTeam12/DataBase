<?php
include_once 'connectDB.php';
if (isset($_POST['send'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $result = $con->query("SELECT * FROM Member WHERE email = '$email'");
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $first_name = $user['first_name'];
        $email = $user['email'];
        $hash = $user['hash'];
        $message = '
        Hello '.$first_name.',
        You have requested password reset!
        Please click this link to reset your password:
        http://www.databaseteam12.x10host.com/login/reset.php?email='.$email.'&hash='.$hash;
        $subject = 'Password Reset Link - website';
        mail($user['email'], $subject, $message);
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
            <?php include "../new_page/common-header.html"; ?>
        </header>
	</div>
	<div class="container">
		<div class="innerboxForgotpassword">
            <div class="wrapper">
                <h2>Enter your email</h2>
            </div>
			<form class="form2" action="" method="POST" >   <!-- action="processData" sends the data that was inputed in the form to the. POST method is used for sensetive data. -->
                <p>
                Enter your email associated with your account and we will send you the password reset link.
                </p>
				<p>
					<label>Email:</label>
					<input class="form-control input-md" type="text" name="email" maxlength="30">
				</p>
				<p>
                    <input type="submit" name="send" value="Send Verification Code" class="btn btn-primary btn-block">
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