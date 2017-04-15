<?php
	
	include 'connectDB.php';

	$email = $POST['email'];
	$password = $POST['password'];

	$sql = "SELECT * FROM Member Where email = '$email' AND password = '$password'";
	$result = mysqli_fetch_assoc($result);

	echo $email;
	echo $password;



	
?>