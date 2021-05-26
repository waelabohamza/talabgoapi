<?php

include "../../connect.php";  
  
$table = "ordersfood";

// Request
$ordersid = superFilter($_POST['ordersid']);
$userid  = superFilter($_POST['userid']);
$resid  = superFilter($_POST['resid']);
$orderstype = superFilter($_POST['orderstype']);



// ================
$data = array("ordersfood_status" => 1);

$count = updateData($table, $data, "ordersfood_id = '$ordersid' ");

if ($count > 0){
    $title = "هام";
    $body  =  "تم الموافقة عل طلبك بنجاح "; 
    sendNotifySpecificUser($userid, $title, $body, "", "ordersfoodscreenptwo");
    $title = "هام";
    $body  =  "تم الموافقة على طلب  بنجاح والان الطلب بانتظار موافقة عامل التوصيل";
    sendNotifySpecificRes($resid, $title, $body, "", "");
    if ($orderstype == "delivery" || $orderstype == "deliveryspec"){
        $title = "هام";
        $body  =  "يوجد طلب بانتظار الموافقة"; 
    }
}

countresault($count);
