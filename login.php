<?php
include ('connect.php');
if (!empty($_POST)) {
if (isset($_POST['meno'])) { 
$meno = $_POST['meno'];
}
if (isset($_POST['heslo'])) {
$postheslo = sha1($_POST['heslo']);
}
$st = $db->prepare('SELECT * FROM uzivatelia WHERE (prezyvka=:meno)');
$st->execute(array(':meno'=>$meno));
$sp=$st->rowCount();
if ($sp==1) {
            $sh=$db->prepare('SELECT * FROM uzivatelia WHERE (prezyvka=:meno)');
            $sh->execute(array(':meno'=>$meno));
            $res=$sh->fetchAll();
            foreach($res as $row);
            if (isset($row['heslo'])) { $heslo=$row['heslo']; }
            if (isset($row['count'])) { $count=$row['count']; }
            if (isset($row['allowed'])) { $allowed=$row['allowed']; }
            if (isset($row['datum'])) { $datum=$row['datum']; }
            $now=strtotime("now"); 
         
            if (($count<6) && ($now-$datum>"10 minute")) {
                          if ($heslo==$postheslo) {
                                                  $count=0;
                                                  $reset=$db->prepare('UPDATE uzivatelia SET count=:count WHERE (prezyvka=:meno)');
                                                  $reset->execute(array(':meno'=>$meno,':count'=>$count));
                                                  if ($allowed==1) {
                                                                    $_SESSION['logged']=true;
                                                                    $_SESSION['name']=$meno;
                                                                    Header('Location:index.php');
                                                                  }
                                                  else {
                                                       echo "Vaša registrácia nieje schválená administrátorom";
                                                       }
                                                  }  
                          else {
                               $pripocitaj=$db->prepare('UPDATE uzivatelia SET count=count+1 WHERE (prezyvka=:meno)');
                               $pripocitaj->bindParam(':meno',$meno);
                               $pripocitaj->execute();
                               echo "Zadali ste neplatné heslo";
                              }
                          }
          else {
               $count=0;
               $datum=strtotime("+10 minute");
               $zmenadat=$db->prepare('UPDATE uzivatelia SET datum=:datum,count=:count WHERE (prezyvka=:meno)');
                               $zmenadat->bindParam(':datum',$datum);
                               $zmenadat->bindParam(':count',$count);
                               $zmenadat->bindParam(':meno',$meno);
                               $zmenadat->execute();
               echo "Nieko¾krát za sebou ste zadali neplatné heslo.Musíte poèka do " .date('H:i',$datum);
               }  
            } 
else {
     echo "Zadané prihlasovacie meno neexistuje!";
     }
     }
?>
<form action="prihlasenie.php" method="post">
<table cellspacing=10px>
<tr>  
<td>Meno:</td><td><input type="text" name="meno"></td>
</tr>
<tr>  
<td>Heslo:</td><td><input type="password" name="heslo"></td>
</tr>
</table>
<div class="tlacitkoreg"><input type="submit" value="Prihlási"></div>
</form>

