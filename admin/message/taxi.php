<?php 

include "../../connect.php" ; 

$taxiid = superFilter($_POST['id']);  

$title = superFilter($_POST['title']) ; 

$body = superFilter($_POST['body']); 

sendNotifySpecificTaxi($taxiid , $title , $body , "" , "");

successCount() ; 