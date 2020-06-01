
<html>
    <head>
        <title>Registracija</title>
        <link rel="stylesheet" type="text/css" href="\css\design.css">
        
    </head>
   
    <body class="kreiranjeN">
        
        <div class="A" align="center">
          <form name="kreirajNalogform" action="<?= site_url("Gost/kreirajNalog") ?>" method="post">
           <table>
               <tr>
                   <td id="ID2">
                       <center>
                       <b>Registracija</b>
                    </center>
                   </td>
               </tr>
               <tr>
                   <td>
                       Ime: <br> <input type="text" name="ime" value="<?= set_value('ime') ?>"> <br>
                       <font color='red'>
                       <?php if(!empty($errors['ime'])) 
                        echo $errors['ime'];
                        ?></font><br><br>
                        
                       Prezime <br> <input type="text" name="prezime" value="<?= set_value('prezime') ?>"><br>
                       <font color='red'>
                       <?php if(!empty($errors['prezime'])) 
                        echo $errors['prezime'];
                       ?></font><br><br>
                        
                       Email: <br> <input type="email" name="email" value="<?= set_value('email') ?>"> <br>
                       <font color='red'>
                       <?php if(!empty($errors['email'])) 
                        echo $errors['email'];
                        ?></font><br><br>
                       
                       Godište <br> <input type="number" name="god" value="<?= set_value('god') ?>"> <br>
                       <font color='red'>
                       <?php if(!empty($errors['god'])) 
                        echo $errors['god'];
                        ?></font><br><br>
                       
                       Pol: <br> <select name="pol" value="<?= set_value('pol') ?>">
                           <option disabled="disabled" selected="selected">--Izaberite pol--</option>
                         <option value="1">Muški</option>
                         <option value="2">Ženski</option>
                       </select>
                       <font color='red'>
                       <?php if(!empty($errors['pol'])) 
                            echo $errors['pol'];
                       ?></font><br><br>
                            
                       Korisničko ime: <br><input type="text" name="username"value="<?= set_value('username') ?>"> <br>
                      <font color='red'>
                      <?php if(isset($poruka)) echo "<font color='red'>$poruka</font><br>"; ?>
                       <?php if(!empty($errors['username'])) 
                        echo $errors['username'];
                        ?></font><br><br>
                        
                       Lozinka: <br> <input type="password" name="password"value="<?= set_value('password') ?>"><br>
                        <font color='red'>              
                        <?php if(!empty($errors['password'])) 
                        echo $errors['password'];
                        ?></font>
                        
                   </td>
               </tr>
               <tr>
                   <td>
                       <center>
                       <input type="submit" name="registruj" value="Registruj se">
                    </center>
                   </td>
               </tr>
           </table>
        </form>
        </div>  
            
    </body>
</html>