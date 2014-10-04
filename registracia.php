
<?php
require("mailer/class.phpmailer.php");
include "connect.php";
function Jemail ($cislo){
return preg_match("/^.+@.+\.[a-zA-Z]+$/",$cislo);
}
function Onlymail ($cislo,$connect) {
$vysledok = $connect->prepare("select * from uzivatelia where email=:mail");
$vysledok->bindParam(':mail',$cislo);
$vysledok->execute();
$count = $vysledok->rowCount();
if ($count>0) return true;

}
function Onlymeno ($cislo,$connect) {
$vysledok = $connect->prepare("select * from uzivatelia where prezyvka=:prez");
$vysledok->bindParam('prez',$cislo);                                       
$vysledok->execute();
$count = $vysledok->rowCount();
if ($count>0) return true;

}
function Niecochyba ($a,$b,$c,$d) {
if ($a == "" || $b == "" || $c== "" || $d== "")
return true;
}
function retazec($dlzka) {
                          $mozne_znaky = 'abcdefghijklmnopqrstuvwxyz123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                          $vystup = '';
                          $pocet_moznych_znakov = strlen($mozne_znaky);
                          for ($i=0;$i<$dlzka;$i++) {
                            $vystup .= $mozne_znaky[mt_rand(0,$pocet_moznych_znakov - 1)];
                          }
                          return $vystup;
                          }
$formular=true;
$vsetkospravne=true;
if (!empty($_POST)) {
 if (isset($_POST['meno'])) {
 $meno = $_POST['meno'];
 }
if (isset($_POST['priezvisko'])) { 
 $priezvisko = $_POST['priezvisko'];
}
if (isset($_POST['firma'])) {
 $firma = $_POST['firma'];
 }

if (isset($_POST['prezyvka'])) {
 $prezyvka = $_POST['prezyvka'];
 }
if (isset($_POST['heslo'])) {                                            
 $heslo = sha1($_POST['heslo']);
 }
if (isset($_POST['potvrdheslo'])) {
 $potvrdheslo =sha1($_POST['potvrdheslo']); 
}
if (isset($_POST['email'])) {
$email = $_POST['email'];
}
if (isset($_POST['regcode'])) {
$regcode = $_POST['regcode'];
}
$code=$_SESSION["code"];

if($firma=="" && ($meno=="" || $priezvisko=="")) { echo "<font color='red'>Mus�te vyplni� Va�e osobn� �daje alebo n�zov spolo�nosti!</font>"; $vsetkospravne= false; }
elseif (Niecochyba($prezyvka,$heslo,$potvrdheslo,$email)) {
echo "<font color='red'>Nevyplnili ste v�etky �daje z formul�ra!</font>";
$vsetkospravne = false;
}
else 
{
if (!Jemail($email)) { echo "<font color='red'>Nieje zadan� platn� mail!</font><BR>"; $vsetkospravne = false; }
if ($heslo !== $potvrdheslo) { echo "<font color='red'>Heslo a potvrdenie hesla sa nezhoduj�!</font><BR>"; $vsetkospravne = false; }
if (Onlymail($email,$db)) { echo "<font color='red'>Zadan� e-mail je u� registrovan�!</font><BR>"; $vsetkospravne = false; }
if (Onlymeno($prezyvka,$db)) { echo "<font color='red'>Zadan� prihlasovacie meno sa u� pou��va!</font><BR>"; $vsetkospravne = false; }
if ((strlen($_POST['prezyvka'])>50) || (strlen($_POST['prezyvka']))<3 ) { echo "<font color='red'>Prihlasovacie meno mus� obsahova� aspo� 3 a najviac 50 znakov!</font><BR>"; $vsetkospravne = false; }
if ( (strlen($_POST['heslo']) > 50)|| (strlen($_POST['heslo']) < 3) ) { echo "<font color='red'>Heslo mus� obsahova� aspo� 3 a najviac 50 znakov!</font><BR>"; $vsetkospravne = false; }
if (strlen($regcode) < 1 || $regcode != $code) { echo "<font color='red'>Neop�sali ste spr�vny k�d z obr�zka</font>"; $vsetkospravne=false; }
}
if ($vsetkospravne == true) {
$formular=false;
$allowed=0;
$ret=retazec(8);
$datum=strtotime("now");
$st = $db->prepare("INSERT INTO uzivatelia (meno,priezvisko,firma,prezyvka,heslo,email,ret,allowed,datum) values (:meno,:priezvisko,:firma,:prezyvka,:heslo,:email,:ret,:allowed,:datum)");
$st->execute(array(':meno' => $meno,':priezvisko' => $priezvisko,':firma' =>$firma,':prezyvka' =>$prezyvka,':heslo'=>$heslo,':email' => $email,':ret'=>$ret,':allowed'=> $allowed,':datum'=>$datum)) 
or die('Nepodarilo sa');


                                        $sprava=new PHPMailer();
                                        $sprava->From= "t.hegi@azet.sk";
                                        $sprava->AddAddress("autorita3@gmail.com"); 
                                        $sprava->Subject="Povolenie u��vate�a";
                                        $sprava->CharSet="Windows-1250";
                                        $sprava->IsHtml(true);
                                        $sprava->Body="U��vate� �ak� na va�e schv�lenie.<br>Meno:$meno <br> Priezvisko:$priezvisko <br>
                                        Firma:$firma<br>
                                        E-mail:$email <br> V pr�pade ak chcete u��vate�a povoli� kliknite na tento odkaz: <a href='http://tomas.omfg.sk/povolenie.php?r=$ret&povolenie=1' target='blank'>povoli�</a> <br>
                                        Ak ho povoli� nechcete tak kliknite na tento odkaz: <a href='http://tomas.omfg.sk/povolenie.php?r=$ret&povolenie=0' target='blank'>zak�za�</a>";
                            
if ($sprava->send()) {                                        
echo "Va�a registr�cia prebehla �spe�ne, ale e�te nieje dokon�en�.Na �spe�ne dokon�enie registr�cie potrebujete schv�lenie
administr�tora.O jeho rozhodnut� budete informovan� najnesk�r do 24 hod�n na Va�ej e-mailovej adrese.";
}
else { echo "Registr�cia sa nepodarila" .$sprava->errorInfo; }
}
}
if ($formular) :?> 

<form action="registracka.php" method="post">
<table cellspacing=10px>
<tr>  
<td>Meno:</td><td><input type="text" name="meno"></td>
</tr>
<tr>  
<td>Priezvisko:</td><td><input type="text" name="priezvisko"></td>
</tr>
<tr>    
<td>N�zov spolo�nosti:</td><td><input type="text" name="firma"></td>
</tr>
<tr>  
<td>Prihlasovacie meno:</td><td><input type="text" name="prezyvka"></td>
</tr>
<tr>  
<td>Heslo:</td><td><input type="password" name="heslo" ></td>
</tr>
<tr>  
<td>Potvr�te heslo:</td><td><input type="password" name="potvrdheslo"></td>
</tr>
<tr> 
<td>E-mail:</td><td><input type="text" name="email"></td>
</tr>
</table>
<br>
<img src="/../authcode.php" style="vertical-align: middle" vspace="1" alt="Authcode" /> 
<input name="regcode" type="text" class="textbox" />
<div class="tlacitkoreg"><input type="submit" value="Registrova�"></div>
</form>
<?php endif;?>
