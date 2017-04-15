<?php include 'new_php/connectDB.php';
session_start(); 
if(!(isset($_SESSION['logged_in'])) || $_SESSION['userAccount'] == 'Student')
  {
    header("Location: http://www.databaseteam12.x10host.com/");
  } ?>

<!DOCTYPE html>

<title>Check-In</title>

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
			<label><b>Media ID</b></label>
			<input type="number" min="1" name="media-id">
			
			<label><b>Copy Number</b></label>
			<input type="number" min="1" name="copy">
			
			<label>OR<br><br><b>Laptop</b></label>
			<input type="number" min="1" name="laptop-id">
			
			<button type="submit">Check-In</button>
		</form>

		<?php
		$conn = connect();
		$sql = "";

		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		
		if (isset($_GET['media-id'])) {
			$book = $_GET['media-id'];
			$copy = $_GET['copy'];
		
			$sql_1 = "SELECT EXISTS (SELECT * FROM Media WHERE id = $book AND copy_num = $copy);";
			$result_1 = $conn->query($sql_1);
			if ($result_1) {
				$sql = "CALL check_in($book, $copy);";
				$result = $conn->query($sql);
			
				if(!$result) {
					echo "<hr><div style=\"padding: 15px; background-color: #f44336; color: white;\">
					SQL error.</span>";
				}
				else {
					echo "<hr><div style=\"padding: 15px; background-color: #4CAF50; color: white;\">
					Media successfully checked in.</span>";
				}
			}
		}
		
		if (isset($_GET['laptop-id'])) {
			$laptop = $_GET['laptop-id'];
			
			$sql_1 = "SELECT EXISTS (SELECT * FROM Laptop WHERE id = $laptop);";
			$result_1 = $conn->query($sql_1);
			if ($result_1) {
				$sql = "CALL laptop_return($laptop);";
				$result = $conn->query($sql);
			
				if(!$result) {
					echo "<hr><div style=\"padding: 15px; background-color: #f44336; color: white;\">
					SQL error.</span>";
				}
				else {
					echo "<hr><div style=\"padding: 15px; background-color: #4CAF50; color: white;\">
					Laptop successfully checked in.</span>";
				}
			}
		}
		$conn->close();
		?>
	</main>
</div>

<?php include "new_page/common-footer.html"; ?>