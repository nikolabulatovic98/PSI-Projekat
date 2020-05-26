
<html> 
   <link rel="stylesheet" href="\css\design5.css">
    <body>
        <div class="myDIV" align="center">
            
    <ol align="left"><h1>Top 5:</h1>
    <br>
    <?php if(isset($nadjeno)) {
        if(!$nadjeno) echo "Nema destinacija";
        else {
            foreach ($nadjeno as $row)
{
    
    echo "<li><b>{$row->ImeDestinacije}";
    echo ", ";
    echo $row->ImeDrzave;
    echo "</b></li>";
    echo "<p>{$row->Opis}</p>";
   
}
        }
    }
    ?>
    </ol>
       
    </div>
    </body>
</html>

