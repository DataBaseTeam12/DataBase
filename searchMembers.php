<?php include 'new_php/connectDB.php';
session_start(); 
if(!(isset($_SESSION['logged_in'])) || $_SESSION['userAccount'] == 'Student')
  {
    header("Location: http://www.databaseteam12.x10host.com/");
  } ?>

<!DOCTYPE html>

<title>Search Members</title>

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
		<form name="from" method="get" action="">
		<label><b>Search By</b></label>
			<select id="search-type" name="search-type">
                <option value="" >Select Search Field</option>
				<option value="name" >Name</option>
				<option value="id">ID</option>
				<option value="username">Username</option>
                <option value="email">Email</option>
			</select>

            <label><b>Search</b></label>
            <input type="text" placeholder="Search for..." name="search" required>
            <button type="submit">Search</button>

		</form>

        <?php
        $conn = connect();
        $sql = "SELECT * FROM Member ORDER BY total_fines DESC";

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stype = '';

        if (isset($_GET['search-type'])) {
            $stype = $_GET['search-type'];
        }

        if (isset($_GET['search'])) {
            $value = $_GET['search'];
        }

        switch($stype){
            case "name" :
                $sql = "SELECT * FROM Member WHERE first_name LIKE '%$value%' OR last_name LIKE '%$value%' ORDER BY last_name ASC";
                break;
            case "id" :
                $sql = "SELECT * FROM Member WHERE id LIKE $value";
                break;
            case "username" :
                $sql = "SELECT * FROM Member WHERE username LIKE '%$value%'";
                break;
            case "email" :
                "SELECT * FROM Member WHERE email LIKE '%$value%'";
                break;
        }

        $result = "";


        $result = $conn->query($sql);

        // If result is not empty, display it
        if ($result->num_rows > 0) {
            // Output data from every row 
            while ($row = $result->fetch_assoc()) {

                echo "<hr><h4>" . "Member ID: ". $row["id"] . "<br> " . " Member: ". $row["first_name"] . " " . $row["middle_initial"] . " "
                    . $row["last_name"] . "<br>Account Type: ". $row["userAccount"] . "<br>Fines: $". $row["total_fines"] . "</h4>"
                    ."Address: " .$row["street_address"] . " " . $row["city"] . ", ". $row["state"] . " ". $row["zip_code"] . "<br>"
                    . " Phone Number " .$row["phone_num"] . "<br> SSN:  ". $row["ssn"] . " <br> Email: ". $row["email"] . " <br> Username: ". $row["username"] . "<br>"
                    . "Number of Books:  ". $row["num_books"] . " ";
                    
                

            }

        } else {
            echo "0 results";
        }

        $conn->close();
        ?>
	</main>
</div>

<?php include "new_page/common-footer.html"; ?>