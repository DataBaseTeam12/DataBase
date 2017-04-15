<?php include("DropMenu.php")

 ?>
 
 <?php  session_start();
  if($_SESSION['logged_in']==false):
     echo "<h1 align='center'>only faculty can acccess this page</h1>";
     
      exit();
      else: if(isset($_SESSION['userAccount']) && $_SESSION['userAccount'] != 'Faculty'):
          echo "<h1 align='center'>only faculty can acccess this page</h1>";
        
         exit();
     endif;
    
      endif;
  ?>
  
<!DOCTYPE html>

<html lang="en">
    


<head>
  <title>add media</title>
  
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="no-cache">
    <meta http-equiv="Expires" content="-1">
    <meta http-equiv="Cache-Control" content="no-cache">

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="checkForm.js"></script>
   <script src="addDB.js"></script>

<style>
header {
    background-color: #c8102e;
    clear: left;
	font-family: sans-serif;
       }
  .main {
    padding: 15px;
    color: white;
    text-align: center;
       }

.subhead {
    padding-top: 10px;
    padding-bottom: 10px;
    padding-right: 20px;
    color: white;
    background-color: #960C22;

    text-align: center;
}
 div.form-group  {padding:5px;}
 .highLight {
   background-color: #c8102e;
 }
.container{
       position:relative;
       float:left;
         width:30%;
         left:10%;
}
   
 @media screen and (max-width: 537px) {
    .container{
       clear:left;
        width:60%;
       left:25%;
    }
  

}
 
</style>

