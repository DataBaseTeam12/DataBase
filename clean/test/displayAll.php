<?php
try
{
    session_start();
    
    // // Temporary test connection; will be removed and use connection in another file
    // $servername = "162.253.224.12";
    // $username = "databa39_user";
    // $password = "databa39team12";
    // $dbname = "databa39_library";
    
    $pdo = new PDO("mysql:host=162.253.224.12;dbname=databa39_library", "databa39_user", "databa39team12");
    
    function prep_rows($table) {
        global $pdo, $set;
        $set = $pdo->query("SELECT * FROM {$table} ORDER BY title;");
        return $pdo->query("SELECT COUNT(*) FROM {$table};")->fetchColumn() > 0;
    }
    function next_rows() {
        global $set, $row;
        return $row = $set->fetch(PDO::FETCH_ASSOC);
    }
    
    function show_rows(){
        global $row;
        if(prep_rows("Author_Media_View")==false)
        {
            echo " 0 results.";
        }
        else
        {
            while(next_rows()==true)
            {
                $title = $row["title"];
                $first_name = $row["first_name"];
                $last_name = $row["last_name"];
                $published_date = $row["published_date"];
                $publisher = $row["publisher"];
                $id = $row["id"];
                $copy_num = $row["copy_num"];
                $is_available = $row["is_available"];
                $s = "";
                
                $s = $s."<hr>";
                $s = $s."<h2>$title</h2>";
                $s = $s."$first_name $last_name $published_date";
                $s = $s."<br>";
                $s = $s."$publisher";
                $s = $s."<br><br>";
                $s = $s."<a href='/details.id=<$id&copy$copy_num/'>More Details</a>";
                $s = $s."<br><br>";
                $s = $s."<p>";
                if($is_available == "available")
                {
                    $s = $s."    <i class='fa fa-check-circle' aria-hidden='true' style='color: #57BC57'></i>";
                    $s = $s."    Copy #$copy_num is <b>$is_available</b>";
                }else{
                    $s = $s."    <i class='fa fa-check-circle' aria-hidden='true' style='color: #D25252'></i>";
                    $s = $s."    Copy #$copy_num is <b>$is_available</b>";
                    if(session_status() == PHP_SESSION_ACTIVE)
                    {
                        $s = $s."    <a href=''>Hold</a><a href='' style='margin-left:5px;'>Reserve</a>";
                        $s = $s."    <br><br>";
                    }
                }
                $s = $s."</p>";
                echo $s;
            }
        }
    }
    
    include("displayAll.html");
    $pdo = null;
}
catch (PDOException $e)
{
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>