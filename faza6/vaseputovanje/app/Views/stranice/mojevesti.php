<h3>Moje vesti</h3>
<?php
foreach ($vesti as $vest) {
    echo "<a href='".site_url("$controller/vest/{$vest->id}").
            "'>{$vest->naslov}</a><br>"; 
}

