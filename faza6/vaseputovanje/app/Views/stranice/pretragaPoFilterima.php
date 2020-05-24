<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="\css\pomoc.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
<body class="badiklasa">
        
   <div class="main">
     <form action="<?= site_url("KorisnikM/pretrazi") ?>" method="POST">
                
            <h2 class="name">
                Ocena</h2>
             <select class="option" name="ocena">
                   <option disabled="disabled" selected="selected">--Izaberite ocenu--</option> 
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select> 
         
            <h2 class="name">
                Saputnik</h2>
          <select class="option" name="saputnik">
                    <option disabled="disabled" selected="selected">--Izaberite saputnika--</option>
                    <option>Društvo</option>
                    <option>Porodica</option>
                    <option>Solo putovanje</option>
                    <option>Voljena osoba</option>
                    <option>Poslovno</option>
                </select> 
         
         
             <h2 class="name">
                 Trajanje </h2>
                <select class="option" name="trajanje">
                <option disabled="disabled" selected="selected">--Izaberite trajanje--</option>
                <option value="1">1-3 dana</option>
                <option value="2">5-7 dana</option>
                <option value="3">7+ &nbsp;dana</option>
            </select>
            <h2 class="name">
              Uzrast </h2>
                <select class="option" name="Uzrast">
                <option disabled="disabled" selected="selected">--Izaberite uzrast--</option>
                <option value="1">Mlađi od 18 godina</option>
                <option value="2">18 - 35 godina</option>
                <option value="3">35 - 55 godina</option>
                <option value="4">Više od 55 godina</option>
                </select>
         <h2 class="name">
              Vrste destinacija </h2>
                <select class="option" name="vrsta">
                <option disabled="disabled" selected="selected">--Izaberite vrstu--</option>
                <option >Gradovi Evrope</option>
                <option >Daleke</option>
                <option >Izleti</option>
                <option >Letovanje</option>
                <option >Zimovanje</option>
                </select>
         </br>
         <center>
         <?php if(isset($poruka)) echo "<font color='red'>$poruka</font><br>"; ?>
         </center>
          <center>    
             <button type="submit" class="dugme">Pretraži</button>    
        </center>
     </form>
   </div>
    <br/>

    <div class="destinacije">
    <br>
    <?php if(isset($nadjeno)) {
        if(!$nadjeno) echo "Nije pronadjena nijedna takva destinacija";
        else {
            echo "Pronadjene destinacije su:</br></br> ";
            foreach ($nadjeno as $row)
{
    echo $row->ImeDestinacije;
    echo ", ";
    echo $row->ImeDrzave;
    echo "<br>";
   
}
        }
    }
    ?>
    </div>
</center>
</body>
</html>
