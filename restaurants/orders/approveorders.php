<?php

include "../../connect.php";  
  
$table = "ordersfood";

// Request
$ordersid = superFilter($_POST['ordersid']);
$userid  = superFilter($_POST['userid']);
$resid  = superFilter($_POST['resid']);

// ================
$data = array("ordersfood_status" => 1);

$count = updateData($table, $data, "ordersfood_id = '$ordersid' ");

if ($count > 0){
    $title = "هام";
    $body  =  "تم الموافقة عل طلبك بنجاح ";
    sendNotifySpecificUser($userid, $title, $body, "", "ordersfoodscreenptwo");
    $title = "هام";
    $body  =  "تم الموافقة على طلب  الزبون";
    sendNotifySpecificRes($resid, $title, $body, "", "Rordersfoodscreentwo");
}

countresault($count);
