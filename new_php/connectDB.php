<?php
 function connect(){
   $db = new mysqli ('localhost','databa39_user','databa39team12','databa39_library') or die();
   return $db;
}
?>
