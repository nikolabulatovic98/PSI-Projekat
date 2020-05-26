<?php

foreach ($nadjeno as $row) {
    echo "Najbolje pronadjeno putovanje, shodno Vasim zeljama, je: "."$row->ImeDestinacije".","." $row->ImeDrzave";
     echo "<br>";
   if($row->Trajanje=='1') echo "Preporucujemo Vam da za ovo putovanje izdvojite 1-3 dana";
   
   else if($row->Trajanje=='5') echo "Preporucujemo Vam da za ovo putovanje izdvojite 5-7 dana";
       else echo "Preporucujemo Vam da za ovo putovanje izdvojite bar 7 dana";
    echo "<br>";
    echo "Za saputnika Vam preporucujemo: "."$row->Saputnik";
    echo "<br>";
    echo "<br>";
    echo $row->Opis;
    echo "<br>";
    echo '<img src="data:image/jpeg;base64,'. base64_encode($row->Slika) .'" />';
}

