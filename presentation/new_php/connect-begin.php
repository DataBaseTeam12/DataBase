<?php
try
{
	// $servername = "162.253.224.12";
	// $username = "databa39_user";
	// $password = "databa39team12";
	// $dbname = "databa39_library";

	$pdo = new PDO("mysql:host=localhost;dbname=databa39_library", "databa39_user", "databa39team12");

	// function group to retrieve column names of a table
	function prep_attr($table) {
		global $pdo, $set;
		$set = $pdo->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '{$table}'");
    }
    function next_attr() {
        global $set, $row;
        return $row = $set->fetch(PDO::FETCH_ASSOC);
    }
    function show_attr() {
        global $row;
        echo $row['COLUMN_NAME'];
    }

	// function group to retrieve rows of a table
    function prep_rows($table, $columns) {
        global $pdo, $set;
        $set = $pdo->query('SELECT '.$columns.' FROM '.$table);
    }
    function next_rows() {
        global $set, $row;
        return $row = $set->fetch(PDO::FETCH_NUM);
    }

} catch (PDOException $e) {
    print "Error!: ".$e->getMessage()."<br/>";
    die();
}
?>
