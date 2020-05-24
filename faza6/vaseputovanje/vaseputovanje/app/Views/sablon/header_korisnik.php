
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="\css\design3.css">
</head>
<body >
    <div class="navbar">
  <?= anchor("KorisnikM/index", "Najposećenije destinacije") ?>
        <?= anchor("KorisnikM/pretraga", "Pretraži putovanja") ?>
        <?= anchor("KorisnikM/IdealnoPutovanje", "Pronadji idealno putovanje") ?>
  <div class="dropdown">
      

    <button class="dropbtn">Moj nalog
              <i class="fa fa-caret-down"></i>

    </button>
      
     
    <div class="dropdown-content">
      <?= anchor("KorisnikM/dodajPutovanje", "Dodaj putovanje") ?>
        <?= anchor("KorisnikM/Postani_moderator", "Zahtev za moderatora") ?>
      <?= anchor("KorisnikM/promena_lozinke", "Promeni lozinku") ?>
      <?= anchor("KorisnikM/izlogujse", "Izloguj se") ?>
    </div>
  </div>
</div>
</body>
</html>
        