<?php include 'new_php/connectDB.php';
session_start(); 
$member_id = $_SESSION['user_id'];  ?>

<!DOCTYPE html>

<title>Details</title>

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
		<a href="/index.php" class="fl">Home</a>
		<?php if($_SESSION['logged_in'] == true): ?>
		    <a href="/profile.php">Profile</a> 
            <a href="/login/logout.php" style="margin:0px 5px;">Logout</a>
		<?php else: ?>
		    <a href="/login.php" style="margin:0px 5px;">Login</a>
		    <a href="/register.php">Register</a>
		<?php endif; ?>
	</nav>
</div>

<div class="frow bg-pic" style="flex: 1 0 auto;">
	<aside>
		<?php if(isset($_SESSION['userAccount']) && $_SESSION['userAccount'] == 'Faculty') include "new_page/menu-faculty.html"; ?>
		<?php include "new_page/menu-user.html"; ?>
	</aside>
	<main class="grow-row fill-col">
		<!--Content-->
		<?php
		$conn = connect();
		
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		
		// If details button pressed, information will be placed in web address upon refresh
		// Variables used to hold values
		$book = htmlspecialchars($_GET["id"]);
		$copy = htmlspecialchars($_GET["copy"]);

		// Call procedure or query for specific page
		$sqla = "SELECT * FROM Media WHERE id = $book AND copy_num = $copy;";
		$resulta = $conn->query($sqla);
		$sqlb = "SELECT * FROM Book WHERE book_id = $book AND copy_num = $copy;";
		$resultb = $conn->query($sqlb);
		$sqlc = "SELECT * FROM Cassette WHERE cassette_id = $book AND copy_num = $copy;";
		$resultc = $conn->query($sqlc);
		$sqld = "SELECT * FROM CD WHERE cd_id = $book AND copy_num = $copy;";
		$resultd = $conn->query($sqld);
		$sqle = "SELECT * FROM DVD WHERE dvd_id = $book AND copy_num = $copy;";
		$resulte = $conn->query($sqle);
		$sqlf = "SELECT * FROM VHS WHERE vhs_id = $book AND copy_num = $copy;";
		$resultf = $conn->query($sqlf);
		$sqlg = "SELECT * FROM Author WHERE media_id = $book;";
		$resultg = $conn->query($sqlg);
		
		// If result is not empty, display it
		if ($resulta->num_rows > 0) {
			// if book
			if ($resultb->num_rows > 0) {
				$row2 = $resultb->fetch_assoc();
			}
			// if cassette
			else if ($resultc->num_rows > 0) {
				$row2 = $resultc->fetch_assoc();
			}
			// if cd
			else if ($resultd->num_rows > 0) {
				$row2 = $resultd->fetch_assoc();
			}
			// if dvd
			else if ($resulte->num_rows > 0) {
				$row2 = $resulte->fetch_assoc();
			}
			// if vhs
			else if ($resultf->num_rows > 0) {
				$row2 = $resultf->fetch_assoc();
			}
			
			// Outputs data
			$row = $resulta->fetch_assoc();
			
			echo "<h2>Details of ".$row["title"]."</h2><hr><table>
			<tr><td width='30%' align='right'><b>Title</b></td><td width='70%'>".$row["title"]."</td></tr>";
			
			// if book
			if ($resultb->num_rows > 0) {
				echo "<tr><td align='right'><b>Edition</b></td><td>".$row2["edition"]."</td></tr></p>";
			}
			
			// if has authors
			if ($resultg->num_rows > 0) {
				echo "<tr><td align='right'><b>Author(s)</b></td><td>";
				while ($row3 = $resultg->fetch_assoc()) {
					echo $row3["first_name"]." ".$row3["last_name"]."<br>";
				}
				echo "</td></tr>";
			}
			
			echo "<tr><td align='right'><b>Genre</b></td><td>".$row["genre"]."</td></tr>
			<tr><td align='right'><b>Publisher</b></td><td>".$row["publisher"]."</td></tr>
			<tr><td align='right'><b>Published Date</b></td><td>".$row["published_date"]."</td></tr>";
			
			// if book
			if ($resultb->num_rows > 0) {
				echo "<tr><td align='right'><b>Format</b></td><td>".$row2["num_pages"]." pages : ".$row2["type"]."</td></tr>";
			}
			// if cassette
			else if ($resultc->num_rows > 0) {
				echo "<tr><td align='right'><b>Format</b></td><td>audio cassette (approximately "
				.$row2["total_runtime"]." min.) : analog</td></tr>
				<tr><td align='right'><b>Producer</b></td><td>".$row2["producer"]."</td></tr>";
			}
			// if cd
			else if ($resultd->num_rows > 0) {
				echo "<tr><td align='right'><b>Format</b></td><td>audio disc (approximately "
				.$row2["total_runtime"]." min.) : "
				.$row2["num_tracks"]." tracks : digital</td></tr>
				<tr><td align='right'><b>Producer</b></td><td>".$row2["producer"]."</td></tr>";
			}
			// if dvd
			else if ($resulte->num_rows > 0) {
				echo "<tr><td align='right'><b>Format</b></td><td>videodisc (approximately ".$row2["total_runtime"]." min.)</td></tr>
				<tr><td align='right'><b>Producer</b></td><td>".$row2["producer"]."</td></tr>
				<tr><td align='right'><b>Director</b></td><td>".$row2["director"]."</td></tr>";
			}
			// if vhs
			else if ($resultf->num_rows > 0) {
				echo "<tr><td align='right'><b>Format</b></td><td>videotape (approximately ".$row2["total_runtime"]." min.)</td></tr>
				<tr><td align='right'><b>Producer</b></td><td>".$row2["producer"]."</td></tr>
				<tr><td align='right'><b>Director</b></td><td>".$row2["director"]."</td></tr>";
			}
			
			echo "<tr><td align='right'><b>Audience</b></td><td>".$row["audience"]."</td></tr>
			<tr><td align='right'><b>Language</b></td><td>".$row["language"]."</td></tr>";
			
			// if book
			if ($resultb->num_rows > 0) {
				echo "<tr><td align='right'><b>ISBN 10</b></td><td>".$row2["ISBN_10"]."</td></tr>
				<tr><td align='right'><b>ISBN 13</b></td><td>".$row2["ISBN_13"]."</td></tr>";
			}
			// if other
			else if ($resultc->num_rows > 0 || $resultd->num_rows > 0 ||
						$resulte->num_rows > 0 || $resultf->num_rows > 0) {
				echo "<tr><td align='right'><b>UPC</b></td><td>".$row2["UPC"]."</td></tr>";
			}
			
			echo "</table>";
			
			// If the book is available
			if ($row["is_available"] == "available") {
				echo "<p><i class='fa fa-check-circle' aria-hidden='true' 
					style='color: #57BC57'></i> Copy #".$row["copy_num"]." is 
					<b>available</b>. ";
					
				// If logged in, provide options to reserve or hold
						if ($_SESSION['logged_in'] == true) {
							echo "<form>
								<input type='submit' class = 'hold' name='hold-$book-$copy' value='Hold'>
								<input type='submit' class ='reserve' name='reserve-$book-$copy' value='Reserve'>
								<input type='hidden' name='memberId' value = $member_id>
								<input type='hidden' name='id' value=$book>
								<input type='hidden' name='copy' value=$copy>
								 
								</form>
								</p>";
						}
			}
			// Else, display status of the book
			else {
				echo "<p><i class='fa fa-times-circle' aria-hidden='true'
					style='color: #D25252'></i> Copy #".$row["copy_num"]." is 
					<b>".$row["is_available"]."</b>.</p>";
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
 $('.hold').click( function(){
   
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
           xmlhttp.open("GET", "hold_reserve.php"+"?t="+"hold"+"&data="+data , true);
          xmlhttp.send();
     });
 });
   $('.reserve').click( function(){
        // alert("enter reserve");
       $('form').submit(function(){
          var data = $(this).serializeArray();
           data = JSON.stringify(data);
           var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                  alert(this.responseText);
 
              }
          };
           xmlhttp.open("GET", "hold_reserve.php"+"?t="+"reserve"+"&data="+data , true);
          xmlhttp.send();
     });
 });
 </script>