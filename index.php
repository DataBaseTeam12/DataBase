<!DOCTYPE html>
<html>
<head>
	<!--Page title in tab-->
	<title>Home</title>
	<!--Link to CSS page-->
	<link rel="stylesheet" href="library.css">
	<link rel="stylesheet" href="/style/drop-down-menu.css">
</head>
<body>
	<div class="container">
		<!--Header section-->
		<header>
			<!--Larger header section-->
			<div class="main">
				<h1>University of Houston</h1>
				<h3>Libraries</h3>
			</div>
			<!--Bar containing Home button, Login/Logout-->
			<div class="subhead">
				<form action="" style="width: 62px; float: left; margin-left: 20px;">
					<button>Home</button>
				</form>
				<form action="http://databaseteam12.x10host.com/login/register.php" style="width: 91px; float: right;">
					<button>Register</button>
				</form>
				<form action="http://databaseteam12.x10host.com/login/login.php" style="width: 64px; float: right;">
					<button>Login</button>
				</form>
			</div>
		</header>
		<!--Main section-->
		<!--Navigation sidebar-->
		<nav>
			<div>
			    <!--
				<div class="nav-drop vgap">
					Search Media
					<div class="nav-drop-content">
						<a href="search.php">Search</a>
						<a href="displayAll.php">Display All Media</a>
						<a href="displayAllBooks.php">Display All Books</a>
						<a href="displayAllCassettes.php">Display All Cassettes</a>
						<a href="displayAllCds.php">Display All CDs</a>
						<a href="displayAllDvds.php">Display All DVDs</a>
						<a href="displayAllVhs.php">Display All VHS</a>
					</div>
				</div>
				<div class="nav-drop vgap">
					Laptop Rentals
					<div class="nav-drop-content">
						<a href="displayAllLaptops.php">Display All Laptops</a>
					</div>
				</div>
				<div class="nav-drop">
					Room Reservations
					<div class="nav-drop-content">
						<a href="displayAllRooms.php">Display All Rooms</a>
					</div>
				</div>
				-->
				<?php
		        session_start();
		        foreach ($_SESSION as $key=>$val)
                echo $key." ".$val."<br/>";
				if(isset($_SESSION["userAccount"]) && $_SESSION["userAccount"] == "Faculty") {
				    include "page/menu_faculty.php";
				    }
		        include "page/menu-user.html";
		        ?>
			</div>
		</nav>
		<!--Main body-->
		<main>
			<!--				<div class="inner">-->
			<!--					<!--Header of content
			<!--					<h2>Welcome!</h2>-->
			<!--					<!--Content-->
			<!--					<p>This is Team 12's Database project. Please login if you have an account, or register if you're new here.</p>-->
			<!--					<p>The search menu is on the left. Use it to search for media in the library's collection.</p>-->
			<!--				</div>-->
		</main>
		<!--Footer section-->
		<footer>
			&copy; Spring 2017 COSC 3380 Team 12
			<br>
			4333 University Drive
			<br>
			Houston, TX 77204-2000
		</footer>
	</div>
</body>
</html>
