<?php 

include "../../../connect.php"  ;

$rating = superFilter($_POST['rating']) ; 
$comment = superFilter($_POST['comments']) ; 
$userid = superFilter($_POST['userid']) ; 
$resid = superFilter($_POST['resid']) ; 
$ordersid = superFilter($_POST['ordersid']) ; 
$data = array(
    "rating_value" => $rating , 
    "rating_comment" => $comment , 
    "rating_userid" => $userid , 
    "rating_sid" => $resid , 
    "rating_orders" => $ordersid , 
    "rating_type" => "restaurants"
);

$count = insertData("rating" , $data); 

countresault($count) ; 


?>