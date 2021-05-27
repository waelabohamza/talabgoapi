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



  $stmt2 = $con->prepare("SELECT tokens.* FROM tokens 
  INNER JOIN delivery ON delivery.delivery_id = tokens.tokens_sid 
  WHERE tokens_sid != ? AND tokens_type = 'delivery' AND delivery.delivery_res = ?
   -- الفكرة الاشخاص يلي بيشتغلو دليفري عن المطعم
   ");
  $stmt2->execute(array($deliveryid, $resid));
  $delivers = $stmt2->fetchAll(PDO::FETCH_ASSOC);
  foreach ($delivers as $delivery) {
    $token = $delivery['tokens_token'];
    $title = "TalabGoDelivery";
    $message =  "تم استلام الطلبية رقم  "  . $ordersid . " من قبل عامل توصيل اخر  ";
    sendGCM($title, $message,  $token, "id", "Dordersscreen");
    //
  }
}

countresault($count);
