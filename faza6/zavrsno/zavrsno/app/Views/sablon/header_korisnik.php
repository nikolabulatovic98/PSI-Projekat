
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!--<link rel="stylesheet" href="\css\design3.css">-->
    <link rel="stylesheet" href="\css\menu.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">

</head>
<body>
    <!--<div class="navbar">
  <?= anchor("KorisnikM/najposecenije", "Najposećenije destinacije") ?>
        <?= anchor("KorisnikM/pretraga", "Pretraži putovanja") ?>
        <?= anchor("KorisnikM/idealno_putovanje", "Pronadji idealno putovanje") ?>
  <div class="dropdown">
      

    <button class="dropbtn">Moj nalog
              <i class="fa fa-caret-down"></i>

    </button>
      
     
    <div class="dropdown-content">
      <?= anchor("KorisnikM/dodajPutovanje", "Dodaj putovanje") ?>
         <?= anchor("KorisnikM/mojaPutovanja", "Moja putovanja") ?>
        <?= anchor("KorisnikM/Postani_moderator", "Zahtev za moderatora") ?>
      <?= anchor("KorisnikM/promena_lozinke", "Promeni lozinku") ?>
        
      <?= anchor("KorisnikM/izlogujse","Izloguj se") ?>
    </div>
  </div>
</div>-->
    <ul class="navList">
  <li>
    <?= anchor("KorisnikM/najposecenije", "Najposećenije destinacije") ?>
  </li>
  <li>
    <?= anchor("KorisnikM/pretraga", "Pretraži putovanja") ?>
  </li>
  <li> <?= anchor("KorisnikM/idealno_putovanje", "Pronadji idealno putovanje") ?></li>
  <li>
    <a href="#">Moj nalog</a>
    <div>
      <?= anchor("KorisnikM/dodajPutovanje", "Dodaj putovanje") ?>
         <?= anchor("KorisnikM/mojaPutovanja", "Moja putovanja") ?>
        <?= anchor("KorisnikM/Postani_moderator", "Zahtev za moderatora") ?>
      <?= anchor("KorisnikM/promena_lozinke", "Promeni lozinku") ?>
        
      <?= anchor("KorisnikM/izlogujse","Izloguj se") ?>
    </div>
  </li>
</ul>

</body>
</html>
        