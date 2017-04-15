<?php include 'new_php/connectDB.php';
session_start(); 
if(!(isset($_SESSION['logged_in'])) || $_SESSION['userAccount'] == 'Student')
  {
    header("Location: http://www.databaseteam12.x10host.com/");
  } ?>

<!DOCTYPE html>

<title>Check-Out</title>

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
			<label><b>Member ID</b></label>
			<input type="number" min="1" name="member-id" required>
			<hr>
			<label><b>Media ID</b></label>
			<input type="number" min="1" name="media-id" >
			
			<label><b>Copy Number</b></label>
			<input type="number" min="1" name="copy">
			
			<label>OR<br><br><b>Laptop ID</b></label>
			<input type="number" min="1" name="laptop-id">
			
			<button type="submit">Check-Out</button>
		</form>

		<?php
		$conn = connect();
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
				
				if ($row_1["is_available"] == "reserved") {
        			$sql_r = "SELECT * FROM Media_Reserves WHERE media_id = $book AND copy_num = $copy AND end_time >= NOW();";
        			$result_r = $conn->query($sql_r);
        			
				    if ($result_r->num_rows > 0) {
				        $row_r = $result_r->fetch_assoc();
				        if ($row_r["member_id"] == $member) {
				            $sql_4 = "SELECT num_books, total_fines, userAccount FROM Member WHERE id = $member;";
        					$result_4 = $conn->query($sql_4);
        					$row = $result_4->fetch_assoc();
        					
        					if ($row["num_books"] >= 10 && $row["userAccount"] == "Student") {
        						echo "<hr><div style=\"padding: 15px; background-color: #f44336; color: white;\">
        						User has reached the maximum number of books allowed out.</span>";
        					}
        					else if ($row["total_fines"] > 0) {
        						echo "<hr><div style=\"padding: 15px; background-color: #f44336; color: white;\">
        						User has fines.</span>";
        					}
        					else {
        					    $sql_rr = "CALL check_out_reserve($member, $book, $copy);";
        						$result_rr = $conn->query($sql_rr);
        						
        						if (!$result_rr) {
        							echo "<hr><div style=\"padding: 15px; background-color: #f44336; color: white;\">
        							SQL error.</span>";
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
				        else {
            				echo "<hr><div style=\"padding: 15px; background-color: #f44336; color: white;\">
            				Media is <b>unavailable</b>, please select another.</span>";
				        }
				    }
				} 
				else if ($row_1["is_available"] == "on hold") {
        			$sql_h = "SELECT * FROM Media_Holds WHERE media_id = $book AND copy_num = $copy AND end_date >= CURDATE();";
        			$result_h = $conn->query($sql_h);
        			
				    if ($result_h->num_rows > 0) {
				        $row_h = $result_h->fetch_assoc();
				        if ($row_h["member_id"] == $member) {
				            $sql_4 = "SELECT num_books, total_fines, userAccount FROM Member WHERE id = $member;";
        					$result_4 = $conn->query($sql_4);
        					$row = $result_4->fetch_assoc();
        					
        					if ($row["num_books"] >= 10 && $row["userAccount"] == "Student") {
        						echo "<hr><div style=\"padding: 15px; background-color: #f44336; color: white;\">
        						User has reached the maximum number of books allowed out.</span>";
        					}
        					else if ($row["total_fines"] > 0) {
        						echo "<hr><div style=\"padding: 15px; background-color: #f44336; color: white;\">
        						User has fines.</span>";
        					}
        					else {
        					    $sql_rh = "CALL check_out_hold($member, $book, $copy);";
        						$result_rh = $conn->query($sql_rh);
        						
        						if (!$result_rh) {
        							echo "<hr><div style=\"padding: 15px; background-color: #f44336; color: white;\">
        							SQL error.</span>";
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
				        else {
            				echo "<hr><div style=\"padding: 15px; background-color: #f44336; color: white;\">
            				Media is <b>unavailable</b>, please select another.</span>";
				        }
				    }
				}
				else {
					$sql_4 = "SELECT num_books, total_fines, userAccount FROM Member WHERE id = $member;";
					$result_4 = $conn->query($sql_4);
					$row = $result_4->fetch_assoc();
					
					if ($row["num_books"] >= 10 && $row["userAccount"] == "Student") {
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
</div>

<?php include "new_page/common-footer.html"; ?>