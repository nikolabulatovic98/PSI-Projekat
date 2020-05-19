
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="\css\pomoc.css">
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
                <select class="option" name="subject">
                <option disabled="disabled" selected="selected">--Izaberite destinaciju--</option>
                 <?php
         
                     foreach($destinacije as $destinacija) echo "<option>{$destinacija->ImeDestinacije}/  {$destinacija->ImeDrzave}</option>";
                     ?>
            </select>

            <h2 class="name">
                Saputnik</h2>
    <select class="option" name="subject">
                    <option disabled="disabled" selected="selected">--Izaberite saputnika--</option>
                    <option>Društvo</option>
                    <option>Porodica</option>
                    <option>Solo putovanje</option>
                    <option>Voljena osoba</option>
                    <option>Poslovno</option>
                </select>
    
            <h2 id="coustomer">
            Ocenite putovanje</h2>
                <label class="radio">
                <input class="radio-one" type="radio" checked="checked" name="rdiobtn">
                <span class="checkmark"></span>
                1
            </label>
    
            <label class="radio">
                <input class="radio-two" type="radio" name="rdiobtn">
                <span class="checkmark"></span>
               2
            </label>
            <label class="radio">
                <input class="radio-two" type="radio" name="rdiobtn">
                <span class="checkmark"></span>
               3
            </label>
            <label class="radio">
                <input class="radio-two" type="radio" name="rdiobtn">
                <span class="checkmark"></span>
               4
            </label>
            <label class="radio">
                <input class="radio-two" type="radio" name="rdiobtn">
                <span class="checkmark"></span>
               5
            </label>


    
            <h2 class="name">
             Komentar </h2>
             <textarea  class="company" name="" id="" cols="50" rows="4" placeholder="Unesite komentar"></textarea>
        

            <center>
                <button type="submit" class="dugme">Potvrdi</button>
            
        </center>
    
        </form>
</div>
</body>
</html>



