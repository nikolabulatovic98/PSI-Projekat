<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
      <link rel="stylesheet" href="\css\style.css">
    <link rel="stylesheet" href="/css/zmod.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
</head>
<body id="wrapper">
    <br>
    <br>    
        <h1 id="naslov">Želiš da postaneš moderator sajta ? </h1>

        <br><br>
        <br>
        <br>


        <div id="smth">      
      <p >
                
            Moderator je osoba koja ima ulogu u održavanju i uređivanju sadržaja sajta. 
      </p>

      <p>
            Može da dodaje i menja opise o aktuelnim putovanjima.
     </p>
     <p>
       Klikom na dugme Pošalji zahtev, šalješ zahtev administraotorima sajta.

     </p>
     <p>
         Oni će proceniti tvoj zahtev i u najkraćem roku će ti mejlom javiti uspešnost tvog zahteva.
     </p>
        

    </div>

        <div> 

            <center>
                <br><br>
              <form name="ZahtevModerator" action="<?= site_url("KorisnikM/zahtevPozitivan") ?>" method="post">

        <input class="btn" value="Pošalji zahtev" type="submit">
        <br>
         <br>
          <br>
        <?php if(isset($poruka)) echo "<font color='red' size='15px'>$poruka</font><br>"; ?>

          </form>

          </center>
    </div>
</body>
</html>