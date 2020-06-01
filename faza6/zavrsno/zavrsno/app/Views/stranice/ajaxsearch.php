<html>
<head>
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
xmlhttp.open("GET","AjaxController/dohv?q="+str,true);
xmlhttp.send();
}
</script>
</head>
<body>
    <div class="navbar">
           
   
        <?= anchor("Administrator/izbacivanje", "Ukloni korisnika") ?>
        <?= anchor("Administrator/inbox", "Inbox") ?> 
        <?= anchor("Administrator/izlogujse", "Izloguj se") ?> 
        
    </div>
    <br><br><br>
    <form action="AjaxController/ukloni" method="POST">
<select name="users"
onchange="showUser(this.value)">
<option value="">Odaberite osobu:</option> 
 <?php
         
            foreach($destinacije as $destinacija) echo "<option>{$destinacija->Username}</option>";
          
          
            ?>
</select>
        <input type="submit" value="Ukloni">
</form>
<br />
<div id="txtHint"><b>Informacije o osobi ce biti prikazane ovde.</b></div>
</body>
</html>