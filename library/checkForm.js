function checkBook(){
    var regex= /^[\sa-zA-Z0-9_-]*$/;
       var check = true;
       var check2 = true;
       var check3 = true;
       var check4 = true;
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
          $('#bookForm .num ').each(function(){
           $(this).removeClass("highLight");
           if($(this).val() ){
                 if($(this).val()<0){
                      
                      check4 = false;
                 $(this).addClass("highLight");
                 }
               
               
           }

          });
        if($('#bookForm .year').val()){
           
             var val = $('#bookForm .year').val();
            $('#bookForm .year').removeClass("highLight");
            if(val<1902||val>2018){
                    check3 = false;
                    
             $('#bookForm .year').addClass("highLight");
            }
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
        return (check&&check2&&check3&&check4);
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
           $(this).removeClass("highLight");
           if($(this).val() ){
                 if($(this).val()<0){
                      
                      check4 = false;
                 $(this).addClass("highLight");
                 }
               
               
           }

          });
          if($('#digitalForm .year').val()){
              var val =$('#digitalForm .year').val();
             $('#digitalForm .year').removeClass("highLight");
            if(val<1902||val>2018){
                    check3 = false;
             $('#digitalForm .year').addClass("highLight");
            }
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
        return (check&&check2&&check3&&check4);
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