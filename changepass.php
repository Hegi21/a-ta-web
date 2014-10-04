<?php
if (isset($_SESSION['name'])) { $meno=$_SESSION['name']; }
include 'connect.php';
function Spravneheslo($name,$pass,$connect) {
                        $st=$connect->prepare('SELECT * FROM uzivatelia WHERE (prezyvka=:meno) AND (heslo=:heslo)');
                        $st->bindParam(':meno',$name);
                        $st->bindParam(':heslo',$pass);
                        $st->execute();
                        $res=$st->rowCount();
                        if  ($res==1) return true;
                        }
function Niecochyba ($a,$b,$c) {
                                if ($a == "" || $b == "" || $c== "")
                                return true;
                              }
$formular=true;
$vsetkospravne=true;
if (!empty($_POST)) {
                     if (isset($_POST['heslo'])) {$heslo=sha1($_POST['heslo']);}
                     if (isset($_POST['potvrdheslo'])) {$potvrdheslo=sha1($_POST['potvrdheslo']);}
                     if (isset($_POST['noveheslo'])) {$noveheslo=sha1($_POST['noveheslo']);}
                     if (Niecochyba($heslo,$potvrdheslo,$noveheslo)) { echo "<font color='red'>NieËo ste zabudli vyplniù!</font>"; $vsetkospravne=false;}
                     else {
                          if ($potvrdheslo !== $noveheslo) { echo "<font color='red'>NovÈ heslo sa a potvrdenie novÈh heslo nie su zhodnÈ!</font>"; $vsetkospravne=false;}
                          if (!Spravneheslo($meno,$heslo,$db)) { echo "<font color='red'>Nezadali ste spr·vne heslo!</font>"; $vsetkospravne=false;}
                          if ((strlen($_POST['noveheslo']))<5 || (strlen($_POST['noveheslo']))>50) { echo "<font color='red'>Heslo musÌ obsahovaù aspon 5 a maxim·lne 50 znakov"; $vsetkospravne=false;}                           
                          }                           
if ($vsetkospravne) {
                    $formular=false;
                    $st=$db->prepare('UPDATE uzivatelia SET heslo=:noveheslo WHERE prezyvka=:meno');
                    $st->bindParam(':meno',$meno);
                    $st->bindParam(':noveheslo',$noveheslo);
                    $st->execute()
                    or die("Nepodarilo sa zmeniù heslo");
                    echo "Heslo bolo ˙speöne zmenenÈ";
                    }              
                    }                                                                                                   
if ($formular) :?> 

<form action="zmenahesla.php" method="post">
<table cellspacing=10px>
<tr>  
<td>Heslo:</td><td><input type="text" name="heslo"></td>
</tr>
<tr>  
<td>NovÈ heslo:</td><td><input type="password" name="noveheslo" ></td>
</tr>
<tr>  
<td>PotvrÔte novÈ heslo:</td><td><input type="password" name="potvrdheslo"></td>
</tr>
</table>
<br>
<div class="tlacitkoreg"><input type="submit" value="Potvrdiù"></div>
</form>
<?php endif;?>