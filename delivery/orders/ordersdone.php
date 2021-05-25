<?php

include "../../connect.php";

$table = "ordersfood";

$ordersid = superFilter($_POST['ordersid']);

$userid =  superFilter($_POST['userid']);

$resid =  superFilter($_POST['resid']);


$data = array(
    "ordersfood_status" => "3"
);

$count = updateData(
    $table,
    $data,
    "ordersfood_id = '$ordersid' 
     AND ordersfood_status = 2 
  "
);

if ($count > 0) {
    $title = "هام";
    $body  =  "تم توصيل طلبلك  بنجاح";
    sendNotifySpecificUser($userid, $title, $body, "", "homeuser");
    $title = "هام";
    $body  =  "تم توصيل الطلب رقم " . $ordersid . " بنجاح ";
    sendNotifySpecificRes($resid, $title, $body, "", "Rhome");
}

countresault($count);
