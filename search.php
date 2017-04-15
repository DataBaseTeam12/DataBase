<?php include 'new_php/connectDB.php';
session_start(); 
$member_id = $_SESSION['user_id'];  ?>

<!DOCTYPE html>

<title>Search</title>

<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="no-cache">
<meta http-equiv="Expires" content="-1">
<meta http-equiv="Cache-Control" content="no-cache">

<link rel="stylesheet" href="/new_style/common.css">
<link rel="stylesheet" href="/new_style/drop-down-menu.css">
<link rel="stylesheet" href="/new_style/home.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!--Embedded code for Font Awesome icons-->
<script src="https://use.fontawesome.com/4f7fcc0d3d.js"></script>

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
    <script language="javascript" type="text/javascript">
        function dynamicdropdown(listindex) {
            document.getElementById("search-type").length = 0;
            switch(listindex){
                case "all" :
                    document.getElementById("search-type").options[0] = new Option("Artist", "artist");
                    document.getElementById("search-type").options[1] = new Option("Author Last Name", "author");
                    document.getElementById("search-type").options[2] = new Option("Title", "title");
                    break;
                case "book" :
                    document.getElementById("search-type").options[0] = new Option("Audience", "audience");
                    document.getElementById("search-type").options[1] = new Option("Author Last Name", "author");
                    document.getElementById("search-type").options[2] = new Option("Genre", "genre");
                    document.getElementById("search-type").options[3] = new Option("ISBN-10", "isbn10");
                    document.getElementById("search-type").options[4] = new Option("ISBN-13", "isbn13");
                    document.getElementById("search-type").options[5] = new Option("Language", "language");
                    document.getElementById("search-type").options[6] = new Option("Publisher", "publisher");
                    document.getElementById("search-type").options[7] = new Option("Title", "title");
                    document.getElementById("search-type").options[8] = new Option("Year Published", "publish_date");
                    break;
                case "cassette" :
                    document.getElementById("search-type").options[0] = new Option("Artist", "artist");
                    document.getElementById("search-type").options[1] = new Option("Audience", "audience");
                    document.getElementById("search-type").options[2] = new Option("Genre", "genre");
                    document.getElementById("search-type").options[3] = new Option("Language", "language");
                    document.getElementById("search-type").options[4] = new Option("Producer", "producer");
                    document.getElementById("search-type").options[5] = new Option("Publisher", "publisher");
                    document.getElementById("search-type").options[6] = new Option("Title", "title");
                    document.getElementById("search-type").options[7] = new Option("Year Published", "publish_date");
                    break;
                case "cd" :
                    document.getElementById("search-type").options[0] = new Option("Artist", "artist");
                    document.getElementById("search-type").options[1] = new Option("Audience", "audience");
                    document.getElementById("search-type").options[2] = new Option("Genre", "genre");
                    document.getElementById("search-type").options[3] = new Option("Language", "language");
                    document.getElementById("search-type").options[4] = new Option("Producer", "producer");
                    document.getElementById("search-type").options[5] = new Option("Publisher", "publisher");
                    document.getElementById("search-type").options[6] = new Option("Title", "title");
                    document.getElementById("search-type").options[7] = new Option("Year Published", "publish_date");
                    break;
                case "dvd" :
                    document.getElementById("search-type").options[0] = new Option("Audience", "audience");
                    document.getElementById("search-type").options[1] = new Option("Director", "director");
                    document.getElementById("search-type").options[2] = new Option("Genre", "genre");
                    document.getElementById("search-type").options[3] = new Option("Language", "language");
                    document.getElementById("search-type").options[4] = new Option("Producer", "producer");
                    document.getElementById("search-type").options[5] = new Option("Publisher", "publisher");
                    document.getElementById("search-type").options[6] = new Option("Title", "title");
                    document.getElementById("search-type").options[7] = new Option("Year Published", "publish_date");
                    break;
                case "vhs" :
                    document.getElementById("search-type").options[0] = new Option("Audience", "audience");
                    document.getElementById("search-type").options[1] = new Option("Director", "director");
                    document.getElementById("search-type").options[2] = new Option("Genre", "genre");
                    document.getElementById("search-type").options[3] = new Option("Language", "language");
                    document.getElementById("search-type").options[4] = new Option("Producer", "producer");
                    document.getElementById("search-type").options[5] = new Option("Publisher", "publisher");
                    document.getElementById("search-type").options[6] = new Option("Title", "title");
                    document.getElementById("search-type").options[7] = new Option("Year Published", "publish_date");
                    break;
            }
            return true;
        }
    </script>

    <form name="form" action="" method="get">
        <label><b>Media Type</b></label>
        <select id="media-type" name="media-type" onchange="javascript: dynamicdropdown(this.options[this.selectedIndex].value);">
            <option value="">Please Select Media Type</option>
            <option value="all" >All</option>
            <option value="book">Book</option>
            <option value="cassette">Cassette</option>
            <option value="cd">CD</option>
            <option value="dvd">DVD</option>
            <option value="vhs">VHS</option>
        </select>

        <label><b>Search Type</b></label>
        <script type="text/javascript" language="JavaScript">
        document.write('<select name=search-type id="search-type" ><option value="">Please Select Search Type</option></select>')
        </script>
        <noscript>
            <select name=search-type id="search-type"><option value="">Please Select Search Type</option>
        </noscript>
