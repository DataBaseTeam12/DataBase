function checkBook(){
       var check = true;
     $('#bookForm .check ').each(function(){
           $(this).removeClass("highLight");
           if(!$(this).val() ){
              check = false;
             $(this).addClass("highLight");
           }




     });
   
        return check;
}



function checkDigital(){
      var check = true;
     $('#digitalForm .check ').each(function(){
           if(!$(this).val() ){
               check = false;
               $(this).addClass("highLight");}




     });

  return check;
}

function checkLaptop(){
     var check = true;
     $('#LaptopForm .check ').each(function(){
           if(!$(this).val() ){
              check = false;
             $(this).addClass("highLight");
           }




     });
 return check;
}
