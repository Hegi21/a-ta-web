     <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="sk">

<head>
  <title>Registr�cia</title>
  <meta http-equiv="content-type" content="text/html; charset=Windows-1250" />

  <!-- **** layout stylesheet **** -->
  <link rel="stylesheet" type="text/css" href="style/style.css" />

  <!-- **** colour scheme stylesheet **** -->
  <link rel="stylesheet" type="text/css" href="style/colour.css" />
</head>

<body>
  <div id="main">
    <div id="links">
      <!-- **** INSERT LINKS HERE **** -->
      <a href="#">another link</a> | <a href="#">another link</a> | <a href="#">another link</a> | <a href="#">another link</a>
    </div>
    <div id="logo"><div id="a">A</div><h1>utorita s.r.o.</h1></div>
    <div id="content">
      <div id="menu">
        <ul>
          <li><a href="index.html">O n�s</a></li>
          <li><a href="slu�by.html">Slu�by</a></li>
          <li><a href="PZI.html">Povinne zverej�ovan� inform�cie</a></li>
          <li><a href="referencie.html">Referencie</a></li>
         </ul>
    
      </div>
    <div id="lavemenu">  
  <br><br><br>
      <div class="sbihead">
            <h1>Aku�lne</h1>
          </div>
     <div class="kolonky">
            <ul>
              <li><a href="http://www.opendesigns.org"> Procesy VO</a></li>
              <li><a href="http://www.w3schools.com/xhtml/default.asp">�kolenia</a></li>
            </ul>
          </div>
   <br><br><br>
   <br><br><br> 
   <br><br><br>
     <div class="kolonky">
            <ul>
              <li><a href="http://www.opendesigns.org">E-podate��a</a></li>
            </ul>
          </div>
     <br><br><br>
   <br><br><br> 
   <br>
     <div class="kolonky">
            <ul>
              <li><a href="http://www.opendesigns.org">Z�kladn� pojmy</a></li>
            </ul>
          </div>
    <br><br><br>
   <br><br><br> 
   
      <div class="sbihead">
            <h1>Subjekty-pod�a <br>z�kona</h1>
          </div>
     <div class="kolonky">
            <ul>
              <li><a href="http://www.opendesigns.org">Obstar�vate�</a></li>
              <li><a href="http://www.w3schools.com/xhtml/default.asp">Verejn� obstar�vate�</a></li>
              <li><a href="http://www.w3schools.com/css/default.asp">Osoba</a></li>
            </ul>
          </div>
     <br><br><br>
   <br><br><br> 
     </div>  
     <div id="column1">
        <div class="cas">
<script language="javascript" type="text/javascript"> 
var datum = new Date(); var denVTyzdni = new Array("nede�a","pondelok", "utorok", "streda", "�tvrtok", "piatok", "sobota"); 
document.write("<strong>" + "Dnes je " + denVTyzdni[datum.getDay()] + "</strong>"); 
</script> 
<script language="javascript" type="text/javascript">
var datum = new Date()
var denvmesiaci = datum.getDate()
var mesic = datum.getMonth()+1
var rok = datum.getFullYear()
document.write("<strong>"+denvmesiaci+ "." + mesic + "." + rok + "</strong>")
</script>
<br>
<script language="javascript" type="text/javascript">
var cas = new Date()
var hodiny = cas.getHours()
var minuty = cas.getMinutes()

