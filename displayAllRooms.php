<?php include 'new_php/connectDB.php';
session_start();
$member_id = $_SESSION['user_id'];  ?>

<!DOCTYPE html>

<title>Display All Rooms</title>

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
		<i>Displaying All Rooms:</i><br>
		<!--Content-->
		<?php
		$conn = connect();
		
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
				
				echo "<hr><table border='1' >
				<tr><td width='30%'><b>Room Number</b></td>
				<td width='30%'>".$row["room_num"]."</td></tr>
				<tr><td><b>Floor Number</b></td>
				<td>".$row["floor"]."</td></tr>
				<tr><td><b>Room Type</b></td>
				<td>".$row["room_type"]."</td></tr>
				<tr><td><b>Capacity</b></td>
				<td>".$row["capacity"]."</td></tr>
				</table>";
				
				$sql2 = "SELECT * FROM Room_Reserves WHERE end_time >= NOW() AND room_num = '$room';";
                $result2 = $conn->query($sql2);

                if ($result2->num_rows > 0) {
                    $row2 = $result2->fetch_assoc();

                    echo "<p><i class='fa fa-times-circle' aria-hidden='true'
						style='color: #D25252'></i> Room is <b>unavailable</b> until "
                        .$row2["end_time"]."</p>";
                }
                else {
                    echo "<p><i class='fa fa-check-circle' aria-hidden='true' 
						style='color: #57BC57'></i> Room is <b>available</b> from ".$row["avail_start"].
                        " to ".$row["avail_end"]."</p>";
                    if ($_SESSION['logged_in'] == true) {
					    $sql4 = "SELECT * FROM Room_Reserves WHERE member_id = '$member_id' AND end_time >= NOW();";
				        $result4 = $conn->query($sql4);
				        $sql5 = "SELECT * FROM Rooms WHERE room_num = '$room' OR avail_start >= CURTIME() OR avail_end <= CURTIME();";
				        $result5 = $conn->query($sql5);
				        
				        if ($result4->num_rows == 0 || $result5->num_rows == 0) {
				            echo "<form>
							<input type='submit' class = 'room' name='room-$room-$floor' value='Reserve'>
							<input type='hidden' name='memberId' value = $member_id>
							<input type='hidden' name='roomNum' value=$room>
							<input type='hidden' name='floor' value=$floor></form>";
				        }
				    }
                }
			}
		} else {
			echo "0 results";
		}
		$conn->close();
		?>
	</main>
</div>

<?php include "new_page/common-footer.html"; ?>

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