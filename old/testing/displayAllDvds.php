<?php
	session_start();
?>
<!DOCTYPE html>

<head>
	<title>Display All</title>
	<link rel="stylesheet" href="/style/common.css">
	<link rel="stylesheet" href="/style/home.css">
	<link rel="stylesheet" href="/style/drop-down-menu.css">
	<script src="/site/script/common.js"></script>
	<!--Embedded code for Font Awesome icons-->
	<script src="https://use.fontawesome.com/4f7fcc0d3d.js"></script>
	<script>
		// add functionality to individual elements
		document.addEventListener("DOMContentLoaded", function (event) {
			//var height_left =
			//	window.innerHeight
			//	- (tag("header")[0].offsetHeight
			//		+ tag("nav")[0].offsetHeight
			//		+ tag("footer")[0].offsetHeight);
			//tag("main")[0].style.minHeight = (height_left - 40) + "px";
		});
	</script>
	<style>
	.detail_label {
		width: 90px;
		padding: 10px;
		background-color: #c8102e;
		color: #FFF9D9;
	}
	.details {
		width: 95%;
		margin-top: 5px;
		padding: 10px;
		background-color: #eee;
		border: 1px solid #555;
	}
	main a {
		padding: 10px;
		border: none;
		background-color: #c8102e;
		color: #FFF9D9;
		text-transform: uppercase;
		text-decoration: none;
		font: bold 14px sans-serif;
		cursor: pointer;
	}
	</style>
</head>

<body>
	<header>
		<h1>University of Houston</h1>
		<h3>Libraries</h3>
	</header>
	<nav>
		<a href="/index.php" style="float:left;">Home</a>
		<a href="/login.php">Login</a>
		<a href="/register.php">Register</a>
	</nav>
	<!--custom html below-->
	<aside id="drop-down-menu">
		<!--if logged in member is faculty, display faculty menu-->
		<?php if (isset($_SESSION["faculty"])) { ?>
		<div class="item vgap">
			Faculty Menu
			<div class="content">
				<a href="#">Add New Media</a>
				<a href="#">Check Out Media</a>
				<a href="#">Check In Media</a>
				<a href="#">Search Member By Full Name</a>
				<a href="#">Display Members By Last Name</a>
				<a href="#">Display Members By ID</a>
				<a href="#">Display Members By Username</a>
				<a href="#">Display Members By Fines</a>
				<a href="#">Search Rented Laptops By End Date</a>
				<a href="#">Search Rented Laptops By Serial Number</a>
				<a href="#">Search Rented Laptops By Member ID</a>
				<a href="#">Search Rented Rooms By End Time</a>
				<a href="#">By Room Number</a>
				<a href="#">By Member ID</a>
			</div>
		</div>
		<? } ?>
		<div class="item vgap">
			Search Media
			<div class="content">
				<a href="http://www.databaseteam12.x10host.com/search.php">Search</a>
				<a href="http://www.databaseteam12.x10host.com/displayAll.php">Display All Media</a>
				<a href="http://www.databaseteam12.x10host.com/displayAllBooks.php">Display All Books</a>
				<a href="http://www.databaseteam12.x10host.com/displayAllCassettes.php">Display All Cassettes</a>
				<a href="http://www.databaseteam12.x10host.com/displayAllCds.php">Display All CDs</a>
				<a href="http://www.databaseteam12.x10host.com/displayAllDvds.php">Display All DVDs</a>
				<a href="http://www.databaseteam12.x10host.com/displayAllVhs.php">Display All VHS</a>
				
			</div>
		</div>
		<div class="item vgap">
			Laptop Rentals
			<div class="content">
				<a href="http://www.databaseteam12.x10host.com/displayAllLaptops.php">Display All Laptops</a>
			</div>
		</div>
		<div class="item">
			Room Reservations
			<div class="content">
				<a href="http://www.databaseteam12.x10host.com/displayAllRooms.php">Display All Rooms</a>
			</div>
		</div>
	</aside>
	<main>
		<i>Displaying All DVDs Results:</i><br>
		<!--Content-->
		<?php
		// Temporary test connection; will be removed and use connection in another file
		$servername = "162.253.224.12";
		$username = "databa39_user";
		$password = "databa39team12";
		$dbname = "databa39_library";

		// Create connection (test)
		$conn = new mysqli($servername, $username, $password, $dbname);
		
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 

		// Call procedure or query for specific page
		$sql = "SELECT * FROM Full_DVD_View ORDER BY title;";
		$result = $conn->query($sql);
		
		// If result is not empty, display it
		if ($result->num_rows > 0) {
			// Output data from every row
			while($row = $result->fetch_assoc()) {
				$book = $row["id"];
				$copy = $row["copy_num"];
				
				echo "<hr><h2>".$row["title"]."</h2>"
				.$row["first_name"]." ".$row["last_name"]." "
				.$row["published_date"]."<br>".$row["publisher"].".<br><br>
				<a href=\"details.php?id=$book&copy=$copy\">More Details</a><br><br>";
				
				// If the book is available
				if ($row["is_available"] == "available") {
					echo "<p><i class='fa fa-check-circle' aria-hidden='true' 
						style='color: #57BC57'></i> Copy #".$row["copy_num"]." is 
						<b>available</b>. ";
						
					// If logged in, provide options to reserve or hold
					if (session_status() == PHP_SESSION_ACTIVE) {
						echo "<a href=\"\">Hold</a>
						<a href=\"\" style=\"margin-left:5px;\">Reserve</a>
						</p>";
					}
				}
				// Else, display status of the book
				else {
					echo "<p><i class='fa fa-times-circle' aria-hidden='true'
						style='color: #D25252'></i> Copy #".$row["copy_num"]." is 
						<b>".$row["is_available"]."</b>.</p>";
				}
			}
		} else {
			echo "0 results";
		}
		$conn->close();
		?>
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