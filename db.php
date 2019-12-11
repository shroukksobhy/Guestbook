<?php
try{
	$db = new PDO('mysql:host=localhost;dbname=guestbook;','root','');

}
catch(PDOException $e){
	echo "error:".$e->getMessge();
}
?>