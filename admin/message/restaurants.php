<?php 

include "../../connect.php" ; 

$resid = superFilter($_POST['id']);  

$title = superFilter($_POST['title']) ; 

$body = superFilter($_POST['body']); 

sendNotifySpecificRes($resid , $title , $body , "" , "");

successCount() ; 