
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="\css\pomoc.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <title>Document</title>
</head>
<body class="badiklasa">
    <div class="regform">
        <h1>
 Dodavanje putovanja</h1>
</div>
<div class="main">

    
        <form action="<?= site_url("KorisnikM/dodajPutsubmit") ?> "method="POST">
           


    
                <h2 class="name">
                 Destinacije </h2>
                <select class="option" name="DESTINACIJA">
                <option disabled="disabled" selected="selected">--Izaberite destinaciju--</option>
                 <?php
         
                     foreach($destinacije as $destinacija) 
                         echo "<option>{$destinacija->ImeDrzave}/{$destinacija->ImeDestinacije}</option>";
                     ?>
            </select>

            <h2 class="name">
                Saputnik</h2>
    <select class="option" name="SAPUTNIK">
                    <option disabled="disabled" selected="selected">--Izaberite saputnika--</option>
                    <option>Društvo</option>
                    <option>Porodica</option>
                    <option>Solo putovanje</option>
                    <option>Voljena osoba</option>
                    <option>Poslovno</option>
                </select>
            
            <h2 class="name">
                 Trajanje </h2>
                <select class="option" name="TRAJANJE">
                <option disabled="disabled" selected="selected">--Izaberite trajanje--</option>
                <option>1-3 dana</option>
                <option>5-7 dana</option>
                <option>7+ &nbsp;dana</option>
            </select>
    
            <h2 id="coustomer">
            Ocenite putovanje</h2>
                <label class="radio">
                <input class="radio-one" type="radio" checked="checked" name="rdiobtn" value="1">
                <span class="checkmark"></span>
                1
            </label>
    
            <label class="radio">
                <input class="radio-two" type="radio" name="rdiobtn" value="2">
                <span class="checkmark"></span>
               2
            </label>
            <label class="radio">
                <input class="radio-two" type="radio" name="rdiobtn" value="3">
                <span class="checkmark"></span>
               3
            </label>
            <label class="radio">
                <input class="radio-two" type="radio" name="rdiobtn" value="4">
                <span class="checkmark"></span>
               4
            </label>
            <label class="radio">
                <input class="radio-two" type="radio" name="rdiobtn" value="5">
                <span class="checkmark"></span>
               5
            </label>


    
            <h2 class="name">
             Komentar </h2>
             <textarea  class="company" name="KOMENTAR" id="" cols="50" rows="4" placeholder="Unesite komentar"></textarea>
        

            <center>
                  <?php if(isset($poruka)) echo "<h3><font color='red'>$poruka</font></h3><br>"; ?>
                <button type="submit" class="dugme">Potvrdi</button>
            
        </center>
    
        </form>
</div>
</body>
</html>



