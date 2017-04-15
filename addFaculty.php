<?php include 'new_php/connectDB.php';
session_start();  
if(!(isset($_SESSION['logged_in'])) || $_SESSION['userAccount'] == 'Student')
  {
    header("Location: http://www.databaseteam12.x10host.com/");
  } ?>

<!DOCTYPE html>

<title>Add Faculty</title>

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

main td {
	padding: 5px;
}

input[type=number], input[type=text], select {
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
	    
		<meta http-equiv="Content-Type" content="text/html" charset="utf-8"/>
    <form name="form" action="" method="get">
			<label><b>Faculty ID</b></label>
			<input type="number" min="1" name="member-id" required>
			<hr>
			<label><b>Position</b></label>
			<input type="text" placeholder="Position Name" name="position" required>
			
			<button type="submit">Grant Access</button>
		</form>

		<?php
		$conn = connect();
		$sql = "";

		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		
		if (isset($_GET['member-id'])) {
			$id = $_GET['member-id'];
			$position = $_GET['position'];
			
			$sql_1 = "SELECT EXISTS (SELECT * FROM Member WHERE id = '$id');";
			$result_1 = $conn->query($sql_1);
			$sql_2 = "SELECT * FROM Member WHERE id = '$id' AND userAccount = 'Faculty';";
			$result_2 = $conn->query($sql_2);
				
			if ($result_1 && ($result_2->num_rows == 0)) {
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
			else if ($result_2->num_rows > 0) {
				echo "<hr><div style=\"padding: 15px; background-color: #f44336; color: white;\">
					Member is already faculty.</span>";
			}
		}

		$conn->close();
		?>

	</main>
</div>

<?php include "new_page/common-footer.html"; ?>