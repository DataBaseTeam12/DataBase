<?php
 function connect(){

   $db = new mysqli ('localhost','databa39_phuc','database123','databa39_library') or die();


   return $db;
}
?>
