<?php
 function connect(){

   $db = new mysqli ('162.253.224.12','databa39_user','databa39team12','databa39_library') or die();


   return $db;
}
?>
