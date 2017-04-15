<?php include 'new_php/connectDB.php';
session_start();  
if(!(isset($_SESSION['logged_in'])) || $_SESSION['userAccount'] == 'Student')
  {
    header("Location: http://www.databaseteam12.x10host.com/");
  } ?>

<!DOCTYPE html>

<title>Reports</title>

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

        input[type=search], input[type=date], select {
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

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>jQuery UI Datepicker - Default functionality</title>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


		<form name="form" action="" method="get">
			<label><b>Report Type</b></label>
			<select id="report-type" name="report-type">
				<option value="">-Choose Report Type-</option>
				<option value="checked-out">Checked Out Media</option>
				<option value="held">Held Media</option>
				<option value="reserved">Reserved Media</option>
				<option value="laptops">Rented Laptops</option>
				<option value="rooms">Reserved Rooms</option>
			</select>
			
			<label><b>Date Range</b></label>
			<select id="date-type" name="date-type">
				<option value="">-Choose Date Range-</option>
				<option value="day">Date</option>
				<option value="days">Date Range</option>
				<option value="month">Month</option>
				<option value="year">Year</option>
			</select>

            <script>
                $( function() {
                    $( "#datepicker" ).datepicker({dateFormat: 'yy-mm-dd'});
                    $( "#start" ).datepicker({dateFormat: 'yy-mm-dd'});
                    $( "#end" ).datepicker({dateFormat: 'yy-mm-dd'});
                } );
            </script>


            <div class="day box">
				<label><b>Date: </b></label>
				<input type="date" id="datepicker" name="one-day">
			</div>

			<div class="days box">
				<label>Start Date:</label>
				<input type="date" id="start" name="start-day">
				<label>End Date:</label>
				<input type="date" id="end" name="end-day">
			</div>

			<div class="month box">
				<label>Month:</label>
				<select id="month-choice" name="month-choice">
					<option value="1">January</option>
					<option value="2">February</option>
					<option value="3">March</option>
					<option value="4">April</option>
					<option value="5">May</option>
					<option value="6">June</option>
					<option value="7">July</option>
					<option value="8">August</option>
					<option value="9">September</option>
					<option value="10">October</option>
					<option value="11">November</option>
					<option value="12">December</option>
				</select>
			</div>
			<div class="year box">
				<label>Year:</label>
				<input type="text" placeholder="YYYY" name="year">
			</div>
			
			<button type="submit">Search</button>
		</form>

		<?php
        $count = 0;
		$conn = connect();
		$sql = "";

		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		$rtype = '';
		$dtype = '';

		if (isset($_GET['report-type'])) {
			$rtype = $_GET['report-type'];
		}
		if (isset($_GET['date-type'])) {
			$dtype = $_GET['date-type'];
		}
		if (isset($_GET['one-day'])) {
			$date = $_GET['one-day'];
		}
		if (isset($_GET['start-day'])) {
			$start = $_GET['start-day'];
		}
		if (isset($_GET['end-day'])) {
			$end = $_GET['end-day'];
		}
		if (isset($_GET['month-choice'])) {
			$month = $_GET['month-choice'];
		}
		if (isset($_GET['year'])) {
			$year = $_GET['year'];
		}
		
		if ($rtype == "checked-out") {
			echo "<hr><h2>Checked-Out Media";
			switch ($dtype) {
				case "day":
					$sql = "SELECT * FROM Media_Borrows WHERE check_out_date = '$date'";
					echo " On $date</h2>";
					break;
				case "days":
					$sql = "SELECT * FROM Media_Borrows WHERE check_out_date BETWEEN '$start' AND '$end'";
					echo " From $start To $end</h2>";
					break;
				case "month":
					$sql = "SELECT * FROM Media_Borrows WHERE MONTH(check_out_date) = '$month'";
					echo " In ";
					switch ($month) {
						case "1":
							echo " January</h2>";
							break;
						case "2":
							echo " February</h2>";
							break;
						case "3":
							echo " March</h2>";
							break;
						case "4":
							echo " April</h2>";
							break;
						case "5":
							echo " May</h2>";
							break;
						case "6":
							echo " June</h2>";
							break;
						case "7":
							echo " July</h2>";
							break;
						case "8":
							echo " August</h2>";
							break;
						case "9":
							echo " September</h2>";
							break;
						case "10":
							echo " October</h2>";
							break;
						case "11":
							echo " November</h2>";
							break;
						case "12":
							echo " December</h2>";
							break;
					}
					break;
				case "year":
					$sql = "SELECT * FROM Media_Borrows WHERE YEAR(check_out_date) = '$year'";
					echo " In $year</h2>";
					break;
			}
		
			$result = $conn->query($sql);
			
			// If result is not empty, display it
			if ($result->num_rows > 0) {
				echo "<br><table><tr><th>Member ID</th><th>Media ID</th><th>Check-Out Date</th>
				<th>Check-In Date</th><th>Due Date</th></tr>";
				// Output data from every row
				while ($row = $result->fetch_assoc()) {
				    $count++;
					echo "<tr><td>".$row["member_id"]."</td><td>"
						.$row["media_id"]."-".$row["copy_num"]."</td><td>"
						.$row["check_out_date"]."</td><td>"
						.$row["check_in_date"]."</td><td>"
						.$row["due_date"]."</td></tr>";
				}
                echo " <b> " . "Total Checked-Out Media: " .  $count . " <b> ". "<br>";
                echo "</table>" ." <br>";

			} 
			else {
				echo "<br>0 results";
			}
		} else if ($rtype == "held") {
			echo "<hr><h2>Held Media";
			switch ($dtype) {
				case "day":
					$sql = "SELECT * FROM Media_Holds WHERE start_date = '$date'";
					echo " On $date</h2>";
					break;
				case "days":
					$sql = "SELECT * FROM Media_Holds WHERE start_date BETWEEN '$start' AND '$end'";
					echo " From $start To $end</h2>";
					break;
				case "month":
					$sql = "SELECT * FROM Media_Holds WHERE MONTH(start_date) = '$month'";
					echo " In ";
					switch ($month) {
						case "1":
							echo " January</h2>";
							break;
						case "2":
							echo " February</h2>";
							break;
						case "3":
							echo " March</h2>";
							break;
						case "4":
							echo " April</h2>";
							break;
						case "5":
							echo " May</h2>";
							break;
						case "6":
							echo " June</h2>";
							break;
						case "7":
							echo " July</h2>";
							break;
						case "8":
							echo " August</h2>";
							break;
						case "9":
							echo " September</h2>";
							break;
						case "10":
							echo " October</h2>";
							break;
						case "11":
							echo " November</h2>";
							break;
						case "12":
							echo " December</h2>";
							break;
					}
					break;
				case "year":
					$sql = "SELECT * FROM Media_Holds WHERE YEAR(start_date) = '$year'";
					echo " In $year</h2>";
					break;
			}
		
			$result = $conn->query($sql);
			
			// If result is not empty, display it
			if ($result->num_rows > 0) {
				echo "<br><table><tr><th>Member ID</th><th>Media ID</th><th>Start Date</th>
				<th>End Date</th></tr>";
				// Output data from every row
				while ($row = $result->fetch_assoc()) {
				    $count++;
					echo "<tr><td>".$row["member_id"]."</td><td>"
						.$row["media_id"]."-".$row["copy_num"]."</td><td>"
						.$row["start_date"]."</td><td>"
						.$row["end_date"]."</td></tr>";
				}
                echo " <b> " . "Total Held Media: " .  $count . " <b> ". "<br>";
                echo "</table>" ." <br>";
			} 
			else {
				echo "<br>0 results";
			}
		} else if ($rtype == "reserved") {
			echo "<hr><h2>Reserved Media";
			switch ($dtype) {
				case "day":
					$sql = "SELECT * FROM Media_Reserves WHERE DATE(start_time) = '$date'";
					echo " On $date</h2>";
					break;
				case "days":
					$sql = "SELECT * FROM Media_Reserves WHERE DATE(start_time) BETWEEN '$start' AND '$end'";
					echo " From $start To $end</h2>";
					break;
				case "month":
					$sql = "SELECT * FROM Media_Reserves WHERE MONTH(start_time) = '$month'";
					echo " In ";
					switch ($month) {
						case "1":
							echo " January</h2>";
							break;
						case "2":
							echo " February</h2>";
							break;
						case "3":
							echo " March</h2>";
							break;
						case "4":
							echo " April</h2>";
							break;
						case "5":
							echo " May</h2>";
							break;
						case "6":
							echo " June</h2>";
							break;
						case "7":
							echo " July</h2>";
							break;
						case "8":
							echo " August</h2>";
							break;
						case "9":
							echo " September</h2>";
							break;
						case "10":
							echo " October</h2>";
							break;
						case "11":
							echo " November</h2>";
							break;
						case "12":
							echo " December</h2>";
							break;
					}
					break;
				case "year":
					$sql = "SELECT * FROM Media_Reserves WHERE YEAR(start_time) = '$year'";
					echo " In $year</h2>";
					break;
			}
		
			$result = $conn->query($sql);
			
			// If result is not empty, display it
			if ($result->num_rows > 0) {
				echo "<br><table><tr><th>Member ID</th><th>Media ID</th>
				<th>Start Time</th><th>End Time</th></tr>";
				// Output data from every row
				while ($row = $result->fetch_assoc()) {
				    $count++;
					echo "<tr><td>".$row["member_id"]."</td><td>"
						.$row["media_id"]."-".$row["copy_num"]."</td><td>"
						.$row["start_time"]."</td><td>"
						.$row["end_time"]."</td></tr>";
				}
                echo " <b> " . "Total Reserved Media: " .  $count . " <b> ". "<br>";
                echo "</table>" ." <br>";
			} 
			else {
				echo "<br>0 results";
			}
		} else if ($rtype == "laptops") {
			echo "<hr><h2>Rented Laptops";
			switch ($dtype) {
				case "day":
					$sql = "SELECT * FROM Laptop_Rents WHERE start_date = '$date'";
					echo " On $date</h2>";
					break;
				case "days":
					$sql = "SELECT * FROM Laptop_Rents WHERE start_date BETWEEN '$start' AND '$end'";
					echo " From $start To $end</h2>";
					break;
				case "month":
					$sql = "SELECT * FROM Laptop_Rents WHERE MONTH(start_date) = '$month'";
					echo " In ";
					switch ($month) {
						case "1":
							echo " January</h2>";
							break;
						case "2":
							echo " February</h2>";
							break;
						case "3":
							echo " March</h2>";
							break;
						case "4":
							echo " April</h2>";
							break;
						case "5":
							echo " May</h2>";
							break;
						case "6":
							echo " June</h2>";
							break;
						case "7":
							echo " July</h2>";
							break;
						case "8":
							echo " August</h2>";
							break;
						case "9":
							echo " September</h2>";
							break;
						case "10":
							echo " October</h2>";
							break;
						case "11":
							echo " November</h2>";
							break;
						case "12":
							echo " December</h2>";
							break;
					}
					break;
				case "year":
					$sql = "SELECT * FROM Laptop_Rents WHERE YEAR(start_date) = '$year'";
					echo " In $year</h2>";
					break;
			}
		
			$result = $conn->query($sql);
			
			// If result is not empty, display it
			if ($result->num_rows > 0) {
				echo "<br><table><tr><th>Member ID</th><th>Laptop ID</th><th>Start Date</th>
				<th>End Date</th><th>Returned Date</th></tr>";
				// Output data from every row
				while ($row = $result->fetch_assoc()) {
				    $count++;
					echo "<tr><td>".$row["member_id"]."</td><td>"
						.$row["laptop_id"]."</td><td>"
						.$row["start_date"]."</td><td>"
						.$row["end_date"]."</td><td>"
						.$row["returned_date"]."</td></tr>";
				}
                echo " <b> " . "Total Rented Laptops: " .  $count . " <b> ". "<br>";
                echo "</table>" ." <br>";
			} 
			else {
				echo "<br>0 results";
			}
		} else if ($rtype == "rooms") {
			echo "<hr><h2>Reserved Rooms";
			switch ($dtype) {
				case "day":
					$sql = "SELECT * FROM Room_Reserves WHERE DATE(start_time) = '$date'";
					echo " On $date</h2>";
					break;
				case "days":
					$sql = "SELECT * FROM Room_Reserves WHERE DATE(start_time) BETWEEN '$start' AND '$end'";
					echo " From $start To $end</h2>";
					break;
				case "month":
					$sql = "SELECT * FROM Room_Reserves WHERE MONTH(start_time) = '$month'";
					echo " In ";
					switch ($month) {
						case "1":
							echo " January</h2>";
							break;
						case "2":
							echo " February</h2>";
							break;
						case "3":
							echo " March</h2>";
							break;
						case "4":
							echo " April</h2>";
							break;
						case "5":
							echo " May</h2>";
							break;
						case "6":
							echo " June</h2>";
							break;
						case "7":
							echo " July</h2>";
							break;
						case "8":
							echo " August</h2>";
							break;
						case "9":
							echo " September</h2>";
							break;
						case "10":
							echo " October</h2>";
							break;
						case "11":
							echo " November</h2>";
							break;
						case "12":
							echo " December</h2>";
							break;
					}
					break;
				case "year":
					$sql = "SELECT * FROM Room_Reserves WHERE YEAR(start_time) = '$year'";
					echo " In $year</h2>";
					break;
			}
		
			$result = $conn->query($sql);
			
			// If result is not empty, display it
			if ($result->num_rows > 0) {
				echo "<br><table><tr><th>Member ID</th><th>Room Number</th>
				<th>Start Time</th><th>End Time</th></tr>";
				// Output data from every row
				while ($row = $result->fetch_assoc()) {
				    $count++;
					echo "<tr><td>".$row["member_id"]."</td><td>"
						.$row["room_num"]."</td><td>"
						.$row["start_time"]."</td><td>"
						.$row["end_time"]."</td></tr>";
				}
                echo " <b> " . "Total Reserved Rooms: " .  $count . " <b> ". "<br>";
                echo "</table>" ." <br>";
			} 
			else {
				echo "<br>0 results";
			}
		}

		$conn->close();
		?>
	</main>
</div>

<?php include "new_page/common-footer.html"; ?>