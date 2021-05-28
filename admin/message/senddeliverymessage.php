<?php 

include "../../connect.php" ; 

$deliveryid = superFilter($_POST['id']);  

$title = superFilter($_POST['title']) ; 

$body = superFilter($_POST['body']); 

sendNotifySpecificUser($deliveryid , $title , $body , "" , "");