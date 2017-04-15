function checkBook(){
    var regex= /^[\sa-zA-Z0-9_-]*$/;
       var check = true;
       var check2 = true;
       var check3 = true;
       var check4 = true;
     $('#bookForm .check ').each(function(){
           
           if(!$(this).val() ){
                
              check = false;
             $(this).addClass("highLight");
           }else{
               
                if(!regex.test($(this).val() )){
                     check2 = false;
                      $(this).addClass("highLight");
                      
                      
                }
               
           }

          });
          $('#bookForm .num ').each(function(){
         
           if($(this).val() ){
                 if($(this).val()<0){
                      
                      check4 = false;
                 $(this).addClass("highLight");
                 }
               
               
           }

          });
        if($('#bookForm .year').val()){
           
             var val = $('#bookForm .year').val();
            
            if(val<1902||val>2018){
                    check3 = false;
                    
             $('#bookForm .year').addClass("highLight");
            }
        }
          var check5 =checkISBN();
          var check6 = true;
           if($('#bookForm #copies').val()<1){
               alert("copies must be greater than zero");
               $('#bookForm #copies').addClass("highLight");
               check6 = false;
           }
          
if(!check){
         alert("fill in the highlighted fields");
     }
     if(!check2){
         alert("only numbers,letters,underscore,and - allowed");
     }
      if(!check3){
         alert("Publication Year's range is 1902 - 2017");
     }
        if(!check4){
         alert("no negative numbers");
     }
        return (check&&check2&&check3&&check4&&check5&&check6);
}



function checkDigital(){
     var regex= /^[\sa-zA-Z0-9_-]*$/;
      var check = true;
      var check2 = true;
       var check3 = true;
         var check4 = true;
     $('#digitalForm .check ').each(function(){
           if(!$(this).val() ){
                
               check = false;
               $(this).addClass("highLight");}
               else{
               
                if(!regex.test($(this).val() )){
                     check2 = false;
                      $(this).addClass("highLight");
                      
                      
                }
               
           }
 
           });
            $('#digitalForm .num ').each(function(){
         
           if($(this).val() ){
                 if($(this).val()<0){
                      
                      check4 = false;
                 $(this).addClass("highLight");
                 }
               
               
           }

          });
          if($('#digitalForm .year').val()){
              var val =$('#digitalForm .year').val();
           
            if(val<1902||val>2018){
                    check3 = false;
             $('#digitalForm .year').addClass("highLight");
            }
        }
       var check5 = upcCheck();
         var check6 = true;
           if($('#digitalForm #copies').val()<1){
               alert("copies must be greater than zero");
               $('#digitalForm #copies').addClass("highLight");
               check6 = false;
           }
  if(!check){
         alert("fill in the highlighted fields");
     }
     if(!check2){
         alert("only numbers,letters,underscore,and - allowed");
     }
       if(!check3){
         alert("Publication Year's range is 1902 - 2017");
     }
       if(!check4){
         alert("no negative numbers");
     }
        return (check&&check2&&check3&&check4&&check5&&check6);
}
function upcCheck (){
    var regex =  /^[0-9]{12}]*$/;
         if(!regex.test($('#digitalForm .UPC').val())&& $('#digitalForm .UPC').val()){
             alert("UPC has to be 12 digits long");
                 $('#digitalForm .UPC').addClass("highLight");
                 return false;
         }
    return true;
    
}
function checkLaptop(){
    var regex= /^[a-zA-Z0-9]*$/;
     var check = true;
     var error="";
     $('#LaptopForm .check ').each(function(){
           if(!$(this).val() ){
              check = false;
             $(this).addClass("highLight");
             error=error+"fill in the highlighted fields";
           } else{
               
                if(!regex.test($(this).val() )){
                     check = false;
                      $(this).addClass("highLight");
                      error=error+"numbers and letters only no space";
                      
                }
               
           }
 
      


     });
     if(!check){
         alert(error);
     }
 return check;
}
function checkISBN(){
     
     
      var check =true;
        
       var regex10 =/^[0-9X?0-9x?0-9]{10}$/;
              var regex13 =/^[0-9X?0-9x?0-9]{13}$/;
             
            if($('#bookForm #isbn10').val()&&!regex10.test($('#bookForm #isbn10').val())){
                  $('#bookForm #isbn10').addClass("highLight");
                  alert("isbn10 has to be 10 digits long  ");
                  check = false;
            }
             if($('#bookForm #isbn13').val()&&!regex13.test($('#bookForm #isbn13').val())){
                  $('#bookForm #isbn13').addClass("highLight");
                   alert("isbn13 has to be 13 digits long  ");
                  check = false;
            }
            return check;
      
    
}
 
