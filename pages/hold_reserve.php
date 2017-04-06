<?php include('addMedia/connectDB.php') ?>
<?php 
 $conn = connect();
 if($conn->connect_error){
   echo "cant connect";

   exit();
 }
 $type = mysqli_real_escape_string($conn,$_REQUEST["t"]);
      $data = json_decode(stripslashes($_REQUEST['data']),true); 
   $member_id =  (int)mysqli_real_escape_string($conn,$data[0]["value"]);
   $media_id =  (int)mysqli_real_escape_string($conn,$data[1]["value"]);
   $copy =  (int)mysqli_real_escape_string($conn,$data[2]["value"]);
 if($type =="hold"){
   //var_dump($data);
 $sqlh = "CALL place_hold($member_id,$media_id,$copy);";
 $resulth = $conn->query($sqlh)  ;
 if(!$resulth)  echo "Error: " . $sqlh . "<br>". $conn->error;
 else echo "successfully hold";
     
 }
 else if($type=="reserve"){
   
  //var_dump($data);
 $sqlh = "CALL place_reserve($member_id,$media_id,$copy);";
 $resulth = $conn->query($sqlh)  ;
 if(!$resulth)  echo "Error: " . $sqlh . "<br>". $conn->error;
 else echo "successfully reserve";
    
 }else{
        echo"something went wrong ";
    
 }
?>
