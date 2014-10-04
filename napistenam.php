<?php session_start(); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="sk">

<head>
  <title>O nás</title>
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
    </div>
    <div id="logo"></div>
    <div id="content">
      <div id="menu">
        <ul>
          <li><a id="selected" href="index.html">O nás</a></li>
          <li><a href="page1.html">Služby</a></li>
          <li><a href="page2.html">Povinne zverejňované informácie</a></li>
          <li><a href="page3.html">Referencie</a></li>
         </ul>
    
      </div>
    <div id="lavemenu">  
      <br><br>
      <div class="sbihead">
            <h1>AKTUÁLNE</h1>
          </div>
     <div class="kolonky">
            <ul>
              <li id="short"><a href="http://www.opendesigns.org"> Procesy VO</a></li>
              <li id="short"><a href="http://www.w3schools.com/xhtml/default.asp">Školenia</a></li>
              <li id="short"><a href="http://www.w3schools.com/xhtml/default.asp">Finančné limity <br>platné od 01.02.2014</a></li>
            </ul>
          </div>
   <br><br><br>
   <br><br><br>
   <br><br><br> 
    <div class="sbihead2">
            <h1>POVINNÉ OSOBY PODĽA ZÁKONA O VO</h1>
          </div>
     <div class="kolonky">
            <ul>
             <div id="short"> <li><a href="http://www.opendesigns.org">Obstarávateľ</a></li>
              <li><a href="http://www.w3schools.com/xhtml/default.asp">Verejný obstarávateľ</a></li>
              <li><a href="http://www.w3schools.com/css/default.asp">Osoba podľa §7 zákona <br> o verejnom obstarávaní</a></li> </div>
            </ul>
          </div>
    <br><br><br>
   <br><br><br> 
   <br><br><br> 
    <div class="sbihead">
            <h1>INÉ</h1>
          </div>
     <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js">
</script>
<script> 
$(document).ready(function(){
  $("#vyhlasky").click(function(){
    $("#panel").slideToggle("200");
  });
});
</script>
      <div class="kolonky">
            <ul>
              <li><a>Základné pojmy</a></li> 
            <div id="panel"><li id="panel"><a>Vyhlášky UVO o finančných limitoch</a></li>
                                                      <li><a>Vyhlášky UVO o hodnotení spôsobu a kvality plnenia zmlúv</a></li>
            </div>
             </ul>
          </div> 
<br><br><br><br><br><br><br><br><br><br><br>
<div class="sbihead">
       <h1>KONTAKT</h1>
       </div>
       <div class="ramcek">
         <p><br>AUTORITA, s.r.o.<br>
       <p>Hroncova 3, 040 01 Košice <br>
       Tel.:0915 934 159 <br>
       E-mail:autorita3@gmail.com <br> 
	   <a href="napistenam.php">Napíšte nám</a>
    </p>
    </div>   
<br><br>
   <div class="pocitadlo">
   <a href="http://www.toplist.sk/"><script language="JavaScript" type="text/javascript">
document.write('<img src="http://toplist.sk/count.asp?id=1255185&logo=mc&t='+escape(document.title)+
'&wi='+escape(window.screen.width)+'&he='+escape(window.screen.height)+'" width="88" height="60" border=0 alt="TOPlist" />'); 
</script><noscript><img src="http://toplist.sk/count.asp?id=1255185&logo=mc" border="0"
alt="TOPlist" width="88" height="60" /></noscript></a>

  </div>

   <br><br><br>
   <br><br><br> 
     </div>  
     <div id="column1">
        <div class="cas">
<script language="javascript" type="text/javascript"> 
var datum = new Date(); var denVTyzdni = new Array("nedeľa","pondelok", "utorok", "streda", "štvrtok", "piatok", "sobota"); 
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
document.write("<strong>" + "Aktuálny čas: " + hodiny + ":" + minuty + "</strong>")
</script>
<br><br><br>
</div>        
<?php if (!isset($_SESSION['logged'])):?>       
    <div class="sidebaritem">
         <div class="sbihead">
            <h1>PRIHLÁSENIE</h1>
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
            <td></td><td><input type="submit" value="Prihlásiť"></td>
            </tr>
            </table>
             </form>
        <p><a href="registracka.php">Registrácia</a></p>
        <br>
        <p><a href="zabudnuteheslo.php">Zabudol som heslo</a></p>
        </div>
        </div>                      
        <?php else: ?>
        <div class="sidebaritem">
        <div class="sbihead">
            <h1>UŽÍVATEĽ</h1>
          </div>
        <div class="sbicontent">
        <?php if (isset($_SESSION['name'])) echo "<font size='4px'>Ste prihlásený ako:</font>".$_SESSION['name'];?>
        <br>
        <br>
        <p><a href='zmenahesla.php'>Zmeniť heslo</a></p>
        <br>
        <p><a href='odhlasenie.php'>Odhlásiť</a></p>
        </div>
        </div>
        <?php endif;?>
       <div class="sidebaritem">
          <div class="sbihead">
            <h1>DÔLEŽITÉ LINKY</h1>
          </div>
          <div class="sbilinks">
            <!-- **** INSERT ADDITIONAL LINKS HERE **** -->
            <ul>
              <li><a href="https://www.uvo.gov.sk">Úrad pre verejné obstarávanie</a></li>
              <li class='dlhy'><a href="http://www.asfeu.sk">Agentúra Ministerstva školstva, vedy,výskumu a športu SR</a></li>
              <li class='dlhy'><a href="http://www.apa.sk">Agentúra Ministerstva pôdohospodárstva a rozvoja vidieka SR</a></li>
              <li class='dlhy'><a href="http://www.siea.sk">Agentúra Ministerstva hospodárstva SR</a></li>
              <li class='dlhy'><a href="http://www.sia.gov.sk">Agentúra Ministerstva práce, sociálnych vecí a rodiny SR</a></li>
              <li><a href="http://www.sazp.sk">Agentúra Ministerstva životného prostredia SR</a></li>
               <li><a href="http://www.envirofond.sk">Environmentálny fond</a></li>
               <li><a href="http://www.husk-cbc.eu/">Program cezhraničnej spolupráce MR-SR</a></li>
               <li><a href="http://www.huskroua-cbc.net/sk">Program cezhraničnej spolupráce MR-SR-RO-UA</a></li>
               <li><a href="http://www.eurofondy.webnode.sk">Eurofondy</a></li>
               <li><a href="http://www.sario.sk">Slovenská agentúra pre rozvoj investícií a obchodu</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div id="column2">
      <div class="registracia">
<h1>Napíšte nám</h1>
<br><br>
<?php include ('writeuss.php'); ?>
</div>
      </div>
    </div>
    <div id="footer">
      copyright &copy; 2006 your name | <a href="#">email@emailaddress</a> | <a href="http://validator.w3.org/check?uri=referer">XHTML 1.1</a> | <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a> | <a href="http://www.dcarter.co.uk">design by dcarter</a>
    </div>
  </div>
</body>
</html>
