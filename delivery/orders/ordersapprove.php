<?php

include "../../connect.php";

$table = "ordersfood";

$ordersid = superFilter($_POST['ordersid']);

$deliveryid = superFilter($_POST['deliveryid']);

$userid =  superFilter($_POST['userid']);

$resid =  superFilter($_POST['resid']);


$data = array(
  "ordersfood_status" => "2",
  "ordersfood_delivery" =>  $deliveryid
);

$count = updateData(
  $table,
  $data,
  "ordersfood_id = '$ordersid' 
  AND ordersfood_status = 1 
  AND ordersfood_delivery = 0 
  AND (ordersfood_type = 'deliveryspec' OR ordersfood_type = 'delivery' )
  "
);

if ($count > 0) {
  $title = "هام";
  $body  =  "تم تحضير طلبلك والان الطلب على الطريق";
  sendNotifySpecificUser($userid, $title, $body, "", "ordersfoodscreenthree");
  $title = "هام";
  $body  =  "تم الموافقة على الطلب  من قبل عامل التوصيل والان الطلب على الطريق";
  sendNotifySpecificRes($resid, $title, $body, "", "Rordersfoodscreenthree");
}

countresault($count);
