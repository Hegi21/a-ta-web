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
                     if (Niecochyba($heslo,$potvrdheslo,$noveheslo)) { echo "<font color='red'>Nie�o ste zabudli vyplni�!</font>"; $vsetkospravne=false;}
                     else {
                          if ($potvrdheslo !== $noveheslo) { echo "<font color='red'>Nov� heslo sa a potvrdenie nov�h heslo nie su zhodn�!</font>"; $vsetkospravne=false;}
                          if (!Spravneheslo($meno,$heslo,$db)) { echo "<font color='red'>Nezadali ste spr�vne heslo!</font>"; $vsetkospravne=false;}
                          if ((strlen($_POST['noveheslo']))<5 || (strlen($_POST['noveheslo']))>50) { echo "<font color='red'>Heslo mus� obsahova� aspon 5 a maxim�lne 50 znakov"; $vsetkospravne=false;}                           
                          }                           
if ($vsetkospravne) {
                    $formular=false;
                    $st=$db->prepare('UPDATE uzivatelia SET heslo=:noveheslo WHERE prezyvka=:meno');
                    $st->bindParam(':meno',$meno);
                    $st->bindParam(':noveheslo',$noveheslo);
                    $st->execute()
                    or die("Nepodarilo sa zmeni� heslo");
                    echo "Heslo bolo �spe�ne zmenen�";
                    }              
                    }                                                                                                   
if ($formular) :?> 

<form action="zmenahesla.php" method="post">
<table cellspacing=10px>
<tr>  
<td>Heslo:</td><td><input type="text" name="heslo"></td>
</tr>
<tr>  
<td>Nov� heslo:</td><td><input type="password" name="noveheslo" ></td>
</tr>
<tr>  
<td>Potvr�te nov� heslo:</td><td><input type="password" name="potvrdheslo"></td>
</tr>
</table>
<br>
<div class="tlacitkoreg"><input type="submit" value="Potvrdi�"></div>
</form>
<?php endif;?>