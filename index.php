<?php
   
    session_start();
    include 'new_page/home.html';
    
    $member_id = $_SESSION['user_id']; 
        
   // Temporary test connection; will be removed and use connection in another file
	$servername = "162.253.224.12";
	$username = "databa39_user";
	$password = "databa39team12";
	$dbname = "databa39_library";

	// Create connection (test)
	$conn = new mysqli($servername, $username, $password, $dbname);
	
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
    
    $sql = "SELECT * FROM Member WHERE id='$member_id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    
    // if($row['total_fines'] > 0) {
    //   echo "<script type='text/javascript'>alert('You have unpaid fines.');</script>";
    // }
    
    $conn->close();
?>


