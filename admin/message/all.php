<?php 

include "../../connect.php" ; 

$type = superFilter($_POST['type']) ; 

$title = superFilter($_POST['title']); 

$body = superFilter($_POST['body']); 

