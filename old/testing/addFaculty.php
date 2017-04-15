<?php
session_start();
?>
<!DOCTYPE html>

<head>
    <title>Check-Out</title>
    <link rel="stylesheet" href="/style/common.css">
    <link rel="stylesheet" href="/style/home.css">
	<link rel="stylesheet" href="/style/header.css">
	<link rel="stylesheet" href="/style/footer.css">
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
	<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>

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

        main a, button {
            padding: 10px;
            border: none;
            background-color: #c8102e;
            color: #FFF9D9;
            text-transform: uppercase;
            text-decoration: none;
            font: bold 14px sans-serif;
            cursor: pointer;
        }

        input[type=search], input[type=number], select {
            width: 100%;
            display: inline-block;
            padding: 10px 15px;
            margin-top: 5px;
            margin-bottom: 10px;
            border: 1px solid #555;
            box-sizing: border-box;
        }
		
		main table {
			border: 1px solid #555;
		}
		
		main td, th {
			padding: 10px;
			border: 1px solid #555;
		}
		
		main tr:nth-child(even) {
			background-color: #eee;
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
				<a href="/searchMembers.php">Search Members</a>
				<a href="#">Display All Members By Last Name</a>
				<a href="#">Display All Members By Fines</a>
				<a href="/searchLaptops.php">Search Rented Laptops</a>
				<a href="/searchRooms.php">Search Rented Rooms</a>
				<a href="#">Reports</a>
			</div>
		</div>
		<?php } ?>
		<div class="item vgap">
			Search Media
			<div class="content">
				<a href="/search.php">Search</a>
				<a href="/displayAll.php">Display All Media</a>
				<a href="/displayAllBooks.php">Display All Books</a>
				<a href="/displayAllCassettes.php">Display All Cassettes</a>
				<a href="/displayAllCds.php">Display All CDs</a>
				<a href="/displayAllDvds.php">Display All DVDs</a>
				<a href="/displayAllVhs.php">Display All VHS</a>
				
			</div>
		</div>
		<div class="item vgap">
			Laptop Rentals
			<div class="content">
				<a href="/displayAllLaptops.php">Display All Laptops</a>
			</div>
		</div>
		<div class="item">
			Room Reservations
			<div class="content">
				<a href="/displayAllRooms.php">Display All Rooms</a>
			</div>
		</div>
	</aside>
	<main>
		<form name="form" action="" method="get">
			<label><b>Faculty ID</b></label>
			<input type="number" min="1" name="member-id" required>
			<hr>
			<label><b>Position</b></label>
			<input type="text" placeholder="Position Name" name="position" required>
			
			<button type="submit">Grant Access</button>
		</form>

		<?php
		$servername = "162.253.224.12";
		$username = "databa39_user";
		$password = "databa39team12";
		$dbname = "databa39_library";

		$conn = new mysqli($servername, $username, $password, $dbname);

		$sql = "";

		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		
		if (isset($_GET['member-id'])) {
			$id = $_GET['member-id'];
			$position = $_GET['position'];
			
			$sql_1 = "SELECT EXISTS (SELECT * FROM Member WHERE id = '$member');";
			$result_1 = $conn->query($sql_1);
			$sql_2 = "SELECT EXISTS (SELECT * FROM Faculty WHERE id = '$member');";
			$result_2 = $conn->query($sql_2);
				
			if ($result_1 && !($result_2)) {
				$sql_3 = "INSERT INTO Faculty (faculty_id, position) VALUES ('$id', '$position');";
				$result_3 = $conn->query($sql_3);
				$sql_4 = "UPDATE Member SET userAccount = 'Faculty' WHERE id = '$id';";
				$result_4 = $conn->query($sql_4);
				
				if (!($result_3) || !($result_4)) {
					echo "<hr><div style=\"padding: 15px; background-color: #f44336; color: white;\">Error.</span>";
				}
				else {
					echo "<hr><div style=\"padding: 15px; background-color: #4CAF50; color: white;\">
						Faculty successfully added.</span>";
				}
			}
			else if (!($result_1)) {
				echo "<hr><div style=\"padding: 15px; background-color: #f44336; color: white;\">
					Member does not exist.</span>";
			}
			else if ($result_2) {
				echo "<hr><div style=\"padding: 15px; background-color: #f44336; color: white;\">
					Member is already faculty.</span>";
			}
		}

		$conn->close();
		?>
	</main>
	<!--custom html above-->
	<footer>
		<br>
		&copy; Spring 2017 COSC 3380 Team 12
		<br>
		4333 University Drive
		<br>
		Houston, TX 77204-2000
	</footer>
</body>