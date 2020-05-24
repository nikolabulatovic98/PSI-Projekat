

<link rel="stylesheet" href="\css\style.css">
<!--
<form name="loginform" action="<?= site_url("Gost/loginSubmit") ?>" method="post">
<table>
    <tr>
        <td>Korisnicko ime:</td>
        <td><input type="text" name="korime" 
                   value="<?= set_value('korime') ?>"/></td>
        <td><font color='red'>
            <?php if(!empty($errors['korime'])) 
                echo $errors['korime'];
            ?></font></td>
    </tr>
    <tr>
        <td>Lozinka:</td>
        <td><input type="password" name="lozinka"/></td>
        <td><font color='red'>
             <?php if(!empty($errors['lozinka'])) 
                echo $errors['lozinka'];
            ?></font></td>
    </tr>
    <tr>
        <td><input type="submit" value="Log in"/></td>
    </tr>
</table>
</form>
-->
<form name="loginform" action="<?= site_url("Gost/loginSubmit") ?>" method="post">
<div class="login-box">
  <h1>Login</h1>
  <div class="textbox">
    <i class="fas fa-user"></i>
    <input type="text" placeholder="Korisničko ime" name="korime" 
                   value="<?= set_value('korime') ?>">
  </div>
  <div>
      <font color='red'>
      <?php if(!empty($errors['korime'])) 
                echo $errors['korime'];
            ?>
      </font>
  </div>
  

  <div class="textbox">
    <i class="fas fa-lock"></i>
    <input type="password" placeholder="Lozinka" name="lozinka">
  </div>
  <div>
      <font color='red'>
      <?php if(!empty($errors['lozinka'])) 
                echo $errors['lozinka'];
            ?>
      </font>
      <?php if(isset($poruka)) echo "<font color='red'>$poruka</font><br>"; ?>
  </div>
  <input class="btn" value="Uloguj se" type="submit">
</div>
</form>
