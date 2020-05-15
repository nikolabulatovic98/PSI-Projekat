<form name="pretragavesti" method="get"
      action="<?= site_url("$controller/pretraga") ?>" >
    Pretraga: <input type="text" name="pretraga"><br>
    <input name="Trazi" type="submit" value="Trazi"><br>
</form>
<?php 
    if(!empty($trazeno))
        echo "<h3>Rezultati pretrage $trazeno:</h3>";
    else 
        echo "<h3>Sve vesti</h3>";
?>

<table>
    <tr><th>Naslov</th><th>Autor</th><th>Detaljnije</th> 
<?php
foreach ($vesti as $vest) {
    echo "<tr><td>{$vest->naslov}</td><td>{$vest->autor}</td>";
    echo "<td>".anchor("$controller/vest/{$vest->id}", "Link")."</td></tr>";
}
?>
</table>
