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
	<script type="text/javascript">
	$(document).ready(function(){
		$("#date-type").change(function(){
			$(this).find("option:selected").each(function(){
				var optionValue = $(this).attr("value");
				if(optionValue){
					$(".box").not("." + optionValue).hide();
					$("." + optionValue).show();
				} else{
					$(".box").hide();
				}
			});
		}).change();
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
			<label><b>Member ID</b></label>
			<input type="number" min="1" name="member-id" required>
			<hr>
			<label><b>Media ID</b></label>
			<input type="number" min="1" name="media-id">
			
			<label><b>Copy Number</b></label>
			<input type="number" min="1" name="copy">
			
			<label>OR<br><br><b>Laptop ID</b></label>
			<input type="number" min="1" name="laptop-id">
			
			<button type="submit">Check-Out</button>
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
		$member = $_GET['member-id'];
		
		if (isset($_GET['media-id'])) {
			$book = $_GET['media-id'];
			$copy = $_GET['copy'];
			
			$sql_1 = "SELECT EXISTS (SELECT * FROM Member WHERE id = $member);";
			$result_1 = $conn->query($sql_1);
			$sql_2 = "SELECT EXISTS (SELECT * FROM Media WHERE id = $book AND copy_num = $copy);";
			$result_2 = $conn->query($sql_2);
			if ($result_1 && $result_2) {
				$sql_3 = "SELECT * FROM Media WHERE id = $book AND copy_num = $copy;";
				$result_3 = $conn->query($sql_3);
				$row_1 = $result_3->fetch_assoc();
				
				if ($row_1["is_available"] != "available") {
					echo "<hr><div style=\"padding: 15px; background-color: #f44336; color: white;\">
					Media is <b>unavailable</b>, please select another.</span>";
				} 
				else {
					$sql_4 = "SELECT num_books, total_fines FROM Member WHERE id = $member;";
					$result_4 = $conn->query($sql_4);
					$row = $result_4->fetch_assoc();
					
					if ($row["num_books"] >= 10) {
						echo "<hr><div style=\"padding: 15px; background-color: #f44336; color: white;\">
						User has reached the maximum number of books allowed out.</span>";
					}
					else if ($row["total_fines"] > 0) {
						echo "<hr><div style=\"padding: 15px; background-color: #f44336; color: white;\">
						User has fines.</span>";
					}
					else {
						$sql = "CALL check_out($member, $book, $copy);";
						$result = $conn->query($sql);
					
						if(!$result) {
							echo "<hr><div style=\"padding: 15px; background-color: #f44336; color: white;\">
							SQL error.</span>";
						}
						else {
							echo "<hr><div style=\"padding: 15px; background-color: #4CAF50; color: white;\">
							Media successfully checked out.</span>";
						}
					}
				}
			}
		}
		
		if (isset($_GET['laptop-id'])) {
			$laptop = $_GET['laptop-id'];
			
			$sql_1 = "SELECT EXISTS (SELECT * FROM Member WHERE id = $member);";
			$result_1 = $conn->query($sql_1);
			$sql_2 = "SELECT EXISTS (SELECT * FROM Laptop WHERE id = $laptop);";
			$result_2 = $conn->query($sql_2);
			
			if ($result_1 && $result_2) {
				$sql_3 = "SELECT is_available FROM Laptop WHERE id = $laptop;";
				$result_3 = $conn->query($sql_3);
				$row = $result_3->fetch_assoc();
					
				if ($row["is_available"] == "n") {
					echo "<hr><div style=\"padding: 15px; background-color: #f44336; color: white;\">
					Laptop is <b>unavailable</b>, please select another.</span>";
				} 
				else {
					$sql = "CALL laptop_rent($member, $laptop);";
					$result = $conn->query($sql);
				
					if(!$result) {
						echo "<hr><div style=\"padding: 15px; background-color: #f44336; color: white;\">
						SQL error.</span>";
					}
					else {
						echo "<hr><div style=\"padding: 15px; background-color: #4CAF50; color: white;\">
						Laptop successfully checked out.</span>";
					}
				}	
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