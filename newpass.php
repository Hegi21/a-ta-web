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
               echo "Zadan� link u� nieje platn�";  
               }
else {
                          if (isset($sp['email'])) { $mail=$sp['email']; }
                          $heslo=randomPassword(8);
                          
                          $sprava=new PHPMailer();
                          $sprava->SetFrom('t.hegi@azet.sk', 'Autorita');
                          $sprava->AddReplyTo("t.hegi@azet.sk","Autorita");
                          $sprava->AddAddress($mail); 
                          $sprava->CharSet= "Windows-1250";
                          $sprava->Subject="Gener�cia hesla";                                       
                          $sprava->IsHtml(true);
                          $sprava->Body="Dobr� de�.Po�iadali ste o vygenerovanie nov�ho hesla.<br>
                          Va�e nov� heslo je:$heslo <br>
                          Teraz sa m��ete s Va�im nov�m heslom prihl�si�.Odpor��ame V�m si toto heslo zmeni� hne� po prihl�sen�.";
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