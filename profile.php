<?php include 'new_php/connectDB.php';
session_start(); 
$member_id = $_SESSION['user_id']; 

if(!(isset($_SESSION['logged_in'])))
  {
    header("Location: /index.php");
  } ?>

<!DOCTYPE html>

<title>Member Profile</title>

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
<style>
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
		<?php
		$conn = connect();

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
		
        $sql = "SELECT * FROM Member WHERE id = $member_id;";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        echo "<h2>".$row["first_name"]." ".$row["middle_initial"]." ".$row["last_name"]."</h2>
		<b>Fines:</b> $".$row["total_fines"]."<br><b>Address: </b>".$row["street_address"]." "
		.$row["city"].", ".$row["state"]." ".$row["zip_code"]."<br>
		<b>Phone Number: </b>".$row["phone_num"]."<br><b>Email: </b>".$row["email"]."<br>";
		
		$sql_2 = "SELECT S.title, S.check_out_date, S.due_date FROM 
			(SELECT Media.title, Media_Borrows.member_id, Media_Borrows.check_out_date, Media_Borrows.check_in_date, 
			Media_Borrows.due_date FROM Media JOIN Media_Borrows ON Media_Borrows.media_id = Media.id 
			AND Media_Borrows.copy_num = Media.copy_num) AS S WHERE S.member_id = '$member_id' 
			AND S.check_in_date IS NULL;";
        $result_2 = $conn->query($sql_2);
		
        if ($result_2->num_rows > 0) {
			echo "<br><b>Checked Out Media:</b><br>
			<table><tr><th>Media Title</th><th>Check-Out Date</th><th>Due Date</th></tr>";
			// Output data from every row
			while ($row_2 = $result_2->fetch_assoc()) {
				echo "<tr><td>".$row_2["title"]."</td><td>"
					.$row_2["check_out_date"]."</td><td>"
					.$row_2["due_date"]."</td></tr>";
			}
			echo "</table>";
		}
		
		$sql_3 = "SELECT serial, start_date, end_date FROM Laptop_Rent_View WHERE member_id = '$member_id' 
			AND returned_date IS NULL;";
        $result_3 = $conn->query($sql_3);
		
        if ($result_3->num_rows > 0) {
			echo "<br><b>Rented Laptop:</b><br>
			<table><tr><th>Laptop Serial</th><th>Check-Out Date</th><th>Due Date</th></tr>";
			// Output data from every row
			while ($row_3 = $result_3->fetch_assoc()) {
				echo "<tr><td>".$row_3["serial"]."</td><td>"
					.$row_3["start_date"]."</td><td>"
					.$row_3["end_date"]."</td></tr>";
			}
			echo "</table>";
		}
		
		$sql_4 = "SELECT title, start_date, end_date FROM Member_Hold_View WHERE member_id = '$member_id' 
			AND end_date >= CURDATE();";
        $result_4 = $conn->query($sql_4);
		
        if ($result_4->num_rows > 0) {
			echo "<br><b>Held Media:</b><br>
			<table><tr><th>Media Title</th><th>Hold Start Date</th><th>Hold End Date</th></tr>";
			// Output data from every row
			while ($row_4 = $result_4->fetch_assoc()) {
				echo "<tr><td>".$row_4["title"]."</td><td>"
					.$row_4["start_date"]."</td><td>"
					.$row_4["end_date"]."</td></tr>";
			}
			echo "</table>";
		}
		
		$sql_5 = "SELECT title, start_time, end_time FROM Member_Reserve_View WHERE member_id = '$member_id' 
			AND end_time >= NOW();";
        $result_5 = $conn->query($sql_5);
		
        if ($result_5->num_rows > 0) {
			echo "<br><b>Reserved Media:</b><br>
			<table><tr><th>Media Title</th><th>Reserve Start Time</th><th>Reserve End Time</th></tr>";
			// Output data from every row
			while ($row_5 = $result_5->fetch_assoc()) {
				echo "<tr><td>".$row_5["title"]."</td><td>"
					.$row_5["start_time"]."</td><td>"
					.$row_5["end_time"]."</td></tr>";
			}
			echo "</table>";
		}
		
		$sql_6 = "SELECT room_num, floor_num, start_time, end_time FROM Room_Reserves WHERE member_id = '$member_id' 
			AND end_time >= NOW();";
        $result_6 = $conn->query($sql_6);
		
        if ($result_6->num_rows > 0) {
			echo "<br><b>Room Reservation:</b><br>
			<table><tr><th>Room Number</th><th>Floor Number</th><th>Reserve Start Time</th><th>Reserve End Time</th></tr>";
			// Output data from every row
			while ($row_6 = $result_6->fetch_assoc()) {
				echo "<tr><td>".$row_6["room_num"]."</td><td>"
					.$row_6["floor_num"]."</td><td>"
					.$row_6["start_time"]."</td><td>"
					.$row_6["end_time"]."</td></tr>";
			}
			echo "</table>";
		}

        $conn->close();
        ?>
	</main>
</div>

<?php include "new_page/common-footer.html"; ?>