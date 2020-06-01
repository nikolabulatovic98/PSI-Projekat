<html>
    <head>
      
        <style>
            *{
                margin:0;
                padding:0;
            }
            .pozadina{
             background: url(/css/poz2.jpg) no-repeat;
              background-size: cover;
              background-position:center;
              background-attachment: fixed;
            }
            .opis{
                margin-left: 10%;
                margin-right: 10%;
                margin-top: 3%;
        </style>
        
    </head>
    <body class="pozadina">

        <div class="opis">
<?php
foreach ($arr[0] as $row) {
    echo "<font size=4>*Najbolje pronadjeno putovanje, shodno Vasim zeljama, je:&nbsp&nbsp&nbsp&nbsp&nbsp</font><font size=6>"."$row->ImeDestinacije".","." $row->ImeDrzave";
     echo "<br></font>";
   if($row->Trajanje=='1') echo "<font size=4>*Preporucujemo Vam da za ovo putovanje izdvojite 1-3 dana</font>";
   
   else if($row->Trajanje=='5') echo "<font size=4>*Preporucujemo Vam da za ovo putovanje izdvojite 5-7 dana</font>";
       else echo "<font size=4>*Preporucujemo Vam da za ovo putovanje izdvojite bar 7 dana</font>";
    echo "<br>";
    echo "<font size=4>*Za saputnika Vam preporucujemo: "."$row->Saputnik";
    echo "<br></font>";
    echo "<br>";
    echo "<p style=font-size:22px>"."$row->Opis"."</p>";
    echo "<br>";
    echo '<center><img width=60% height=50% src="data:image/jpeg;base64,'. base64_encode($row->Slike) .'" /></center>';
}

echo "<br>";
echo "<br>";
echo "<b><font size=4>*Korisnici koji su obisli ovu destinaciju su rekli:</font></b>";
echo "<br>";
echo "<br>";

foreach ($arr[1] as $element) {
        echo "<i><p style=font-size:20px>&nbsp &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp"."$element->Tekst"."</p></i>";
       
       echo "</br>";
       echo "<br>";
   }

?>
        </div>
</body>
</html>