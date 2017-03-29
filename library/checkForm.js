function checkBook(){
    var regex= /^[\sa-zA-Z0-9_-]*$/;
       var check = true;
       var check2 = true;
       
     $('#bookForm .check ').each(function(){
           $(this).removeClass("highLight");
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
if(!check){
         alert("fill in the highlighted fields");
     }
     if(!check2){
         alert("only numbers,letters,underscore,and - allowed");
     }
        return (check&&check2);
}



function checkDigital(){
     var regex= /^[\sa-zA-Z0-9_-]*$/;
      var check = true;
      var check2 = true;
      
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
     
  if(!check){
         alert("fill in the highlighted fields");
     }
     if(!check2){
         alert("only numbers,letters,underscore,and - allowed");
     }
        return (check&&check2);
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
