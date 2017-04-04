<?php
	session_start();
?>
<!DOCTYPE html>

<head>
	<title>Details</title>
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
	main td {
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
		
		// If details button pressed, information will be placed in web address upon refresh
		// Variables used to hold values
		$book = htmlspecialchars($_GET["id"]);
		$copy = htmlspecialchars($_GET["copy"]);

		// Call procedure or query for specific page
		$sqla = "SELECT * FROM Media WHERE id = $book AND copy_num = $copy;";
		$resulta = $conn->query($sqla);
		$sqlb = "SELECT * FROM Book WHERE book_id = $book AND copy_num = $copy;";
		$resultb = $conn->query($sqlb);
		$sqlc = "SELECT * FROM Cassette WHERE cassette_id = $book AND copy_num = $copy;";
		$resultc = $conn->query($sqlc);
		$sqld = "SELECT * FROM CD WHERE cd_id = $book AND copy_num = $copy;";
		$resultd = $conn->query($sqld);
		$sqle = "SELECT * FROM DVD WHERE dvd_id = $book AND copy_num = $copy;";
		$resulte = $conn->query($sqle);
		$sqlf = "SELECT * FROM VHS WHERE vhs_id = $book AND copy_num = $copy;";
		$resultf = $conn->query($sqlf);
		$sqlg = "SELECT * FROM Author WHERE media_id = $book;";
		$resultg = $conn->query($sqlg);
		
		// If result is not empty, display it
		if ($resulta->num_rows > 0) {
			// if book
			if ($resultb->num_rows > 0) {
				$row2 = $resultb->fetch_assoc();
			}
			// if cassette
			else if ($resultc->num_rows > 0) {
				$row2 = $resultc->fetch_assoc();
			}
			// if cd
			else if ($resultd->num_rows > 0) {
				$row2 = $resultd->fetch_assoc();
			}
			// if dvd
			else if ($resulte->num_rows > 0) {
				$row2 = $resulte->fetch_assoc();
			}
			// if vhs
			else if ($resultf->num_rows > 0) {
				$row2 = $resultf->fetch_assoc();
			}
			
			// Outputs data
			$row = $resulta->fetch_assoc();
			
			echo "<h2>Details of ".$row["title"]."</h2><hr><table>
			<tr><td width='30%' align='right'><b>Title</b></td><td width='70%'>".$row["title"]."</td></tr>";
			
			// if book
			if ($resultb->num_rows > 0) {
				echo "<tr><td align='right'><b>Edition</b></td><td>".$row2["edition"]."</td></tr></p>";
			}
			
			// if has authors
			if ($resultg->num_rows > 0) {
				echo "<tr><td align='right'><b>Author(s)</b></td><td>";
				while ($row3 = $resultg->fetch_assoc()) {
					echo $row3["first_name"]." ".$row3["last_name"]."<br>";
				}
				echo "</td></tr>";
			}
			
			echo "<tr><td align='right'><b>Genre</b></td><td>".$row["genre"]."</td></tr>
			<tr><td align='right'><b>Publisher</b></td><td>".$row["publisher"]."</td></tr>
			<tr><td align='right'><b>Published Date</b></td><td>".$row["published_date"]."</td></tr>";
			
			// if book
			if ($resultb->num_rows > 0) {
				echo "<tr><td align='right'><b>Format</b></td><td>".$row2["num_pages"]." pages : ".$row2["type"]."</td></tr>";
			}
			// if cassette
			else if ($resultc->num_rows > 0) {
				echo "<tr><td align='right'><b>Format</b></td><td>audio cassette (approximately "
				.$row2["total_runtime"]." min.) : analog</td></tr>
				<tr><td align='right'><b>Producer</b></td><td>".$row2["producer"]."</td></tr>";
			}
			// if cd
			else if ($resultd->num_rows > 0) {
				echo "<tr><td align='right'><b>Format</b></td><td>audio disc (approximately "
				.$row2["total_runtime"]." min.) : "
				.$row2["num_tracks"]." tracks : digital</td></tr>
				<tr><td align='right'><b>Producer</b></td><td>".$row2["producer"]."</td></tr>";
			}
			// if dvd
			else if ($resulte->num_rows > 0) {
				echo "<tr><td align='right'><b>Format</b></td><td>videodisc (approximately ".$row2["total_runtime"]." min.)</td></tr>
				<tr><td align='right'><b>Producer</b></td><td>".$row2["producer"]."</td></tr>
				<tr><td align='right'><b>Director</b></td><td>".$row2["director"]."</td></tr>";
			}
			// if vhs
			else if ($resultf->num_rows > 0) {
				echo "<tr><td align='right'><b>Format</b></td><td>videotape (approximately ".$row2["total_runtime"]." min.)</td></tr>
				<tr><td align='right'><b>Producer</b></td><td>".$row2["producer"]."</td></tr>
				<tr><td align='right'><b>Director</b></td><td>".$row2["director"]."</td></tr>";
			}
			
			echo "<tr><td align='right'><b>Audience</b></td><td>".$row["audience"]."</td></tr>
			<tr><td align='right'><b>Language</b></td><td>".$row["language"]."</td></tr>";
			
			// if book
			if ($resultb->num_rows > 0) {
				echo "<tr><td align='right'><b>ISBN 10</b></td><td>".$row2["ISBN_10"]."</td></tr>
				<tr><td align='right'><b>ISBN 13</b></td><td>".$row2["ISBN_13"]."</td></tr>";
			}
			// if other
			else if ($resultc->num_rows > 0 || $resultd->num_rows > 0 ||
						$resulte->num_rows > 0 || $resultf->num_rows > 0) {
				echo "<tr><td align='right'><b>UPC</b></td><td>".$row2["UPC"]."</td></tr>";
			}
			
			echo "</table>";
			
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