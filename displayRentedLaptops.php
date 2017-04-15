<?php include 'new_php/connectDB.php';
session_start(); 
if(!(isset($_SESSION['logged_in'])) || $_SESSION['userAccount'] == 'Student')
  {
    header("Location: http://www.databaseteam12.x10host.com/");
  } ?>

<!DOCTYPE html>

<title>Display Rented Laptops</title>

<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="no-cache">
<meta http-equiv="Expires" content="-1">
<meta http-equiv="Cache-Control" content="no-cache">

<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="no-cache">
<meta http-equiv="Expires" content="-1">
<meta http-equiv="Cache-Control" content="no-cache">

<link rel="stylesheet" href="/new_style/common.css">
<link rel="stylesheet" href="/new_style/drop-down-menu.css">
<link rel="stylesheet" href="/new_style/home.css">
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
main a, button, input[type=submit] {
	padding: 10px;
	border: none;
	background-color: #c8102e;
	color: #FFF9D9;
	text-transform: uppercase;
	text-decoration: none;
	font: bold 14px sans-serif;
	cursor: pointer;
}

main td, main th {
	padding: 5px;
}

input[type=search], input[type=text], select {
	width: 100%;
	display: inline-block;
	padding: 10px 15px;
	margin-top: 5px;
	margin-bottom: 10px;
	border: 1px solid #555;
	box-sizing: border-box;
}
</style>

<?php include "new_page/common-header.html"; ?>

<div class="flex">
	<nav class="frow fill">
		<a href="http://www.databaseteam12.x10host.com/" class="fl">Home</a>
		<?php if($_SESSION['logged_in'] == true): ?>
		    <a href="http://www.databaseteam12.x10host.com/profile.php">Profile</a> 
            <a href="http://www.databaseteam12.x10host.com/login/logout.php" style="margin:0px 5px;">Logout</a>
		<?php else: ?>
		    <a href="http://www.databaseteam12.x10host.com/login.php" style="margin:0px 5px;">Login</a>
		    <a href="http://www.databaseteam12.x10host.com/register.php">Register</a>
		<?php endif; ?>
	</nav>
</div>

<div class="frow bg-pic" style="flex: 1 0 auto;">
	<aside>
		<?php if(isset($_SESSION['userAccount']) && $_SESSION['userAccount'] == 'Faculty') include "new_page/menu-faculty.html"; ?>
		<?php include "new_page/menu-user.html"; ?>
	</aside>
	<main class="grow-row fill-col">
		<i>Displaying Rented Laptops By End Date:</i><br><hr>
		<!--Content-->
		<?php
		$conn = connect();
		
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 

		// Call procedure or query for specific page
		$sql = "SELECT * FROM Laptop_Rent_View WHERE returned_date IS NULL ORDER BY end_date ASC;";
		$result = $conn->query($sql);
		
		// If result is not empty, display it
		if ($result->num_rows > 0) {
			echo "<table border='1'><tr><th>Laptop ID</th><th>Serial Number</th>
			<th>Reserved Date Range</th><th>Member ID</th></tr>";
			
			// Output data from every row
			while($row = $result->fetch_assoc()) {
				echo "<tr><td>".$row["laptop_id"]."</td><td>".$row["serial"]."</td>
				<td>".$row["start_date"]." to ".$row["end_date"]."</td><td>".$row["member_id"]."</td></tr>";
			}
			
			echo "</table>";
		} else {
			echo "0 results";
		}
		$conn->close();
		?>
	</main>
</div>

<?php include "new_page/common-footer.html"; ?>