<?php

include "../../connect.php";

$table = "ordersfood";

// Request
$ordersid = superFilter($_POST['ordersid']);
$userid  = superFilter($_POST['userid']);
$resid  = superFilter($_POST['resid']);
$typeorders = superFilter($_POST['orderstype']);

// ================

if ($typeorders == "tableqrcode") {
    $data = array("ordersfood_status" => 2);
} else {
    $data = array("ordersfood_status" => 3);
}


$count = updateData($table, $data, "ordersfood_id = '$ordersid' ");

if ($count > 0) {
    $title = "هام";
    $body  =  "تم الانتهاء من تحضير الوجبة ";
    if ($typeorders == "tableqrcode") {
        sendNotifySpecificUser($userid, $title, $body, "", "ordersfoodscreenthree");
    } else {
        sendNotifySpecificUser($userid, $title, $body, "", "homeuser");
    }
    $title = "هام";
    $body  =  "تم الانتهاء من تحضير الوجبة ";
    sendNotifySpecificRes($resid, $title, $body, "", "Rordersfoodscreentwo");
}

countresault($count);
