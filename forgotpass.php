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
                    if ($mail=="")  { echo "<font color='red'>Nezadali ste Vašu e-mailovú adresu!</font>"; $vsetkospravne=false; }
                    else { 
                         if (!Jemail($mail)) { echo "<font color='red'>Nieje zadanı platnı mail!</font>"; $vsetkospravne=false; }               
                         if (!Mailindb($mail,$db)) { echo "<font color='red'>Zadanı e-mail sa nenachádza v našej databáze</font>"; $vsetkospravne=false; }
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
                                        $sprava->Subject="Zabudnuté heslo";
                                        $sprava->Body="Dobrı deò.<br>Zabudli ste Vaše heslo na našej webovej stránke?Z dôvodu bezpeènosti máme Vaše heslo uloené v databáze
                                        v zašifrovanej forme a nemôeme Vám ho poskytnú.Ak máte záujem o vygenerovanie nového hesla kliknite na odkaz
                                         uvedenı nišie.Ak sa tak rozhodnete, bude Vám zaslaná správa s novım heslo  túto e-mailovú adresu.<br>
                                       <a  href='http://tomas.omfg.sk/newpass.php?s=$ret'>generovanie nového hesla</a> <br>";
                                        
                                        if   ($sprava->send()) {
                                                                 echo "Na Vašu e-mailovú adresu bolo zaslané nové heslo";         
                                                               }
                                        else {
                                              echo "Nastala chyba pri zasielaní e-mailu";
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
<div class="tlacitkoreg"><input type="submit" value="Potvrdi"></div>
</form>
<?php endif;?>
