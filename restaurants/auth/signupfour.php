<?php

include "../../connect.php";

$data = json_decode(file_get_contents('php://input'), true);


$deliveryways = $data['deliveryways'];
$email        = $data['email'];

// GetId 
$stmt = getData("restaurants", "restaurants_email", $email);

if ($stmt['count'] > 0) {

    $resid = $stmt['values']['restaurants_id'];

    foreach ($deliveryways as $val) {
        $data = array("rdtw_res" => $resid, "rdtw_deliveryways" => $val);
        $count =  insertData("rdtw", $data);
    }
    $title = "هام"  ; 
    $body = "يوجد مطعم بانتظار الموافقة"  ; 
    sendGCM($title , $body , "" , "" , "" , "admin") ; 

    countresault($count);
} else {

    failCount();
}
