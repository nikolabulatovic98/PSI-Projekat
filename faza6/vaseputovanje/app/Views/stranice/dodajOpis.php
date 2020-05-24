<html>
    <head>
      
        <link rel="stylesheet" href="\css\pomoc.css">
       
 
  
    </head>
    
    <body class="badiklasa">
        
   <div class="main">
        
        <form action="<?= site_url("Moderator/novoPutovanje") ?>" method="POST">
                <h2 class="name">
                 Destinacije </h2>
                <select class="option" name="destinacija">
                <option disabled="disabled" selected="selected">--Izaberite destinaciju--</option>
            
            <?php
         
            foreach($destinacije as $destinacija) echo "<option>{$destinacija->ImeDrzave}/{$destinacija->ImeDestinacije}</option>";
          
          
            ?>
          
              
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
                </select> <?php if(!empty($errors['saputnik'])) 
                echo $errors['saputnik'];
            ?>
             <h2 class="name">
                 Trajanje </h2>
                <select class="option" name="trajanje">
                <option disabled="disabled" selected="selected">--Izaberite trajanje--</option>
                <option>1-3 dana</option>
                <option>5-7 dana</option>
                <option>7+ &nbsp;dana</option>
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
             Opis </h2>
            <textarea  class="company" name="opis" id="" cols="50" rows="4" placeholder="Dodajte opis" value="<?= set_value('opis') ?> "></textarea>
            <br>
            <center>
    <?php if(isset($poruka)) echo "<h3><font color='red'>$poruka</font></h3><br>"; ?>
         
                <button type="submit" class="dugme">Potvrdi</button>
            
        </center>
    
        </form>
</div>
     
    </body>
</html>