</head>
<body>
  
  <header>
 			   <div class="main">
 					<h1>University of Houston</h1>
 					<h3>Libraries</h3>
 			   </div>
 			   <div class="subhead">
 					<a href="http://www.databaseteam12.x10host.com/" ><button type="button" class="btn"  >HOME</button></a>

 			   </div>
 			</header>

      <div class="container">

        <h3> Add Book<h3>
        <form class="form-group" id ="bookForm">
          <?=MediaAttributes()?>
        </div><div class="form-group ">
          <label for="language">Language:</label>

                    <?=languageList()?>

        </div>
        <div class="form-group">
          <label for="genre ">genre:</label>
          <?=genreList()?>
        </div>
          <div class="form-group">
            <label for="edition">edition:</label>
            <input type="number" class="form-control num" id="edition" name="edition" placeholder="Enter edition" min="1">
          </div><div class="form-group">
            <label for="pages">number pages:</label>
            <input type="number" class="form-control num" id="pages" name="pages" placeholder="enter number of pages" min="1">
          </div>
          <div class="form-group">
            <label for="type">type:</label>
            <select class="form-control" id="type" name="type">
               <option>Hardcover</option>
               <option>Paperback</option>
               <option>Loose leaf</option>

             </select>
              
          </div>
         
          <div class="form-group">
            <label for="author F">Author FirstName:</label>
            <input type="text" class="form-control check" id="FirstName" name="firstname" placeholder="Enter author fisrt Name">
          </div>
          <div class="form-group">
            <label for="author F">Middle Initial:</label>
            <?=alphabetLetter();?>
          </div>
          <div class="form-group">
            <label for="author F">Author LastName:</label>
            <input type="text" class="form-control" id="LastName" name="lastname" placeholder="Enter author Last Name">
          </div>
          <div class="form-group">
           <label for="isbn10">ISBN10:</label>
           <input type="text" class="form-control isbn" id="isbn10" name="isbn10" placeholder="Enter isbn10" value="">
         </div>
         <div class="form-group">
           <label for="isbn13">ISBN13:</label>
           <input type="text" class="form-control isbn" id="isbn13" name="isbn13" placeholder="Enter isbn13" value="">
         </div>
          <div class="form-group">
           <label for="publisher">Publisher:</label>
           <input type="text" class="form-control " id="publisher" name="publisher" placeholder="Enter publisher" value="">
         </div>
          <button type="button" class="btn btn-success" id="addBookbtn">ADD</button>
        </form>
  </div>
 
   <div class="container">
            <h3>Add Digital Media</h3>

          <form class="form-group" id ="digitalForm">
             <div class="form-group">
               <label for="type">Digital type:</label>
                <select class="form-control check" id="digitalType" name="digitalType">
                  <option value=""> </option>
                 <option value="DVD">DVD</option>
                 <option value="CD">CD</option>
                 <option value="Cassette">Cassette</option>
                  <option value="VHS">VHS</option>

               </select>


            </div>
               <?=MediaAttributes()?>
             </div><div class="form-group">
               <label for="language">Language:</label>

                         <?=languageList()?>
             </div>
             <div class="form-group">
               <label for="genre">genre:</label>
               <?=genreList2()?>
             </div>
             <div class="form-group">
               <label for="producer">producer:</label>
               <input type="text" class="form-control check" id="producer" name="producer" placeholder="Enter the producer">
             </div>
             <div class="form-group">
               <label for="total runtime">total runtime in minutes:</label>
               <input type="number" class="form-control num" id="Runtime" name="runtime" placeholder=" for example: 60" min="1">
             </div>
             
             <div class="form-group">
               <label for="author F">Artist:</label>
               <input type="text" class="form-control check" id="FirstName" name="firstname" placeholder="Enter author fisrt Name">
             </div>
        
              <div class="form-group">
           <label for="UPC">UPC:</label>
           <input type="number" class="form-control UPC " id="UPC" name="UPC" placeholder="Enter UPC" value="">
         </div>
                 <button type="button" class="btn btn-success" id="addDigitalbtn">ADD</button>
             <script>
             $("#digitalType").change(function () {

                          $("#tracks").remove();

                          $("#director").remove();

                    var value =$("#digitalType :selected").attr('value');

                       if(value =="Cassette"||value =="CD"){

           $("#digitalForm").append('<div class="form-group" id="tracks"><label for="numtracks">number of tracks:</label><input type="number" min="1" class="form-control num" id="numtracks"  name="track" placeholder="Enter the number of tracks"></div> ');
           $('#addDigitalbtn').insertAfter('#tracks');
         }else{
                  $("#digitalForm").append('<div class="form-group" id="director"><label for="director">director:</label><input type="text" class="form-control  director" id="director" name="directors"  placeholder="Enter the director"></div>     ');
                  $('#addDigitalbtn').insertAfter('#director');
         }

                  });


             </script>

            </form>
            </div>
             
            <div class="container">
            <h3>ADD Laptop </h3>
          <form class="form-inline" id ="LaptopForm">
            <div class="form-group">
              <label for="laptop">serial number:</label>
              <input type="text" name ="serial" class="form-control check" id="laptop" placeholder="Enter the laptop'serial">
            </div>
            <button type="button" class="btn btn-success" id="addLaptopbtn">ADD</button>
          </form>
        </div>




</body>
<script>
 
$('#addBookbtn').click(function() {
     if(checkBook()){
       addBook();
       $('#bookForm').trigger('reset');
     }


});
$('#addDigitalbtn').click(function() {

    if( checkDigital()){

         addDigital();
           $('#digitalForm').trigger('reset');
    }

});
$('#addLaptopbtn').click(function() {
    if(checkLaptop()){
       addLaptop();
         $('#LaptopForm').trigger('reset');
    }

});

$('.check').on('click' ,(function(){

    $(this).removeClass("highLight");
}));
$('.num').on('click' ,(function(){

    $(this).removeClass("highLight");
}));
$('.isbn').on('click' ,(function(){

    $(this).removeClass("highLight");
}));
$('#UPC').on('click' ,(function(){

    $(this).removeClass("highLight");
}));
$('#copies').on('click' ,(function(){

    $(this).removeClass("highLight");
}));
$('#digitalForm .director').on('click' ,(function(){

    $(this).removeClass("highLight");
}));
</script>
</html>
