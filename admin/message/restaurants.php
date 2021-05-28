<?php 

include "../../connect.php" ; 

$resid = superFilter($_POST['id']);  

$title = superFilter($_POST['title']) ; 

$body = superFilter($_POST['body']); 

sendNotifySpecificUser($resid , $title , $body , "" , "");
successCount() ; 