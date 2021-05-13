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

if ($count > 0) {
    $title = "هام";
    $body  =  "تم الطلب بنجاح الرجاء انتظار موافقة المطعم";
    sendNotifySpecificUser($userid, $title, $body, "", "usersordersfoods1");
    $title = "هام";
    $body  =  "يوجد طلب بانتظار الموافقة";
    sendNotifySpecificRes($resid, $title, $body, "", "resordersfoods1");
}

countresault($count);
