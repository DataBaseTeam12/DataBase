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
                Enter your email associated with your account and we will send you the password reset link.
                </p>
				<p>
					<label>Email:</label>
					<input class="form-control input-md" type="text" name="email" maxlength="30">
				</p>
				<p>
					<button class="btn btn-primary btn-block" type="submit">Send Verification Code</button>
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