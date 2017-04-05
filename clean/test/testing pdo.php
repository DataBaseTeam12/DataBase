<?php
try
{
    $pdo = new PDO("mysql:host=localhost;dbname=databa39_library", "root", "");
    
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
    
    function prep_rows($table) {
        global $pdo, $set;
        $set = $pdo->query("SELECT * FROM {$table}");
    }
    function next_rows() {
        global $set, $row;
        return $row = $set->fetch(PDO::FETCH_ASSOC);
    }
    function show_rows() {
        global $row;
        echo "<td>".$row['author_id']."</td>";
        echo "<td>".$row['first_name']."</td>";
        echo "<td>".$row['middle_initial']."</td>";
        echo "<td>".$row['last_name']."</td>";
        echo "<td>".$row['media_id']."</td>";
    }
    
    include("/test.html");
    $pdo = null;
}
catch (PDOException $e)
{
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>