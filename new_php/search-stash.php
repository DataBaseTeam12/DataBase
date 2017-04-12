<!-- connect to database -->
<?php
$servername = "162.253.224.12";
$username = "databa39_user";
$password = "databa39team12";
$dbname = "databa39_library";
$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "";
// Check connection
if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}
?>

<!-- GET variables -->
<?php
$mtype = '';
$stype = '';

if (isset($_GET['media-type']))
{
    $mtype = $_GET['media-type'];
}
if (isset($_GET['search-type']))
{
    $stype = $_GET['search-type'];
}
if (isset($_GET['search']))
{
    $value = $_GET['search'];
}
?>


<?php
if ($mtype == "all")
{
    switch ($stype)
    {
        case "author":
        $sql = "SELECT * FROM Author_Media_View
        WHERE first_name LIKE '%$value%' OR last_name LIKE '%$value%'";
        break;
    }
    //$sql = "SELECT * FROM Full_Book_View WHERE first_name LIKE '%$value%' OR last_name LIKE '%$value%' ORDER BY title";
    $result = $conn->query($sql);

    // If result is not empty, display it
    if ($result->num_rows > 0)
    {
        // Output data from every row
        while ($row = $result->fetch_assoc())
        {
            $book = $row["id"];
            $copy = $row["copy_num"];

            echo "<hr><h2>" . $row["title"] . "</h2>"
            . $row["first_name"] . " " . $row["last_name"] . " "
            . $row["published_date"] . "<br>" . $row["publisher"] . ".<br><br>
            <a href=\"details.php?id =$book&copy =$copy\">More Details</a><br><br>";

            // If the book is available
            if ($row["is_available"] == "available")
            {
                echo "<p>
                <i class='fa fa-check-circle' aria-hidden='true'
                style='color: #57BC57'></i> Copy #" . $row["copy_num"] . " is
                <b>available</b>. ";

                // If logged in, provide options to reserve or hold
                if (session_status() == PHP_SESSION_ACTIVE)
                {
                    echo "<a href=\"\">Hold</a>
                    <a href=\"\" style=\"margin-left:5px;\">Reserve</a>
                    </p>";
                }
            } // Else, display status of the book
            else
            {
                echo "<p>
                    <i class='fa fa-times-circle' aria-hidden='true'
                       style='color: #D25252'></i> Copy #" . $row["copy_num"] . " is
                    <b>" . $row["is_available"] . "</b>.
                </p>";
            }
        }
    }
    else
    {
        echo "0 results";
    }
}
if ($mtype == "cd")
{
    switch ($stype)
    {
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
    if ($result->num_rows > 0)
    {
        // Output data from every row
        while ($row = $result->fetch_assoc())
        {
            $book = $row["id"];
            $copy = $row["copy_num"];

            echo "<hr><h2>" . $row["title"] . "</h2>"
            . $row["first_name"] . " " . $row["last_name"] . " "
            . $row["published_date"] . "<br>" . $row["publisher"] . ".<br><br>
            <a href=\"details.php?id =$book&copy =$copy\">More Details</a><br><br>";

            // If the book is available
            if ($row["is_available"] == "available")
            {
                echo "<p>
                <i class='fa fa-check-circle' aria-hidden='true'
                   style='color: #57BC57'></i> Copy #" . $row["copy_num"] . " is
                <b>available</b>. ";

                // If logged in, provide options to reserve or hold
                if (session_status() == PHP_SESSION_ACTIVE)
                {
                    echo
                       "<a href=\"\">Hold</a>
                        <a href=\"\" style=\"margin-left:5px;\">Reserve</a>
                        </p>";
                }
            } // Else, display status of the book
            else
            {
                echo "<p>
                    <i class='fa fa-times-circle' aria-hidden='true'
                       style='color: #D25252'></i> Copy #" . $row["copy_num"] . " is
                    <b>" . $row["is_available"] . "</b>.
                </p>";
            }
        }
    }
    else
    {
        echo "0 results";
    }
}
else if ($mtype == "cassette")
{
    switch ($stype)
    {
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
    if ($result->num_rows > 0)
    {
        // Output data from every row
        while ($row = $result->fetch_assoc())
        {
            $book = $row["id"];
            $copy = $row["copy_num"];

            echo "<hr><h2>" . $row["title"] . "</h2>"
            . $row["first_name"] . " " . $row["last_name"] . " "
            . $row["published_date"] . "<br>" . $row["publisher"] . ".<br><br>
            <a href=\"details.php?id =$book&copy =$copy\">More Details</a><br><br>";

            // If the book is available
            if ($row["is_available"] == "available")
            {
                echo "<p>
                <i class='fa fa-check-circle' aria-hidden='true'
                style='color: #57BC57'></i> Copy #" . $row["copy_num"] . " is
                <b>available</b>. ";

                // If logged in, provide options to reserve or hold
                if (session_status() == PHP_SESSION_ACTIVE)
                {
                    echo "<a href=\"\">Hold</a>
                    <a href=\"\" style=\"margin-left:5px;\">Reserve</a>
                    </p>";
                }
            } // Else, display status of the book
            else
            {
                echo "<p>
                <i class='fa fa-times-circle' aria-hidden='true'
                style='color: #D25252'></i> Copy #" . $row["copy_num"] . " is
                <b>" . $row["is_available"] . "</b>.
                </p>";
            }
        }
    }
    else
    {
        echo "0 results";
    }
}
else if ($mtype == "book")
{
    switch ($stype)
    {
        case "audience":
        $sql = "SELECT * FROM Full_Book_View WHERE audience LIKE '%$value%'";
        break;
        case "author":
        $sql = "SELECT * FROM Full_Book_View WHERE first_name LIKE '%$value%' OR last_name LIKE '%$value%'";
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
    if ($result->num_rows > 0)
    {
        // Output data from every row
        while ($row = $result->fetch_assoc())
        {
            $book = $row["id"];
            $copy = $row["copy_num"];

            echo "<hr><h2>" . $row["title"] . "</h2>"
            . $row["first_name"] . " " . $row["last_name"] . " "
            . $row["published_date"] . "<br>" . $row["publisher"] . ".<br><br>
            <a href=\"details.php?id =$book&copy =$copy\">More Details</a><br><br>";

            // If the book is available
            if ($row["is_available"] == "available")
            {
                echo "<p>
                <i class='fa fa-check-circle' aria-hidden='true'
                style='color: #57BC57'></i> Copy #" . $row["copy_num"] . " is
                <b>available</b>. ";

                // If logged in, provide options to reserve or hold
                if (session_status() == PHP_SESSION_ACTIVE)
                {
                    echo "<a href=\"\">Hold</a>
                    <a href=\"\" style=\"margin-left:5px;\">Reserve</a>
                    </p>";
                }
            } // Else, display status of the book
            else
            {
                echo "<p>
                <i class='fa fa-times-circle' aria-hidden='true'
                style='color: #D25252'></i> Copy #" . $row["copy_num"] . " is
                <b>" . $row["is_available"] . "</b>.
                </p>";
            }
        }
    }
    else
    {
        echo "0 results";
    }
}
else if($mtype == "dvd")
{
    switch ($stype)
    {
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
    if ($result->num_rows > 0)
    {
        // Output data from every row
        while($row = $result->fetch_assoc())
        {
            $book = $row["id"];
            $copy = $row["copy_num"];

            echo "<hr><h2>".$row["title"]."</h2>"
            . $row["director"] . " "
            .$row["published_date"]."<br>".$row["publisher"].".<br><br>
            <a href=\"details.php?id =$book&copy =$copy\">More Details</a><br><br>";

            // If the book is available
            if ($row["is_available"] == "available")
            {
                echo "<p>
                <i class='fa fa-check-circle' aria-hidden='true'
                style='color: #57BC57'></i> Copy #".$row["copy_num"]." is
                <b>available</b>. ";

                // If logged in, provide options to reserve or hold
                if (session_status() == PHP_SESSION_ACTIVE)
                {
                    echo "<a href=\"\">Hold</a>
                    <a href=\"\" style=\"margin-left:5px;\">Reserve</a>
                    </p>";
                }
            }
            // Else, display status of the book
            else
            {
                echo "<p>
                <i class='fa fa-times-circle' aria-hidden='true'
                style='color: #D25252'></i> Copy #".$row["copy_num"]." is
                <b>".$row["is_available"]."</b>.
                </p>";
            }
        }
    }
}
else if($mtype == "vhs")
{
    switch ($stype)
    {
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
    if ($result->num_rows > 0)
    {
        // Output data from every row
        while ($row = $result->fetch_assoc())
        {
            $book = $row["id"];
            $copy = $row["copy_num"];

            echo "<hr><h2>" . $row["title"] . "</h2>"
            . $row["director"] . " "
            . $row["published_date"] . "<br>" . $row["publisher"] . ".<br><br>
            <a href=\"details.php?id =$book&copy =$copy\">More Details</a><br><br>";

            // If the book is available
            if ($row["is_available"] == "available")
            {
                echo "<p>
                <i class='fa fa-check-circle' aria-hidden='true'
                style='color: #57BC57'></i> Copy #" . $row["copy_num"] . " is
                <b>available</b>. ";

                // If logged in, provide options to reserve or hold
                if (session_status() == PHP_SESSION_ACTIVE)
                {
                    echo "<a href=\"\">Hold</a>
                    <a href=\"\" style=\"margin-left:5px;\">Reserve</a>
                    </p>";
                }
            } // Else, display status of the book
            else
            {
                echo "<p>
                <i class='fa fa-times-circle' aria-hidden='true'
                style='color: #D25252'></i> Copy #" . $row["copy_num"] . " is
                <b>" . $row["is_available"] . "</b>.
                </p>";
            }
        }
    }
}
$conn->close();
?>
