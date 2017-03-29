 function addLaptop(){
  var data = $('#laptop').val();
  var type = "laptop";
  var xmlhttp = new XMLHttpRequest();
         xmlhttp.onreadystatechange = function() {
             if (this.readyState == 4 && this.status == 200) {
                 alert(this.responseText);
             }
         };
         xmlhttp.open("GET", "addQuery.php"+"?t="+type+"&serial="+data , true);
         xmlhttp.send();
}
 function addBook(){
  var data = $('#bookForm').serializeArray();
  data = JSON.stringify(data);
  var type ="book";
 var xmlhttp = new XMLHttpRequest();
         xmlhttp.onreadystatechange = function() {
             if (this.readyState == 4 && this.status == 200) {
                 alert(this.responseText);

             }
         };
         xmlhttp.open("GET", "addQuery.php"+"?t="+type+"&data="+data, true);
         xmlhttp.send();

}
function addDigital(){
    var type = $('#digitalType').val();
    var data = $('#digitalForm').serializeArray();
    data = JSON.stringify(data);
    var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    alert(this.responseText);

                }
            };
            xmlhttp.open("GET", "addQuery.php"+"?t="+type+"&data="+data, true);
            xmlhttp.send();

}
