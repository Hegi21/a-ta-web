<?php
//debug
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

//mysql config
define ('db_user','tomas');
define ('db_pass','lojzo94071190180');

try{
	$db = new PDO("mysql:host=localhost;dbname=tomas",db_user,db_pass);
} 
catch(PDOException $e){
	echo "ERROR: ".$e->getMessage();
}

?>