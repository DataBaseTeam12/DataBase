<!DOCTYPE html>
<head>
	<title>Login Page</title>
	<link rel="stylesheet" href="common.css">
	<link rel="stylesheet" href="login.css">
	<link rel="stylesheet" href="/style/drop-down-menu.css">
	<script src="/site/script/common.js"></script>
	<script>
		// add functionality to individual elements
		document.addEventListener("DOMContentLoaded", function (event) {
		});
	</script>
</head>

<body>
	<header>
		<h1><a href="http://www.databaseteam12.x10host.com"><font color="white">University of Houston</font></a></h1>
        <h3><a href="http://www.databaseteam12.x10host.com"><font color="white">Libraries</font></a></h3>
	</header>
	<nav>
		
	</nav>
	<!--custom html below-->
	<main>
		<section id="sign-in">
			<h2 style="text-align:center;">Sign in</h2>
			<form action="processData.php" method="POST">
				<!--action="processData" sends the data that was inputed in the form to the. POST method is used for sensetive data.-->
				<p>
					<label>Email:</label><br>
					<input type="text" name="email">
					<br>
				</p>
				<p>
					<label>Password:</label><br>
					<input type="password" name="password">
					<a href="/page/login/forgotpass.php" style="float:right;">
						Forgot your Password?
					</a>
					<br><br>
				</p>
				<p>
					<button type="submit">Sign in</button>
				</p>
				<div class="divider">
					<hr class="left"> <small>Need an account?</small> <hr class="right">
				</div>
				<div class="regbox">
					<p>
						<button class="registerbutton" type="submit">Create an account</button>
					</p>
				</div>
			</form>
		</section>
	</main>
	<!--custom html above-->
	<footer>
		&copy; Spring 2017 COSC 3380 Team 12
		<br><br>
		4333 University Drive
		<br>
		Houston, TX 77204-2000
	</footer>
</body>
