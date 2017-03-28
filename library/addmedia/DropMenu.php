<?php
function languageList(){
  $list = '
  <select class="form-control" id="language" name="language"  >
  <option value="Afrikanns">Afrikanns</option>
  <option value="Albanian">Albanian</option>
  <option value="Arabic">Arabic</option>
  <option value="Armenian">Armenian</option>
  <option value="Basque">Basque</option>
  <option value="Bengali">Bengali</option>
  <option value="Bulgarian">Bulgarian</option>
  <option value="Catalan">Catalan</option>
  <option value="Cambodian">Cambodian</option>
  <option value="Chinese (Mandarin)">Chinese (Mandarin)</option>
  <option value="Croation">Croation</option>
  <option value="Czech">Czech</option>
  <option value="Danish">Danish</option>
  <option value="Dutch">Dutch</option>
  <option value="English" selected>English</option>
  <option value="Estonian">Estonian</option>
  <option value="Fiji">Fiji</option>
  <option value="Finnish">Finnish</option>
  <option value="French">French</option>
  <option value="Georgian">Georgian</option>
  <option value="German">German</option>
  <option value="Greek">Greek</option>
  <option value="Gujarati">Gujarati</option>
  <option value="Hebrew">Hebrew</option>
  <option value="Hindi">Hindi</option>
  <option value="Hungarian">Hungarian</option>
  <option value="Icelandic">Icelandic</option>
  <option value="Indonesian">Indonesian</option>
  <option value="Irish">Irish</option>
  <option value="Italian">Italian</option>
  <option value="Japanese">Japanese</option>
  <option value="Javanese">Javanese</option>
  <option value="Korean">Korean</option>
  <option value="Latin">Latin</option>
  <option value="Latvian">Latvian</option>
  <option value="Lithuanian">Lithuanian</option>
  <option value="Macedonian">Macedonian</option>
  <option value="Malay">Malay</option>
  <option value="Malayalam">Malayalam</option>
  <option value="Maltese">Maltese</option>
  <option value="Maori">Maori</option>
  <option value="Marathi">Marathi</option>
  <option value="Mongolian">Mongolian</option>
  <option value="Nepali">Nepali</option>
  <option value="Norwegian">Norwegian</option>
  <option value="Persian">Persian</option>
  <option value="Polish">Polish</option>
  <option value="Portuguese">Portuguese</option>
  <option value="Punjabi">Punjabi</option>
  <option value="Quechua">Quechua</option>
  <option value="Romanian">Romanian</option>
  <option value="Russian">Russian</option>
  <option value="Samoan">Samoan</option>
  <option value="Serbian">Serbian</option>
  <option value="Slovak">Slovak</option>
  <option value="Slovenian">Slovenian</option>
  <option value="Spanish">Spanish</option>
  <option value="Swahili">Swahili</option>
  <option value="Swedish ">Swedish </option>
  <option value="Tamil">Tamil</option>
  <option value="Tatar">Tatar</option>
  <option value="Telugu">Telugu</option>
  <option value="Thai">Thai</option>
  <option value="Tibetan">Tibetan</option>
  <option value="Tonga">Tonga</option>
  <option value="Turkish">Turkish</option>
  <option value="Ukranian">Ukranian</option>
  <option value="Urdu">Urdu</option>d
  <option value="Uzbek">Uzbek</option>
  <option value="Vietnamese">Vietnamese</option>
  <option value="Welsh">Welsh</option>
  <option value="Xhosa">Xhosa</option>
  </select>
 ';
return $list;
}
function alphabetLetter(){
  $list = '
  <select class="form-control" id="initial" name="initial" >
  <option value="A ">A</option>
  <option value="B>B</option>
  <option value="C">C</option>
  <option value="D">D</option>
  <option value="E">E</option>
  <option value="F">F</option>
  <option value="G">G</option>
  <option value="H">H</option>
  <option value="I">I</option>
  <option value="J">J</option>
  <option value="K">K</option>
  <option value="L">L</option>
  <option value="M">M</option>
  <option value="N">N</option>
  <option value="O">O</option>
  <option value="P">P</option>
  <option value="Q">Q</option>
  <option value="R">R</option>
  <option value="S">S</option>
  <option value="T">T</option>
  <option value="U">U</option>
  <option value="V">V</option>
  <option value="W>W</option>
  <option value="X">X</option>
  <option value="Y">Y</option>
  <option value="Z">Z</option>

  </select>
 ';
return $list;

}
function genreList(){
  $var ='<select class="form-control" id="genre" name="genre">
     <option>Science fiction</option>
     <option>Drama</option>
     <option>Action</option>
     <option>Romance</option>
     <option>Mystery</option>
     <option>Horror</option>
     <option>Guide</option>
     <option>Health</option>
     <option>Travel</option>
     <option>Science</option>
     <option>Children</option>
     <option>Art</option>
     <option>Religion</option>
     <option>History</option>
     <option>Biography</option>
     <option>comics</option>
      <option>fantasy</option>
      <option>Law</option>
          <option>fantasy</option>
     </select>';
     return $var;
}
function MediaAttributes(){
       $var ='  <div class="form-group">
           <label for="title">Title:</label>
           <input type="text" class="form-control check  " id="Title" name="title" placeholder="enter title">
         </div>
         <div class="form-group">
           <label for="publisher">publisher:</label>
           <input type="text" class="form-control check" id="publisher" name="publisher" placeholder="Enter publisher">
         </div>
         <div class="form-group">
           <label for="published Date">Date Published:</label>
            <input type=date   class="form-control check" id="date"  name="date" min="1000-01-01"><br>
         </div>
         <div class="form-group">
           <label for="num copies">number copies:</label>
           <input type="number" class="form-control num" id="copies" name="copies" placeholder="number of copies" min="1">


         <div class="form-group">
           <label for="audience">audience:</label>
           <select class="form-control check" id="audience" name="audience">
              <option>Everyone</option>
              <option>Adult</option>
              <option>Teen</option>
              <option>Kid</option>
              </select>
         </div>';
       return $var;
}
?>
