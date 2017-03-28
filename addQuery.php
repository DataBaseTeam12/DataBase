<?php include('connectDB.php') ?>
<?php
function laptop($conn){
  $serial = mysqli_real_escape_string($conn,$_REQUEST["serial"]);

  $sql = "SELECT * FROM laptop WHERE serial = '$serial'";
  $result = $conn->query($sql) or die("query failed");
  if ($result->num_rows > 0) {
         echo "serial is taken";

    }
 else {
      $val = 1;
      $sql ="SELECT MAX(id) FROM laptop LIMIT 1";
      $result = $conn->query($sql) or die("query failed");
      if ($result->num_rows > 0) {
              $row = $result->fetch_assoc();
              $val= $row["MAX(id)"] ;
              ++$val;
        }
      $sql="INSERT INTO laptop VALUES ($val,'$serial')";

     if ($conn->query($sql) === TRUE) {
            echo "added laptop successfully";
     }
     else {
         echo "Error: " . $sql . "<br>". $conn->error;
     }
}
$conn->close();
}
?>
<?php
function addBook($conn){

        $data = json_decode(stripslashes($_REQUEST['data']),true);
        $title = mysqli_real_escape_string($conn,$data[0]["value"]);
        $publisher =   mysqli_real_escape_string($conn,$data[1]["value"]);
        $date =  mysqli_real_escape_string($conn,$data[2]["value"]);
        $copies =  mysqli_real_escape_string($conn,$data[3]["value"]);
        $audience =  mysqli_real_escape_string($conn,$data[4]["value"]);
        $language =  mysqli_real_escape_string($conn,$data[5]["value"]);
        $genre =  mysqli_real_escape_string($conn,$data[6]["value"]);
        $edition =  mysqli_real_escape_string($conn,$data[7]["value"]);
        $pages =  mysqli_real_escape_string($conn,$data[8]["value"]);
        $type =   mysqli_real_escape_string($conn,$data[9]["value"]);
        $firstName =  mysqli_real_escape_string($conn,$data[10]["value"]);
        $initial =  mysqli_real_escape_string($conn,$data[11]["value"]);
        $lastName = mysqli_real_escape_string($conn,$data[12]["value"]);
      //  $sql ="SELECT MAX(id) FROM Media LIMIT 1";
    $sql = "SELECT media.id FROM media,book,author WHERE title='$title' AND published_date ='$date' AND genre ='$genre' AND language ='$language' AND edition = $edition And last_name ='$lastName' And first_name ='$firstName' AND type ='$type'AND media.id=book.book_id AND media.id =author.media_id ";
        $result = $conn->query($sql) or die("query failed");
        if ($result->num_rows > 0) {
               echo "same book is already added";

          }
          else{
            $val = 1;
            $sql ="SELECT MAX(id) FROM media LIMIT 1";
            $result = $conn->query($sql) or die("query failed");
            if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $val= $row["MAX(id)"] ;
                    ++$val;
              }
            $sql="INSERT INTO media VALUES ($val,'$title','$genre','$publisher','$copies','$date','$audience','$language')";

           if ($conn->query($sql) === TRUE) {
                 $sql="INSERT INTO book VALUES($val,$edition,'$type',$pages)";
                 if ($conn->query($sql) === TRUE) {
                         $val2 = 1;
                         $sql ="SELECT MAX(author_id) FROM Author LIMIT 1";
                         $result = $conn->query($sql) or die("query failed");
                         if ($result->num_rows > 0) {
                           $row = $result->fetch_assoc();
                           $val2 = $row["MAX(author_id)"] ;
                           ++$val2;
                          }
                          $sql="INSERT INTO author VALUES ($val2,'$firstName','$initial','$lastName',$val)";
                            if ($conn->query($sql) === TRUE) {echo "book added successfully";}else{ echo "Error: " . $sql . "<br>". $conn->error;}
                 }else
                 { echo "Error: " . $sql . "<br>". $conn->error;}
           }
           else {
               echo "Error: " . $sql . "<br>". $conn->error;
           }

          }
          $conn->close();
}
 ?>
<?php


//Step1
 $conn = connect();
 if($conn->connect_error){
   echo "cant connect";

   exit();
 }
    $type = mysqli_real_escape_string($conn,$_REQUEST["t"]);

    if($type == "laptop") {laptop($conn);
    }else if($type == "book"){
       addBook($conn);
    }
   exit();

 ?>
