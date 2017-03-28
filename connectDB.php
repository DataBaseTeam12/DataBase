<?php
 function connect(){

   $db = new mysqli ('localhost','phuc','123','library') or die();


   return $db;
}
?>
