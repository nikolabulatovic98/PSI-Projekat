<?php
    if(!empty($errors)) echo "<span style='color:red'>$errors</span>";

    echo form_open("Korisnik/novaVest","method=post");    
    echo "<br/>Naslov:<br/>";
    echo form_input("naslov",set_value("naslov")); 
    echo "<br>Sadrzaj:<br/>";
    echo form_textarea("sadrzaj",set_value("sadrzaj")); 
    echo "<br/><br/>";
    echo form_submit("dodaj", "Dodaj");
    echo form_close();
?>
