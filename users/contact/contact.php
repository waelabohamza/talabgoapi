<?php 

include "../../connect.php" ; 

$title      = superFilter($_POST['title']) ; 
$message    = superFilter($_POST['message']);
$userid     = superFilter($_POST['userid']) ; 
$data = array(
    "contact_title"     => $title   , 
    "contact_message"   => $message , 
    "contact_sid"       => $userid , 
    "contact_rid"       => "0" , 
    "contact_stype"     => "users", 
    "contact_rtype"     => "admin"
    ) ; 
    $count = insertData("contact" , $data) ; 
    countresault($count) ; 

?>