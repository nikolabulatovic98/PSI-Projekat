
<html> 
   <link rel="stylesheet" href="\css\design5.css">
  
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <body class="klasa1">
        <div class="myDIV" align="center">
          <br>
          <br>
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

