<html>
    <head>
        <title>ETF Vesti</title>
    </head>
    <body>
        <?= anchor("Korisnik/index", "Sve vesti") ?>
        <?= anchor("Korisnik/mojeVesti", "Moje vesti") ?> 
        <?= anchor("Korisnik/dodajVest", "Dodaj vest") ?> 
        <div style="float: right">
            Autor: <?php  echo $autor->ime." ".$autor->prezime." "; ?>
            <?= anchor("Korisnik/logout", "Izloguj se") ?> 
        </div>
        <br>
        <hr>
        