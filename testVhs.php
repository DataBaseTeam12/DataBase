<?php include 'old/addMedia/connectDB.php';
session_start(); 
$member_id = $_SESSION['user_id'];  
 $page =$_GET["page"];
?>

<!DOCTYPE html>

<title>Display All Books</title>

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

input[type=search], input[type=text], select {
	width: 100%;
	display: inline-block;
	padding: 10px 15px;
	margin-top: 5px;
	margin-bottom: 10px;
	border: 1px solid #555;
	box-sizing: border-box;
}
.underline { 
    border-bottom:2px solid #000; 
    
}
</style>

<?php include "new_page/common-header.html"; ?>

<div class="flex">
	<nav class="frow fill">
		<a href="http://www.databaseteam12.x10host.com/" class="fl">Home</a>
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
		<i>Displaying All Books Results:</i><br>
		<!--Content-->
		<?php
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

		// Call procedure or query for specific page
	//	$sql = "SELECT * FROM Full_Book_View ORDER BY title;";
	//	$result = $conn->query($sql);
			 if($page==""||$page=="1"){
		     $page1 =0;
		 }
		 else{
		     $page1 =(($page*10)-10);
		 }
		$val = '';
		// If result is not empty, display it
		$sql = "SELECT DISTINCT id,title,genre,publisher,producer, published_date,audience,language FROM Full_VHS_View ORDER BY title LIMIT $page1,10;";
				$result = $conn->query($sql) or die("failed 1".$conn->error);
		if ($result->num_rows > 0) {
			// Output data from every row
			while($row = $result->fetch_assoc()) {
				$book = $row["id"];
				$copy = 1;
		 
				echo "<hr><h2>".$row["title"]."</h2>"
				.$row["first_name"]." ".$row["last_name"]." "
				.$row["published_date"]."<br>".$row["producer"].".<br><br>
				<a href=\"details.php?id=$book&copy=$copy\">More Details</a><br><br>";
				
				// If the book is available
					$copy_num =checkAvail($row["id"],$conn);
				if ($copy_num != -1) {
					echo "<p><i class='fa fa-check-circle' aria-hidden='true' 
						style='color: #57BC57'></i> media  is 
						<b>available</b>. ";
						
					// If logged in, provide options to reserve or hold
					if ($_SESSION['logged_in'] == true) {
					echo "<form method='post'>
						<input type='submit' class = 'hold' name='hold-$book-$copy' value='Hold'>
						<input type='submit' class ='reserve' name='reserve-$book-$copy' value='Reserve'>
						<input type='hidden' name='memberId' value = $member_id>
						<input type='hidden' name='id' value=$book>
                        <input type='hidden' name='copy' value=$copy_num>
                         
						</form>
						</p>";
			 
					}
				}
				// Else, display status of the book
				else {
					echo "<p><i class='fa fa-times-circle' aria-hidden='true'
						style='color: #D25252'></i> Copy is 
						<b>not available</b>.</p>";
				}
			}
		} else {
			echo "0 results";
		}
			echo"<br></br>";
		echo"<h3 align='center'><b>pages:</b><span>";
			$sql = "SELECT DISTINCT id,title FROM  Full_VHS_View   ORDER BY title ;";
		$result = $conn->query($sql) or die("failed");
		 $count = $result->num_rows;
		$a =ceil($count/10);
		for($i =1;$i<=$a;$i++){
		    echo "<a id='page$i'href='http://www.databaseteam12.x10host.com/testVhs.php?page=$i' ><b>$i</b></a>";
		}
		echo "</span></h3>";
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
  $( '#page'+<?php echo $page; ?>).not(function(){
         $('a').removeClass('underline');
        $(this).addClass('underline');
      });
</script>
</html>
<?php 
 function checkAvail($id,$conn){
    // echo "id is ".$id;
     $sql ="SELECT copy_num FROM Full_VHS_View WHERE id= $id AND is_available ='available' LIMIT 1;";
      
	  	$result = $conn->query($sql)or die("failed".$conn->error);
	  	
				if ($result->num_rows > 0){
				   $row = $result->fetch_assoc();
				    $num_copy = $row['copy_num'] ;
				 //   echo"result is".$num_copy;
				     return $num_copy;
				}else{
				     return -1;
				}
    
 }
 ?>