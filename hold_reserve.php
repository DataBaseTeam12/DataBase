<?php include('old/addMedia/connectDB.php') ?>
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
    $sql = "SELECT * FROM Media_Holds WHERE member_id=$member_id AND end_date >= CURDATE()";
     $result = $conn->query($sql) or die("query failed 0" );
     if ($result->num_rows > 4) {
               echo "FAILED! limit 5 holds";
                  exit();
          }
          else{
             // echo"processing";
               $sqlh = "CALL place_hold($member_id,$media_id,$copy);";
 $resulth = $conn->query($sqlh)  ;
 if(!$resulth)  echo "Error: " . $sqlh . "<br>". $conn->error;
 else echo "successfully held";
          }

     
 }
 else if($type=="reserve"){
   
  //var_dump($data);
      $sql = "SELECT * FROM Media_Reserves WHERE member_id=$member_id AND end_time >= NOW()";
     $result = $conn->query($sql) or die("query failed 0" );
     if ($result->num_rows > 4) {
               echo "FAILED! limit 5 reserves";
                  exit();
          }
          else{
                  // echo"processing";
              $sqlh = "CALL place_reserve($member_id,$media_id,$copy);";
 $resulth = $conn->query($sqlh)  ;
 if(!$resulth)  echo "Error: " . $sqlh . "<br>". $conn->error;
 else echo "successfully reserved";
              
          }

    
 }else{
        echo"something went wrong ";
    
 }
?>