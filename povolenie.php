<?php
require("mailer/class.phpmailer.php");
include "connect.php";
if (isset($_GET['r']) &&  isset($_GET['povolenie']) && is_numeric($_GET['povolenie']) && strlen($_GET['r'])==8) {
$ret=$_GET['r'];
$povolenie=$_GET['povolenie'];

$st=$db->prepare('SELECT * FROM uzivatelia WHERE ret=:ret');
$st->bindParam(':ret',$ret);
$st->execute();
$sh=$st->fetchAll();
foreach($sh as $row);
$res=$st->rowCount();
$mail=$row['email'];
if ($res==1) {
             $sp=$db->prepare('UPDATE uzivatelia SET allowed=:povolenie WHERE ret=:ret');
             $sp->bindParam(':povolenie',$povolenie);
             $sp->bindParam(':ret',$ret);
             $sp->execute();
              if ($povolenie==0) {
                                 $body="V�en� u��vate�.Je n�m ��to, ale Va�a registr�cia na na�ej internetovej str�nke
                                 nebola povolen�.<br>D�vodom m��e by� ned�veryhodnos� Vami zadan�ch �dajov.<br>�akujeme za Va�e pochopenie.
                                 <br><br>S pozdravom Autorita s.r.o.";
                                  $st=$db->prepare('DELETE FROM uzivatelia WHERE email=:mail');
								  $st->bindParam(':mail',$mail);
								  $st->execute();
                                 }
              else { $body="V�en� u��vate�.<br>Va�a registr�cia bola povolen�.Teraz m��ete naplno vyu��va� slu�by na�ej internetovej str�nky.
				  <BR><BR>S pozdravom Autorita s.r.o."; }
                                  
              $sprava=new PHPMailer();
                                        $sprava->From= "autorita3@gmail.com";
                                        $sprava->FromName = "Autorita";
                                        $sprava->AddAddress($mail); 
                                        $sprava->CharSet = "Windows-1250";
                                        $sprava->SetLanguage("cz", "mailer/class.phpmailer.php");
                                        $sprava->Subject="Povolenie registr�cie";
                                        $sprava->IsHtml(true);
                                        $sprava->Body=$body;
             if ($sprava->send()) {
                                  echo "Oper�cia je �spe�n�";
                                  }
             else { echo "Nepodarilo sa"; }
             }
}
else {
     echo "Nie�o nieje v poriadku";
     }
?>
