
<html>
    <head>
    <title>Document</title>
    <link rel="stylesheet" href="\css\design5.css">
</head>
<body>
        <div class="myDIV" align="center">
            <h1>Moja putovanja</h1>
            <br>
            <p class="myP">
    <?php if(isset($nadjeno)) {
        if(!$nadjeno) echo "Nema Vasih putovanja u bazi";
        else {
            foreach ($nadjeno as $row)
{
                
    echo $row->ImeDestinacije;
    echo ", ";
    echo $row->ImeDrzave;
    echo "<br>";
    echo "<br>";
    echo $row->Tekst;
    echo "<br>";
    echo "<br>";
   
}
        }
    }
    ?>
                </p>
        </div>
    </body>
</html>

