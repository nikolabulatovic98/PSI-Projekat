<html>
<head>
<script>
function showHint(str) {
  if (str.length == 0) {
    document.getElementById("txtHint").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("txtHint").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET", "AdministratorUkloni/gethint?q=" + str, true);
    xmlhttp.send();
  }
}
</script>
 <link rel="stylesheet" href="\css\design3.css"> 
  <link rel="stylesheet" href="\css\ukloniKor.css"> 
  
  
</head>
<body>
    <div class="navbar">
           
   
        <?= anchor("Administrator/izbacivanje", "Ukloni korisnika") ?>
        <?= anchor("Administrator/inbox", "Inbox") ?> 
        <?= anchor("Administrator/izlogujse", "Izloguj se") ?> 
        
    </div>
    <br><br>

    <div class="main">
        <div class="regform">
            <center>
<h1><b>Unesite ime korisnika kog želite da uklonite: </b></h1>
<form action="AdministratorUkloni/ukloni" method="POST">
  <label for="fname" class="korime">Korisničko ime :</label>
  <input type="text" id="fname" name="fname" onkeyup="showHint(this.value)">
  <input type="submit" value="ukloni" class="btn">
  </center>
</form>
<p class="predlog">Predlog : <span id="txtHint"></span></p>
<br><center>
 <?php if(isset($poruka)) echo "<font color='red' size=5>$poruka</font><br>"; ?>
</center>

</div>
</div>
</body>
</html>