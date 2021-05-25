<?php

include "../../connect.php";

$table = "ordersfood";

// Request
$ordersid = superFilter($_POST['ordersid']);
$userid  = superFilter($_POST['userid']);
$resid  = superFilter($_POST['resid']);

// ================
$data = array("ordersfood_status" => 3);

$count = updateData($table, $data, "ordersfood_id = '$ordersid' ");

if ($count > 0) {
    $title = "هام";
    $body  =  "شكرا لزيارتك مطعمنا نتمنى ان تكون الوجبة نالت على اعجابكم ";
    sendNotifySpecificUser($userid, $title, $body, "", "homeuser");
    $title = "هام";
    $body  =  "تم ااغلاف  الطاولة  بنجاح";
    sendNotifySpecificRes($resid, $title, $body, "", "Rhome");
}

countresault($count);
