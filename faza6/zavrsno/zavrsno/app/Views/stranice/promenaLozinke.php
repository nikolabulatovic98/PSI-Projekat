
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="\css\style1.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
  </head>
  <body class="prom">
    
  
            
        <form class="login-form" action="<?= site_url("KorisnikM/promenaLoz") ?>" method="post">
        <h1>Promena lozinke</h1>
        <input type="password" placeholder="Stara šifra" class="txtb" name="password"value="<?= set_value('password') ?>">
            <font color='red'>
            <?php if(!empty($errors['password'])) 
            echo $errors['password'];
            ?></font>
        <?php if(isset($poruka)) echo "<font color='red'>$poruka</font><br>"; ?>
       
        <input type="password" placeholder="Nova šifra" class="txtb"name="new" value="<?= set_value('new') ?>">
            <font color='red'>
            <?php if(!empty($errors['new'])) 
            echo $errors['new']."</br>";
            ?></font>
        <input type="password" placeholder="Potvrdi šifru" class="txtb" name="new2" value="<?= set_value('new2') ?>">
        <font color='red'>
            <?php if(!empty($errors['new2'])) 
            echo $errors['new2']."</br>";
            ?></font>
            <br>
        <input type="submit" value="Sacuvaj promene" class="login-btn">
        
      </form>
  
  </body>
</html>
