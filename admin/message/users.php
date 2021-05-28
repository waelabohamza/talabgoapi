<?php 

include "../../connect.php" ; 

$userid = superFilter($_POST['id']);  

$title = superFilter($_POST['title']) ; 

$body = superFilter($_POST['body']) ; 

sendNotifySpecificUser($userid , $title , $body , "" , "");