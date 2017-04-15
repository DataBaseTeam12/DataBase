<?php
	session_start();
?>
<!DOCTYPE html>

<head>
	<title>Display All Rooms</title>
	<link rel="stylesheet" href="/style/common.css">
	<link rel="stylesheet" href="/style/home.css">
	<link rel="stylesheet" href="/style/header.css">
	<link rel="stylesheet" href="/style/footer.css">
	<link rel="stylesheet" href="/style/drop-down-menu.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
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
	main a, input[type=submit] {
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
		<?php if (isset($_SESSION['userAccount']) && $_SESSION['userAccount'] == 'Faculty') { ?>
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
		<i>Displaying All Rooms:</i><br>
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
		$sql = "SELECT * FROM Rooms ORDER BY room_num ASC";
		$result = $conn->query($sql);
		
		// If result is not empty, display it
		if ($result->num_rows > 0) {
			// Output data from every row
			while($row = $result->fetch_assoc()) {
				$room = $row["room_num"];
				$floor = $row["floor"];
				
				echo "<hr><table>
				<tr><td width='30%'><b>Room Number</b></td>
				<td width='70%'>".$row["room_num"]."</td></tr>
				<tr><td><b>Floor Number</b></td>
				<td>".$row["floor"]."</td></tr>
				<tr><td><b>Room Type</b></td>
				<td>".$row["room_type"]."</td></tr>
				<tr><td><b>Capacity</b></td>
				<td>".$row["capacity"]."</td></tr>
				</table>";
				
				$sql2 = "SELECT * FROM Room_Reserves WHERE room_num = '$room';";
				$result2 = $conn->query($sql2);
				
				if ($result2->num_rows > 0) {
					$row2 = $result2->fetch_assoc();
					
					$sql3 = "SELECT * FROM Room_Reserves WHERE room_num = '$room' AND end_time >= NOW();";
					$result3 = $conn->query($sql3);
					
					if ($result3->num_rows > 0) {
						echo "<p><i class='fa fa-times-circle' aria-hidden='true'
							style='color: #D25252'></i> Room is <b>unavailable</b> until "
							.$row2["end_time"];
					}
					else {
						echo "<p><i class='fa fa-check-circle' aria-hidden='true' 
							style='color: #57BC57'></i> Room is <b>available</b> from ".$row["avail_start"].
							" to ".$row["avail_end"];
							// If logged in, provide options to reserve or hold
						if ($_SESSION['logged_in'] == true) {
							echo "<form>
							<input type='submit' class = 'room' name='room-$room-$floor' value='Reserve'>
							<input type='hidden' name='memberId' value = $member_id>
							<input type='hidden' name='roomNum' value=$room>
							<input type='hidden' name='floor' value=$floor></form>";
					    }
					}
				}
				else {
					echo "<p><i class='fa fa-check-circle' aria-hidden='true' 
						style='color: #57BC57'></i> Room is <b>available</b> from ".$row["avail_start"].
						" to ".$row["avail_end"];
					if ($_SESSION['logged_in'] == true) {
    					echo "<form>
    						<input type='submit' class = 'room' name='room-$room-$floor' value='Reserve'>
    						<input type='hidden' name='memberId' value = $member_id>
    						<input type='hidden' name='roomNum' value=$room>
    						<input type='hidden' name='floor' value=$floor></form>";
					}
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
<script>
 $('.room').click( function(){
   
       $('form').submit(function(){
          // alert("enter form");
          var data = $(this).serializeArray();
           data = JSON.stringify(data);
           var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                  alert(this.responseText);
 
              }
          };
           xmlhttp.open("GET", "room_reserve.php"+"?t="+"room"+"&data="+data , true);
          xmlhttp.send();
     });
 });
 </script>