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
                                 $body="Váenı uívate¾.Je nám ¾úto, ale Vaša registrácia na našej internetovej stránke
                                 nebola povolená.<br>Dôvodom môe by nedôveryhodnos Vami zadanıch údajov.<br>Ïakujeme za Vaše pochopenie.
                                 <br><br>S pozdravom Autorita s.r.o.";
                                  $st=$db->prepare('DELETE FROM uzivatelia WHERE email=:mail');
								  $st->bindParam(':mail',$mail);
								  $st->execute();
                                 }
              else { $body="Váenı uívate¾.<br>Vaša registrácia bola povolená.Teraz môete naplno vyuíva sluby našej internetovej stránky.
				  <BR><BR>S pozdravom Autorita s.r.o."; }
                                  
              $sprava=new PHPMailer();
                                        $sprava->From= "autorita3@gmail.com";
                                        $sprava->FromName = "Autorita";
                                        $sprava->AddAddress($mail); 
                                        $sprava->CharSet = "Windows-1250";
                                        $sprava->SetLanguage("cz", "mailer/class.phpmailer.php");
                                        $sprava->Subject="Povolenie registrácie";
                                        $sprava->IsHtml(true);
                                        $sprava->Body=$body;
             if ($sprava->send()) {
                                  echo "Operácia je úspešná";
                                  }
             else { echo "Nepodarilo sa"; }
             }
}
else {
     echo "Nieèo nieje v poriadku";
     }
?>
