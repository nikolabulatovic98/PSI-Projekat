<html>
    <link rel="stylesheet" href="\css\design5.css">

    <body>
        <div class="myDIV">
            <br>
            <br>
        <p class="myP">
<?php if(isset($nadjeno)) {
        if(!$nadjeno) echo "Doslo je do greske!";
        else {
            foreach ($nadjeno as $row)
{
    echo "<b>$row->ImeDestinacije";
    echo ", ";
    echo $row->ImeDrzave;
    echo "</b>";
    echo "<br>";
    echo "<br>";
    echo $row->Opis;
    echo "<br>";
   
}
        }
    }
    ?>
        </p>
        </div>
    </body>
</html>

