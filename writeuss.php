<?php
include 'connect.php';
require("mailer/class.phpmailer.php");
                        
						$st=$db->prepare('SELECT * FROM uzivatelia WHERE (prezyvka=:meno)');
                        $st->bindParam(':meno',$meno);
                        $st->execute();
                        $sp=$st->fetchAll();
                        foreach($sp as $res)  
                        $email=$res['email']; 
                        $meno=$res['meno'];
                        $priezvisko=$res['priezvisko'];
$formular=true;
$vsetkospravne=true;
if (!empty($_POST)) {
                     if (isset($_POST['predmet'])) {$predmet=$_POST['predmet'];}
                     if (isset($_POST['sprava'])) {$text=$_POST['sprava'];}
                     if($predmet=="") { echo"<font color='red'>Nevyplnili ste predmet správy!</font><BR>"; $vsetkospravne=false;}                          
					 if($text=="") { echo"<font color='red'>Nevyplnili ste text správy!</font>"; $vsetkospravne=false;}
if ($vsetkospravne) {
                    $formular=false;
                                        
                                        $sprava=new PHPMailer();
                                        $sprava->From= $email;
                                        $sprava->AddAddress("autorita3@gmail.com"); 
                                        $sprava->Subject="Autorita.sk- $predmet";
                                        $sprava->CharSet="Windows-1250";
                                        $sprava->IsHtml(true);
                                        $sprava->Body= "Obdržali ste správu zo stránky Autorita.sk<br> Píše Vám používate¾
                                        <br><br>Meno:$meno<br><br>
                                        Priezvisko:$priezvisko<br><br>
                                        Správa:$text";
                  
if ($sprava->send()) {                                        
echo "Vaša správa bola odoslaná.<BR>Odpoveï oèakávajte na Vašej zaregistrovanej e-mailovej adrese najneskôr do 24 hodín.<BR>Ïakujeme.";
}
else { echo "Správu sa nepodarilo odosla" .$sprava->errorInfo; }
}                    
            }                                                                                                  
if ($formular) :?> 

<form action="napistenam.php" method="post">
<table cellspacing=10px>
<tr>  
<td>Predmet:</td><td><input type="text" name="predmet"></td>
</tr>
<tr>  
<td>Správa:</td><td><textarea name="sprava" cols=10 rows=10></textarea></td>
</tr>
</table>
<br>
<div class="tlacitkoreg"><input type="submit" value="Odosla"></div>
</form>
<?php endif;?>
