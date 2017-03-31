<?php include('connectDB.php') ?>
<?php
function laptop($conn){
   $type="Laptop";
  $serial = mysqli_real_escape_string($conn,$_REQUEST["serial"]);

  $sql = "SELECT * FROM $type WHERE serial = '$serial'";
  $result = $conn->query($sql) or die("query failed");
  if ($result->num_rows > 0) {
         echo "serial is taken";

    }
 else {
      $val = 1;
      $sql ="SELECT MAX(id) FROM $type LIMIT 1";
      $result = $conn->query($sql) or die("query failed");
      if ($result->num_rows > 0) {
              $row = $result->fetch_assoc();
              $val= $row["MAX(id)"] ;
              ++$val;
        }
      $sql="INSERT INTO $type (id,serial) VALUES ($val,'$serial')";

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
        //var_dump($data);
        $title = mysqli_real_escape_string($conn,$data[0]["value"]);
        $publisher =   mysqli_real_escape_string($conn,$data[1]["value"]);
        $date =  mysqli_real_escape_string($conn,$data[2]["value"]);
        date_default_timezone_set('UTC');
        $date=  "01-01-".$date;
        $date = strtotime($date);
        $date = date('Y',$date);
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
      //  $sql ="SELECT MAX(id) FROM Media LIMIT 1"; AND published_date =$date
    //   $sql = "SELECT media.id FROM media,book,author WHERE title='$title' AND published_date = '$date' AND genre ='$genre' AND language ='$language'AND edition = '$edition' And last_name ='$lastName' And first_name ='$firstName' AND type ='$type'AND media.id=book.book_id AND media.id =author.media_id ";
   $sql = "SELECT Media.id FROM Media,Book,Author WHERE title='$title'AND genre ='$genre' AND  published_date ='$date' AND language ='$language'AND edition ='$edition' And last_name ='$lastName' And first_name ='$firstName' AND type ='$type'AND Media.id=Book.book_id AND Media.id =Author.media_id ";
        $result = $conn->query($sql) or die("query failed");
        if ($result->num_rows > 0) {
               echo "FAILED! THE BOOK IS ALREADY IN THE DB";

          }
          else{
            $val = 1;
            $sql ="SELECT MAX(id) FROM Media LIMIT 1";
            $result = $conn->query($sql) or die("query failed");
            if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $val= $row["MAX(id)"] ;
                    ++$val;
              }
          //  $sql="INSERT INTO media VALUES ($val,'$title','$genre','$publisher',' $copies','$date','$audience','$language')";
            $sql="INSERT INTO Media (id,title,genre,publisher,num_copies,published_date,audience,language)VALUES ($val,'$title','$genre','$publisher', '$copies', '$date','$audience','$language')";
           if ($conn->query($sql) === TRUE) {
                 $sql="INSERT INTO Book (book_id,edition,type,num_pages) VALUES($val, '$edition','$type','$pages')";
                 if ($conn->query($sql) === TRUE) {
                         $val2 = 1;
                         $sql ="SELECT MAX(author_id) FROM Author LIMIT 1";
                         $result = $conn->query($sql) or die("query failed");
                         if ($result->num_rows > 0) {
                           $row = $result->fetch_assoc();
                           $val2 = $row["MAX(author_id)"] ;
                           ++$val2;
                          }
                          $sql="INSERT INTO Author (author_id,first_name,middle_initial,last_name,media_id)  VALUES ($val2,'$firstName','$initial','$lastName',$val)";
                            if ($conn->query($sql) === TRUE) {echo "book added successfully";}else{ echo "Error: " . $sql . "<br>". $conn->error;}
                 }else
                 { echo "Error: " . $sql . "<br>". $conn->error;}
           }
           else {
               echo "Error: " . $sql . "<br>". $conn->error;
           }

          }
          $conn->close();
          exit();
}
 ?>
 <?php
  function  addDigitalDVD_VHS($conn,$type){
         $id;
         if($type=="DVD"||$type=="dvd"){$id="dvd_id";$type="DVD";}else{ $id ="vhs_id";$type="VHS";}

          $data = json_decode(stripslashes($_REQUEST['data']),true);
          $title = mysqli_real_escape_string($conn,$data[1]["value"]);
          $publisher =   mysqli_real_escape_string($conn,$data[2]["value"]);
          $date =  mysqli_real_escape_string($conn,$data[3]["value"]);
          date_default_timezone_set('UTC');
          $date=  "01-01-".$date;
          $date = strtotime($date);
          $date = date('Y',$date);
          $copies =  mysqli_real_escape_string($conn,$data[4]["value"]);
          $audience =  mysqli_real_escape_string($conn,$data[5]["value"]);
          $language =  mysqli_real_escape_string($conn,$data[6]["value"]);
          $genre =  mysqli_real_escape_string($conn,$data[7]["value"]);
          $producer =  mysqli_real_escape_string($conn,$data[8]["value"]);
          $runtime =  mysqli_real_escape_string($conn,$data[9]["value"]);
          $firstName =  mysqli_real_escape_string($conn,$data[10]["value"]);
          $initial = mysqli_real_escape_string($conn,$data[11]["value"]);
          $lastName = mysqli_real_escape_string($conn,$data[12]["value"]);
          $director=mysqli_real_escape_string($conn,$data[13]["value"]);

           $sql = "SELECT Media.id FROM Media,$type,Author WHERE title='$title'AND genre ='$genre' AND  producer='$producer' AND director='$director' AND published_date ='$date' AND language ='$language'AND last_name ='$lastName' And first_name ='$firstName' AND  Media.id= $type.$id AND Media.id =Author.media_id ";
           $result = $conn->query($sql) or die("query failed");
           if ($result->num_rows > 0) {
                  echo "FAILED THE MEDIA IS ALREADY IN THE DB";

             }
             else{
               $val = 1;
               $sql ="SELECT MAX(id) FROM Media LIMIT 1";
               $result = $conn->query($sql) or die("query failed");
               if ($result->num_rows > 0) {
                       $row = $result->fetch_assoc();
                       $val= $row["MAX(id)"] ;
                       ++$val;
                 }
                $sql="INSERT INTO Media (id,title,genre,publisher,num_copies,published_date,audience,language) VALUES ($val,'$title','$genre','$publisher', '$copies', '$date','$audience','$language')";
                 if ($conn->query($sql) === TRUE) {
                       $sql="INSERT INTO $type (director,producer,total_runtime,$id)VALUES('$director', '$producer','$runtime',$val)";
                         if($conn->query($sql) === TRUE) {
                           $val2 = 1;
                           $sql ="SELECT MAX(author_id) FROM Author LIMIT 1";
                           $result = $conn->query($sql) or die("query failed");
                           if ($result->num_rows > 0) {
                             $row = $result->fetch_assoc();
                             $val2 = $row["MAX(author_id)"] ;
                             ++$val2;
                            }
                            $sql="INSERT INTO Author (author_id,first_name,middle_initial,last_name,media_id)  VALUES ($val2,'$firstName','$initial','$lastName',$val)";
                              if ($conn->query($sql) === TRUE) {echo $type." added successfully";}else{ echo "Error: " . $sql . "<br>". $conn->error;}
                         }else{
                               echo "Error: " . $sql . "<br>". $conn->error;
                         }
                 }else{
                    echo "Error: " . $sql . "<br>". $conn->error;
                 }
             }
    }

 ?>
 <?php
  function   addDigitalCD_CASSETTE($conn,$type){
    $id;
    if($type=="cd"||$type=="CD"){$id="cd_id";$type="CD";}else{ $id ="cassette_id";$type="Cassette";}

     $data = json_decode(stripslashes($_REQUEST['data']),true);
     $title = mysqli_real_escape_string($conn,$data[1]["value"]);
     $publisher =   mysqli_real_escape_string($conn,$data[2]["value"]);
     $date =  mysqli_real_escape_string($conn,$data[3]["value"]);
      date_default_timezone_set('UTC');
     $date=  "01-01-".$date;
     $date = strtotime($date);
     $date = date('Y',$date);
     $copies =  mysqli_real_escape_string($conn,$data[4]["value"]);
     $audience =  mysqli_real_escape_string($conn,$data[5]["value"]);
     $language =  mysqli_real_escape_string($conn,$data[6]["value"]);
     $genre =  mysqli_real_escape_string($conn,$data[7]["value"]);
     $producer =  mysqli_real_escape_string($conn,$data[8]["value"]);
     $runtime =  mysqli_real_escape_string($conn,$data[9]["value"]);
     $firstName =  mysqli_real_escape_string($conn,$data[10]["value"]);
     $initial = mysqli_real_escape_string($conn,$data[11]["value"]);
     $lastName = mysqli_real_escape_string($conn,$data[12]["value"]);
     $tracks=mysqli_real_escape_string($conn,$data[13]["value"]);

      $sql = "SELECT Media.id FROM Media,$type,Author WHERE title='$title'AND genre ='$genre' AND producer='$producer' AND published_date ='$date' AND language ='$language'AND last_name ='$lastName' And first_name ='$firstName' AND  Media.id= $type.$id AND Media.id =Author.Media_id ";
      $result = $conn->query($sql) or die("query failed");
      if ($result->num_rows > 0) {
             echo "FAILED THE MEDIA IS ALREADY IN THE DB";

        }
        else{
          $val = 1;
          $sql ="SELECT MAX(id) FROM Media LIMIT 1";
          $result = $conn->query($sql) or die("query failed");
          if ($result->num_rows > 0) {
                  $row = $result->fetch_assoc();
                  $val= $row["MAX(id)"] ;
                  ++$val;
            }
           $sql="INSERT INTO Media (id,title,genre,publisher,num_copies,published_date,audience,language) VALUES ($val,'$title','$genre','$publisher', '$copies', '$date','$audience','$language')";
            if ($conn->query($sql) === TRUE) {
                  $sql="INSERT INTO $type (producer,total_runtime,$id,num_tracks)VALUES( '$producer','$runtime',$val,'$tracks')";
                    if($conn->query($sql) === TRUE) {
                      $val2 = 1;
                      $sql ="SELECT MAX(author_id) FROM Author LIMIT 1";
                      $result = $conn->query($sql) or die("query failed");
                      if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $val2 = $row["MAX(author_id)"] ;
                        ++$val2;
                       }
                       $sql="INSERT INTO Author (author_id,first_name,middle_initial,last_name,media_id)  VALUES ($val2,'$firstName','$initial','$lastName',$val)";
                         if ($conn->query($sql) === TRUE) {echo $type." added successfully";}else{ echo "Error: " . $sql . "<br>". $conn->error;}
                    }else{
                          echo "Error: " . $sql . "<br>". $conn->error;
                    }
            }else{
               echo "Error: " . $sql . "<br>". $conn->error;
            }
        }
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
    }else if($type =="dvd"||$type=="vhs"||$type =="DVD"||$type=="VHS"){
      addDigitalDVD_VHS($conn,$type);
    }else{
        addDigitalCD_CASSETTE($conn,$type);
    }
   exit();

 ?>
