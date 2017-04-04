<?php
	session_start();
?>
<!DOCTYPE html>

<head>
	<title>Rooms by End Time</title>
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
	main th, main td {
		padding: 5px;
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
				<a href="http://www.databaseteam12.x10host.com/searchMembers.php">Search Members</a>
				<a href="#">Display All Members By Last Name</a>
				<a href="#">Display All Members By Fines</a>
				<a href="http://www.databaseteam12.x10host.com/searchLaptops.php">Search Rented Laptops</a>
				<a href="http://www.databaseteam12.x10host.com/searchRooms.php">Search Rented Rooms</a>
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
		<i>Displaying Reserved Rooms By End Time:</i><br>
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
		$sql = "SELECT * FROM Room_Reserve_View ORDER BY room_num ASC;";
		$result = $conn->query($sql);
		
		// If result is not empty, display it
		if ($result->num_rows > 0) {
			// Output data from every row
			while($row = $result->fetch_assoc()) {
				$room = $row["room_num"];
				
				echo "<hr><table>
				<tr><td width='30%'><b>Room Number</b></td>
				<td width='70%'>".$row["room_num"]."</td></tr>
				<tr><td><b>Floor Number</b></td>
				<td>".$row["floor_num"]."</td></tr>
				<tr><td><b>Room Type</b></td>
				<td>".$row["room_type"]."</td></tr>
				<tr><td><b>Capacity</b></td>
				<td>".$row["capacity"]."</td></tr>
				</table>
				<p>Reserved from <b>".$row["start_time"]."</b> to <b>".$row["end_time"]."</b> 
				by ID no. <b>".$row["member_id"]."</b></p>";
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