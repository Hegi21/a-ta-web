<?php
require("mailer/class.phpmailer.php");
include "connect.php";
function Jemail ($cislo){
                         return preg_match("/^.+@.+\.[a-zA-Z]+$/",$cislo);
                        }

function Mailindb ($cislo,$connect) {
                            $st=$connect->prepare('SELECT * FROM uzivatelia WHERE email=:email');
                            $st->bindParam(':email',$cislo);
                            $st->execute();
                            $res=$st->rowCount();
                            if ($res>0) return true;
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
$ret=retazec(8);
if (!empty($_POST)) {
                    if (isset($_POST['email'])) { $mail = $_POST['email']; }
                    if ($mail=="")  { echo "<font color='red'>Nezadali ste Va�u e-mailov� adresu!</font>"; $vsetkospravne=false; }
                    else { 
                         if (!Jemail($mail)) { echo "<font color='red'>Nieje zadan� platn� mail!</font>"; $vsetkospravne=false; }               
                         if (!Mailindb($mail,$db)) { echo "<font color='red'>Zadan� e-mail sa nenach�dza v na�ej datab�ze</font>"; $vsetkospravne=false; }
                         }
                        $sp=$db->prepare('UPDATE uzivatelia SET ret=:ret WHERE email=:email');
                        $sp->bindParam(':email',$mail);           
                        $sp->bindParam(':ret',$ret);
                        $sp->execute();                                                  
                      if ($vsetkospravne) {
                                        $formular=false;

                                        $sprava=new PHPMailer();
                                        $sprava->IsHtml(true);
                                         $sprava->SetFrom('t.hegi@azet.sk', 'Autorita');
                                         $sprava->AddReplyTo("t.hegi@azet.sk","Autorita");
                                        $sprava->CharSet= "Windows-1250";
                                        $sprava->AddAddress($mail); 
                                        $sprava->Subject="Zabudnut� heslo";
                                        $sprava->Body="Dobr� de�.<br>Zabudli ste Va�e heslo na na�ej webovej str�nke?Z d�vodu bezpe�nosti m�me Va�e heslo ulo�en� v datab�ze
                                        v za�ifrovanej forme a nem��eme V�m ho poskytn��.Ak m�te z�ujem o vygenerovanie nov�ho hesla kliknite na odkaz
                                         uveden� ni��ie.Ak sa tak rozhodnete, bude V�m zaslan� spr�va s nov�m heslo  t�to e-mailov� adresu.<br>
                                       <a  href='http://tomas.omfg.sk/newpass.php?s=$ret'>generovanie nov�ho hesla</a> <br>";
                                        
                                        if   ($sprava->send()) {
                                                                 echo "Na Va�u e-mailov� adresu bolo zaslan� nov� heslo";         
                                                               }
                                        else {
                                              echo "Nastala chyba pri zasielan� e-mailu";
                                             }
                                        }
                                        }   
if ($formular) :?> 

<form action="zabudnuteheslo.php" method="post">
<table cellspacing=10px>
<tr> 
<td>E-mail:</td><td><input type="text" name="email"></td>
</tr>
</table>
<br>
<div class="tlacitkoreg"><input type="submit" value="Potvrdi�"></div>
</form>
<?php endif;?>
