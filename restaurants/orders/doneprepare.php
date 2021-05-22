<?php

include "../../connect.php";

$table = "ordersfood";

// Request
$ordersid = superFilter($_POST['ordersid']);
$userid  = superFilter($_POST['userid']);
$resid  = superFilter($_POST['resid']);
$typeorders = superFilter($_POST['orderstype']);

// ================

if () {

}else {

}

$data = array("ordersfood_status" => 2);

$count = updateData($table, $data, "ordersfood_id = '$ordersid' ");

if ($count > 0) {
    $title = "هام";
    $body  =  "تم الانتهاء من تحضير الوجبة ";
    sendNotifySpecificUser($userid, $title, $body, "", "ordersfoodscreenptwo");
    $title = "هام";
    $body  =  "تم الانتهاء من تحضير الوجبة ";
    sendNotifySpecificRes($resid, $title, $body, "", "Rordersfoodscreentwo");
}

countresault($count);
