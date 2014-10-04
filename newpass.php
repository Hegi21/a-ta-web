<?php
require("mailer/class.phpmailer.php");
include "connect.php";
function randomPassword($dlzka) {
                          $mozne_znaky = 'abcdefghijklmnopqrstuvwxyz123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                          $vystup = '';
                          $pocet_moznych_znakov = strlen($mozne_znaky);
                          for ($i=0;$i<$dlzka;$i++) {
                            $vystup .= $mozne_znaky[mt_rand(0,$pocet_moznych_znakov - 1)];
                          }
                          return $vystup;
                          }

if (isset($_GET['s']) && strlen($_GET['s'])==8) { $ret=$_GET['s']; }
$st=$db->prepare('SELECT email FROM uzivatelia WHERE ret=:ret');
$st->bindParam(':ret',$ret);
$st->execute();
$sp=$st->fetch();
$count=$st->rowCount();
if ($count !==1) {
               echo "Zadaný link už nieje platný";  
               }
else {
                          if (isset($sp['email'])) { $mail=$sp['email']; }
                          $heslo=randomPassword(8);
                          
                          $sprava=new PHPMailer();
                          $sprava->SetFrom('t.hegi@azet.sk', 'Autorita');
                          $sprava->AddReplyTo("t.hegi@azet.sk","Autorita");
                          $sprava->AddAddress($mail); 
                          $sprava->CharSet= "Windows-1250";
                          $sprava->Subject="Generácia hesla";                                       
                          $sprava->IsHtml(true);
                          $sprava->Body="Dobrý deò.Požiadali ste o vygenerovanie nového hesla.<br>
                          Vaše nové heslo je:$heslo <br>
                          Teraz sa môžete s Vašim novým heslom prihlási.Odporúèame Vám si toto heslo zmeni hneï po prihlásení.";
                          $newret="";
                          if ($sprava->send()) {
                                               $sh=$db->prepare('UPDATE uzivatelia SET heslo=:heslo,ret=:newret WHERE ret=:ret');
                                               $sh->bindParam(':heslo',sha1($heslo));
                                               $sh->bindParam(':ret',$ret);
                                               $sh->bindParam(':newret',$newret);
                                               $sh->execute();
                                               }  
     }
?>