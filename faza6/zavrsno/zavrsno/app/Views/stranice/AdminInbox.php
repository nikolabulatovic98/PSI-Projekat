
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="/css/pomoc1.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <title>Document</title>
      <link rel="stylesheet" href="\css\design3.css"> 
      <script type="text/javascript">
    
function showUser(str) {
   
if (str=="") {
document.getElementById("txtHint").innerHTML="";
return;
}
if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera,

xmlhttp=new XMLHttpRequest();
}
else { // code for IE6, IE5
xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange=function() {
if (xmlhttp.readyState==4 && xmlhttp.status==200) {
document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open("GET","AdministratorInbox/dohv?q="+str,true);
xmlhttp.send();
}
</script>
</head>
<body class="badiklasa">
    <div class="navbar">
           
   
        <?= anchor("Administrator/izbacivanje", "Ukloni korisnika") ?>
        <?= anchor("Administrator/inbox", "Inbox") ?> 
        <?= anchor("Administrator/izlogujse", "Izloguj se") ?> 
        
    </div>
    <br><br><br>
    <div class="regform">
        <h1>
 Dodavanje Moderatora</h1>
</div>
<div class="main">

     
    
        <form action="<?= site_url("AdministratorInbox/inboxChecked") ?> "method="POST">
           


    
                <h2 class="name">
                Korisnici :  </h2>
                <select class="option" name="KORISNICI" onchange="showUser(this.value)">
                <option disabled="disabled" selected="selected">--Izaberite korisnika--</option>
                 <?php
         
             foreach($destinacije as $destinacija) echo "<option>{$destinacija->Username}</option>";
          
          
            ?>
            </select>

           
            
            
    
            <h2 id="coustomer">
           Izaberite akciju : </h2>
                <label class="radio">
                <input class="radio-one" type="radio" checked="checked" name="rdiobtn" value="1">
                <span class="checkmark"></span>
                Postavi kao moderator
            </label>
    
            <label class="radio">
                <input class="radio-two" type="radio" name="rdiobtn" value="2">
                <span class="checkmark"></span>
               Odbij zahtev
            </label>
           


    
            <br>
            <br>
            <br>
            <br>
        

            <center>
             
                <button type="submit" class="dugme">Potvrdi</button>
            
        </center>
            
            <br>
            <div id="txtHint">
               <!-- <b>Informacije o osobi ce biti prikazane ovde.</b>-->
            </div>
    
        </form>
</div>
</body>
</html>



