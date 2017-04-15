<?php include 'new_php/connectDB.php';
session_start();  ?>

<!DOCTYPE html>

<title>Search Laptops</title>

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
		<form method="get" action="">
		<label><b>Search By</b></label>
			<select id="search-type" name="search-type">
				<option value="" selected>Select Search Type</option>
                <option value="available" >Availability</option>
				<option value="serial" >Serial Number</option>
				<option value="id">Laptop ID</option>
			</select>
			
			<label><b>Search</b></label>
			<input type="search" placeholder="Search for..." name="search" >
			
			<button type="submit">Search</button>
		</form>

        <?php
        $conn = connect();
        $sql = "SELECT * FROM Laptop ORDER BY id ASC";

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
            case "serial" :
                $sql = "SELECT * FROM Laptop WHERE serial LIKE '%$value%'";
                break;
            case "id" :
                $sql = "SELECT * FROM Laptop WHERE id LIKE $value";
                break;
            case "available" :
                $sql = "SELECT * FROM Laptop WHERE NOT EXISTS 
                    (SELECT laptop_id FROM Laptop_Rents WHERE returned_date IS NULL
                    AND Laptop.id = Laptop_Rents.laptop_id)";
                break;
        }


		// Call procedure or query for specific page

		$result = $conn->query($sql);

		// If result is not empty, display it
		if ($result->num_rows > 0) {
            echo "<br><table border='1'><tr><th>Laptop ID</th><th>Serial Number</th>
			<th>Availability</th></tr>";

            // Output data from every row
            while($row = $result->fetch_assoc()) {
                $id = $row["id"];

                echo "<tr><td>".$row["id"]."</td><td>".$row["serial"]."</td>";

                $sql2 = "SELECT * FROM Laptop_Rents WHERE laptop_id = $id AND returned_date IS NULL;";
                $result2 = $conn->query($sql2);

                if ($result2->num_rows > 0) {
                    echo "<td><i class='fa fa-times-circle' aria-hidden='true'
						style='color: #D25252'></i> Laptop is rented</td></tr>";
                }
                else {
                    echo "<td><i class='fa fa-check-circle' aria-hidden='true' 
						style='color: #57BC57'></i> Laptop is available</td></tr>";
                }
            }

            echo "</table>";
        } else {
            echo "<hr>0 results";
        }
		$conn->close();
		?>
	</main>
</div>

<?php include "new_page/common-footer.html"; ?>