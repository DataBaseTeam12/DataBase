<?php session_start(); ?>

<!DOCTYPE html>

<title>Home</title>

<link rel="stylesheet" href="/new_style/common.css">
<link rel="stylesheet" href="/new_style/drop-down-menu.css">
<link rel="stylesheet" href="/new_style/home.css">

<?php include "new_page/common-header.html"; ?>

<div class="flex">
	<nav class="frow fill">
		<a href="/index.php" class="fl">Home</a>
		
		<?php if($_SESSION['logged_in']) == false) {
			echo "<a href='/login.php' style='margin:0px 5px;'>Login</a>
			<a href='/register.php'>Register</a>";
			}
			else if($_SESSION['logged_in']) == true) {
			echo "<a href='/login.php' style='margin:0px 5px;'>Login</a>
			<a href='/logout.php'>Logout</a>";
			}
		?>
		
	</nav>
</div>

<div class="frow bg-pic" style="flex: 1 0 auto;">
	<aside>
		<?php if(if (isset($_SESSION['userAccount']) && $_SESSION['userAccount'] == 'Faculty') include "new_page/menu-faculty.html"; ?>
		<?php include "new_page/menu-user.html"; ?>
	</aside>
	<main class="grow-row fill-col">-->
	<!--<h2> Welcome! </h2>-->
	<!--<p> This is Team 12's Database project. Please login if you have an account, or register if you're new here. </p>-->
	<!--<p> When logged in, the menu will display on the right. Use it to search for media in the library's collection. </p>-->
	</main>
</div>

<?php include "new_page/common-footer.html"; ?>