if (minuty < 10){
minuty = "0" + minuty
}
document.write("<strong>" + "Aktu�lny �as: " + hodiny + ":" + minuty + "</strong>")
</script>
<br><br><br>
</div>        
        <div class="sidebaritem">
         
             <div class="sbihead">
            <h1>Prihl�senie</h1>
          </div>
            <div class="sbicontent">
            <form action="prihlasenie.php" method="post">
            <table>
            <tr>
            <td>Meno</td><td><input type="text" name="meno"></td>
            </tr>
            <tr>
            <td>Heslo</td><td><input type="password" name="heslo"></td>
            </tr>
            <tr>
            <td></td><td><input type="submit" value="Prihl�si�"></td>
            </tr>
            </table>
             </form>
        <div class="odkazreg"><a href="registracia.html">Registr�cia</a></div>
        </div>
        </div>                      
        <div class="sidebaritem">
          <div class="sbihead">
            <h1>D�le�it� linky</h1>
          </div>
          <div class="sbilinks">
            <!-- **** INSERT ADDITIONAL LINKS HERE **** -->
            <ul>
              <li><a href="http://www.opendesigns.org">open designs</a></li>
              <li><a href="http://www.w3schools.com/xhtml/default.asp">learn XHTML</a></li>
              <li><a href="http://www.w3schools.com/css/default.asp">learn CSS</a></li>
              <li><a href="http://www.mozilla.com/firefox">get firefox</a></li>
            </ul>
          </div>
        </div>
        <div class="sidebaritem">
          <div class="sbihead">
            <h1>Kontakt</h1>
          </div>
          <div class="sbicontent">
            <!-- **** INSERT OTHER INFORMATION HERE **** -->
            <p>
              This space can be used for additional information such as a contact phone number, address
              or maybe even a graphic.
            </p>
          </div>
        </div>
      </div>
      <div id="column2">
<br>
<div class="registracia">
<h1>Registr�cia</h1>
<br><br>

<?php
function Jemail ($cislo){
return preg_match("/^.+@.+\..+$/",$cislo);
}
function Onlymail ($cislo) {
$vysledok = mysql_query("select * from uzivatelia where email='".$cislo."'");
return (boolean) mysql_num_rows($vysledok);
}
function Onlymeno ($cislo) {
$vysledok = mysql_query("select * from uzivatelia where prezyvka='".$cislo."'");
return (boolean) mysql_num_rows($vysledok);
}
mysql_connect("localhost","root","");
mysql_select_db("users");
$formular=true;
if (!empty($_POST)) {
 if (isset($_POST['meno'])) {
 $meno = $_POST['meno'];
 }
if (isset($_POST['priezvisko'])) { 
 $priezvisko = $_POST['priezvisko'];
}
 if (isset($_POST['prezyvka'])) {
 $prezyvka = $_POST['prezyvka'];
 }
if (isset($_POST['heslo'])) {
 $heslo = sha1($_POST['heslo']);
 }
if (isset($_POST['potvrdheslo'])) {
 $potvrdheslo = sha1($_POST['potvrdheslo']); 
}
if (isset($_POST['email'])) {
$email = $_POST['email'];
}
 if (!Jemail($email)) echo "Nieje zadan� platn� mail";
elseif ($heslo !== $potvrdheslo) echo "Heslo a potvrdenie hesla sa nezhoduj�";
elseif (Onlymail($email)) echo "Zadan� e-mail je u� registrovan�";
elseif (Onlymeno($prezyvka)) echo "Zadan� prihlasovacie meno sa u� pou��va";

else {
$formular=false;
mysql_query("INSERT INTO uzivatelia(meno,priezvisko,prezyvka,heslo,email) VALUES('$meno','$priezvisko','$prezyvka','$heslo','$email')")
or die("U��vate�a sa nepodarilo registrova�.");
}
}
if ($formular) :?> 
<form action="registracia.php" method="post">
<table cellspacing=10px>
<tr>  
<td>Meno:</td><td><input type="text" name="meno"></td>
</tr>
<tr>  
<td>Priezvisko:</td><td><input type="text" name="priezvisko"></td>
</tr>
<tr>  
<td>Prihlasovacie meno:</td><td><input type="text" name="prezyvka"></td>
</tr>
<tr>  
<td>Heslo:</td><td><input type="password" name="heslo"></td>
</tr>
<tr>  
<td>Potvr�te heslo:</td><td><input type="password" name="potvrdheslo"></td>
</tr>
<tr> 
<td>E-mail:</td><td><input type="text" name="email"></td>
</tr>
</table>
<br>
<div class="tlacitkoreg"><input type="submit" value="Registrova�"></div>
</form>
<?php endif;?>
</div>
    </div>
    <div id="footer">
      copyright &copy; 2006 your name | <a href="#">email@emailaddress</a> | <a href="http://validator.w3.org/check?uri=referer">XHTML 1.1</a> | <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a> | <a href="http://www.dcarter.co.uk">design by dcarter</a>
    </div>
  </div>
</body>
</html>
