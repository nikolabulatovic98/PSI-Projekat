

<html>
<head>

    <link rel="stylesheet" type="text/css" href="\css\admin.css">
<body>
    <div class="loginbox">
    <img src="\css\avatar.png" class="avatar">
        <h1>Uloguj se</h1>
        <form name="loginform" action="<?= site_url("Administrator/loginSubmit") ?>" method="post">
            <p>Korisničko ime</p>
            <input type="text" name="korime" placeholder="Unesite korisničko ime"value="<?= set_value('korime') ?>">
            <font color='red'>
             <?php if(!empty($errors['korime'])) 
                echo $errors['korime'];
            ?></font>
            <p>Lozinka</p>
            <input type="password" name="lozinka" placeholder="Unesite šifru" value="<?= set_value('lozinka') ?>">
           <font color='red'>
             <?php if(!empty($errors['lozinka'])) 
                echo $errors['lozinka'];
            ?></font>
            <?php if(isset($poruka)) echo "<font color='red'>$poruka</font><br>"; ?>
            <input type="submit" name="" value="Uloguj se">
           
        </form>
        
    </div>

</body>
</head>
</html>