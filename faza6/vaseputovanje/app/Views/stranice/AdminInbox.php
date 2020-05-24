
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="/css/pomoc1.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <title>Document</title>
</head>
<body class="badiklasa">
    <div class="regform">
        <h1>
 Dodavanje Moderatora</h1>
</div>
<div class="main">

    
        <form action="<?= site_url("Administrator/inboxChecked") ?> "method="POST">
           


    
                <h2 class="name">
                Korisnici :  </h2>
                <select class="option" name="KORISNICI">
                <option disabled="disabled" selected="selected">--Izaberite korisnika--</option>
                 
            </select>

           
            
            
    
            <h2 id="coustomer">
           Izaberite akciju : </h2>
                <label class="radio">
                <input class="radio-one" type="radio" checked="checked" name="rdiobtn" value="1">
                <span class="checkmark"></span>
                Postavi kao moderator
            </label>
    
            <label class="radio">
                <input class="radio-two" type="radio" name="rdiobtn" value="2">
                <span class="checkmark"></span>
               Odbij zahtev
            </label>
           


    
            <br>
            <br>
            <br>
            <br>
        

            <center>
                  <?php if(isset($poruka)) echo "<h3><font color='red'>$poruka</font></h3><br>"; ?>
                <button type="submit" class="dugme">Potvrdi</button>
            
        </center>
    
        </form>
</div>
</body>
</html>



