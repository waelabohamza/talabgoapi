<?php 

include "../../../connect.php"  ;

$rating = superFilter($_POST['rating']) ; 
$comment = superFilter($_POST['comments']) ; 
$userid = superFilter($_POST['userid']) ; 
$resid = superFilter($_POST['resid']) ; 
$ordersid = superFilter($_POST['ordersid']) ; 
$data = array(
    ""
);



?>