<!--        <select id="search-type" name="search-type">-->
<!--            <option value="artist">Artist</option>-->
<!--            <option value="audience">Audience</option>-->
<!--            <option value="author">Author</option>-->
<!--            <option value="director">Director</option>-->
<!--            <option value="genre">Genre</option>-->
<!--            <option value="isbn10">ISBN-10</option>-->
<!--            <option value="isbn13">ISBN-13</option>-->
<!--            <option value="language">Language</option>-->
<!--            <option value="producer">Producer</option>-->
<!--            <option value="publisher">Publisher</option>-->
<!--            <option value="title">Title</option>-->
<!--            <option value="publish_date">Year Published</option>-->
<!--        </select>-->



        <label><b>Search</b></label>
        <input type="text" placeholder="Search for..." name="search" required>
        <button type="submit">Search</button>
    </form>

    <?php
    $conn = connect();
    $sql = "";

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $stype = '';
    $mtype = '';

    if (isset($_GET['media-type'])) {
        $mtype = $_GET['media-type'];
    }

    if (isset($_GET['search-type'])) {
        $stype = $_GET['search-type'];
    }

    if (isset($_GET['search'])) {
        $value = $_GET['search'];
    }

    $sql = "SELECT * FROM Media ORDER BY title;";

	if ($mtype == "all") {
        switch ($stype) {
            case "artist":
                $sql = "SELECT * FROM Author_Media_View WHERE first_name LIKE '%$value%'";
                break;
            case "author":
                $sql = "SELECT * FROM Author_Media_View WHERE last_name LIKE '%$value%'";
                break;
            case "title":
                $sql = "SELECT * FROM Media WHERE title LIKE '%$value%'";
                break;
        }
		// Call procedure or query for specific page

		$result = $conn->query($sql);

		// If result is not empty, display it
        if ($result->num_rows > 0) {
            // Output data from every row
            while($row = $result->fetch_assoc()) {
                $book = $row["id"];
                $copy = $row["copy_num"];

                echo "<hr><h2>".$row["title"]."</h2>";

                $sql_a = "SELECT * FROM Author_Media_View WHERE id=$book AND copy_num=$copy;";
                $result_a = $conn->query($sql_a);

                if ($result_a->num_rows > 0){
                    $row2 = $result_a->fetch_assoc();
                    echo $row2["first_name"]." ".$row2["last_name"]." ";
                }

                echo $row["published_date"]."<br>".$row["publisher"].".<br><br>
				<a href=\"details.php?id=$book&copy=$copy\">More Details</a><br><br>";

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
            }
        } else {
            echo "0 results";
        }
    } else if ($mtype == "cd") {
        switch ($stype) {
            case "artist":
                $sql = "SELECT * FROM Full_CD_View WHERE first_name LIKE '%$value%' OR last_name LIKE '%$value%'";
                break;
            case "audience":
                $sql = "SELECT * FROM Full_CD_View WHERE audience LIKE '%$value%'";
                break;
            case "genre":
                $sql = "SELECT * FROM Full_CD_View WHERE genre LIKE '%$value%'";
                break;
            case "language":
                $sql = "SELECT * FROM Full_CD_View WHERE language LIKE '%$value%'";
                break;
            case "producer":
                $sql = "SELECT * FROM Full_CD_View WHERE producer LIKE '%$value%'";
                break;
            case "publisher":
                $sql = "SELECT * FROM Full_CD_View WHERE publisher LIKE '%$value%'";
                break;
            case "title":
                $sql = "SELECT * FROM Full_CD_View WHERE title LIKE '%$value%'";
                break;
            case "publish_date":
                $sql = "SELECT * FROM Full_CD_View WHERE published_date LIKE $value";
                break;
        }
        //$sql = "SELECT * FROM Full_Book_View WHERE first_name LIKE '%$value%' OR last_name LIKE '%$value%' ORDER BY title";
        $result = $conn->query($sql);

        // If result is not empty, display it
        if ($result->num_rows > 0) {
            // Output data from every row
            while ($row = $result->fetch_assoc()) {
                $book = $row["id"];
                $copy = $row["copy_num"];

                echo "<hr><h2>" . $row["title"] . "</h2>"
                    . $row["first_name"] . " " . $row["last_name"] . " "
                    . $row["published_date"] . "<br>" . $row["publisher"] . ".<br><br>
				<a href=\"details.php?id=$book&copy=$copy\">More Details</a><br><br>";

                // If the book is available
                if ($row["is_available"] == "available") {
                    echo "<p><i class='fa fa-check-circle' aria-hidden='true' 
						style='color: #57BC57'></i> Copy #" . $row["copy_num"] . " is 
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
                } // Else, display status of the book
                else {
                    echo "<p><i class='fa fa-times-circle' aria-hidden='true'
						style='color: #D25252'></i> Copy #" . $row["copy_num"] . " is 
						<b>" . $row["is_available"] . "</b>.</p>";
                }
            }

        } else {
            echo "0 results";
        }
    }
    else if ($mtype == "cassette"){

        switch ($stype) {
            case "artist":
                $sql = "SELECT * FROM Full_Cassette_View WHERE first_name LIKE '%$value%' OR last_name LIKE '%$value%'";
                break;
            case "audience":
                $sql = "SELECT * FROM Full_Cassette_View WHERE audience LIKE '%$value%'";
                break;
            case "genre":
                $sql = "SELECT * FROM Full_Cassette_View WHERE genre LIKE '%$value%'";
                break;
            case "language":
                $sql = "SELECT * FROM Full_Cassette_View WHERE language LIKE '%$value%'";
                break;
            case "producer":
                $sql = "SELECT * FROM Full_Cassette_View WHERE producer LIKE '%$value%'";
                break;
            case "publisher":
                $sql = "SELECT * FROM Full_Cassette_View WHERE publisher LIKE '%$value%'";
                break;
            case "title":
                $sql = "SELECT * FROM Full_Cassette_View WHERE title LIKE '%$value%'";
                break;
            case "publish_date":
                $sql = "SELECT * FROM Full_Cassette_View WHERE published_date LIKE $value";
                break;
        }



        //$sql = "SELECT * FROM Full_Book_View WHERE first_name LIKE '%$value%' OR last_name LIKE '%$value%' ORDER BY title";
        $result = $conn->query($sql);

        // If result is not empty, display it
        if ($result->num_rows > 0) {
            // Output data from every row
            while ($row = $result->fetch_assoc()) {
                $book = $row["id"];
                $copy = $row["copy_num"];

                echo "<hr><h2>" . $row["title"] . "</h2>"
                    . $row["first_name"] . " " . $row["last_name"] . " "
                    . $row["published_date"] . "<br>" . $row["publisher"] . ".<br><br>
				<a href=\"details.php?id=$book&copy=$copy\">More Details</a><br><br>";

                // If the book is available
                if ($row["is_available"] == "available") {
                    echo "<p><i class='fa fa-check-circle' aria-hidden='true' 
						style='color: #57BC57'></i> Copy #" . $row["copy_num"] . " is 
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
                } // Else, display status of the book
                else {
                    echo "<p><i class='fa fa-times-circle' aria-hidden='true'
						style='color: #D25252'></i> Copy #" . $row["copy_num"] . " is 
						<b>" . $row["is_available"] . "</b>.</p>";
                }
            }

        } else {
            echo "0 results";
        }
    } else if ($mtype == "book") {
        switch ($stype) {
            case "audience":
                $sql = "SELECT * FROM Full_Book_View WHERE audience LIKE '%$value%'";
                break;
            case "author":
                $sql = "SELECT * FROM Full_Book_View WHERE last_name LIKE '%$value%'";
                break;
            case "genre":
                $sql = "SELECT * FROM Full_Book_View WHERE genre LIKE '%$value%'";
                break;
            case "isbn10":
                $sql = "SELECT * FROM Full_Book_View WHERE ISBN_10 LIKE '%$value%'";
                break;
            case "isbn13":
                $sql = "SELECT * FROM Full_Book_View WHERE ISBN_13 LIKE '%$value%'";
                break;
            case "language":
                $sql = "SELECT * FROM Full_Book_View WHERE language LIKE '%$value%'";
                break;
            case "producer":
                $sql = "SELECT * FROM Full_Book_View WHERE producer LIKE '%$value%'";
                break;
            case "publisher":
                $sql = "SELECT * FROM Full_Book_View WHERE publisher LIKE '%$value%'";
                break;
            case "title": //NOT ALWAYS WORKING... WHY?
                $sql = "SELECT * FROM Full_Book_View WHERE title LIKE '%$value%' OR title = '$value'";
                break;
            case "publish_date":
                $sql = "SELECT * FROM Full_Book_View WHERE published_date LIKE $value";
                break;
        }



        //$sql = "SELECT * FROM Full_Book_View WHERE first_name LIKE '%$value%' OR last_name LIKE '%$value%' ORDER BY title";
        $result = $conn->query($sql);

        // If result is not empty, display it
        if ($result->num_rows > 0) {
            // Output data from every row
            while ($row = $result->fetch_assoc()) {
                $book = $row["id"];
                $copy = $row["copy_num"];

                echo "<hr><h2>" . $row["title"] . "</h2>"
                    . $row["first_name"] . " " . $row["last_name"] . " "
                    . $row["published_date"] . "<br>" . $row["publisher"] . ".<br><br>
				<a href=\"details.php?id=$book&copy=$copy\">More Details</a><br><br>";

                // If the book is available
                if ($row["is_available"] == "available") {
                    echo "<p><i class='fa fa-check-circle' aria-hidden='true' 
						style='color: #57BC57'></i> Copy #" . $row["copy_num"] . " is 
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
                } // Else, display status of the book
                else {
                    echo "<p><i class='fa fa-times-circle' aria-hidden='true'
						style='color: #D25252'></i> Copy #" . $row["copy_num"] . " is 
						<b>" . $row["is_available"] . "</b>.</p>";
                }
            }
        } else {
            echo "0 results";
        }

    } else if($mtype == "dvd"){
        switch ($stype) {
            case "audience":
                $sql = "SELECT * FROM Full_DVD_View WHERE audience LIKE '%$value%'";
                break;
            case "director":
                $sql = "SELECT * FROM Full_DVD_View WHERE director LIKE '%$value%'";
                break;
            case "genre":
                $sql = "SELECT * FROM Full_DVD_View WHERE genre LIKE '%$value%'";
                break;
            case "language":
                $sql = "SELECT * FROM Full_DVD_View WHERE language LIKE '%$value%'";
                break;
            case "producer":
                $sql = "SELECT * FROM Full_DVD_View WHERE producer LIKE '%$value%'";
                break;
            case "publisher":
                $sql = "SELECT * FROM Full_DVD_View WHERE publisher LIKE '%$value%'";
                break;
            case "title":
                $sql = "SELECT * FROM Full_DVD_View WHERE title LIKE '%$value%'";
                break;
            case "publish_date":
                $sql = "SELECT * FROM Full_DVD_View WHERE published_date LIKE $value";
                break;
        }
        $result = $conn->query($sql);

        // If result is not empty, display it
        if ($result->num_rows > 0) {
            // Output data from every row
            while($row = $result->fetch_assoc()) {
                $book = $row["id"];
                $copy = $row["copy_num"];

                echo "<hr><h2>".$row["title"]."</h2>"
                    . $row["director"] . " "
                    .$row["published_date"]."<br>".$row["publisher"].".<br><br>
				<a href=\"details.php?id=$book&copy=$copy\">More Details</a><br><br>";

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
            }
        }
    } else if($mtype == "vhs") {
        switch ($stype) {
            case "audience":
                $sql = "SELECT * FROM Full_VHS_View WHERE audience LIKE '%$value%'";
                break;
            case "director":
                $sql = "SELECT * FROM Full_VHS_View WHERE director LIKE '%$value%'";
                break;
            case "genre":
                $sql = "SELECT * FROM Full_VHS_View WHERE genre LIKE '%$value%'";
                break;
            case "language":
                $sql = "SELECT * FROM Full_VHS_View WHERE language LIKE '%$value%'";
                break;
            case "producer":
                $sql = "SELECT * FROM Full_VHS_View WHERE producer LIKE '%$value%'";
                break;
            case "publisher":
                $sql = "SELECT * FROM Full_VHS_View WHERE publisher LIKE '%$value%'";
                break;
            case "title":
                $sql = "SELECT * FROM Full_VHS_View WHERE title LIKE '%$value%'";
                break;
            case "publish_date":
                $sql = "SELECT * FROM Full_VHS_View WHERE published_date LIKE $value";
                break;
        }
        $result = $conn->query($sql);

        // If result is not empty, display it
        if ($result->num_rows > 0) {
            // Output data from every row
            while ($row = $result->fetch_assoc()) {
                $book = $row["id"];
                $copy = $row["copy_num"];

                echo "<hr><h2>" . $row["title"] . "</h2>"
                    . $row["director"] . " "
                    . $row["published_date"] . "<br>" . $row["publisher"] . ".<br><br>
				<a href=\"details.php?id=$book&copy=$copy\">More Details</a><br><br>";

                // If the book is available
                if ($row["is_available"] == "available") {
                    echo "<p><i class='fa fa-check-circle' aria-hidden='true' 
						style='color: #57BC57'></i> Copy #" . $row["copy_num"] . " is 
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
                } // Else, display status of the book
                else {
                    echo "<p><i class='fa fa-times-circle' aria-hidden='true'
						style='color: #D25252'></i> Copy #" . $row["copy_num"] . " is 
						<b>" . $row["is_available"] . "</b>.</p>";
                }
            }
        }
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
