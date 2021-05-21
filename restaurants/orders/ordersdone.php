<?php

include "../../connect.php";  
  
$table = "ordersfood";

// Request
$ordersid = superFilter($_POST['ordersid']);
 

// ================
$data = array("ordersfood_status" => 3);

$count = updateData($table, $data, "ordersfood_id = '$ordersid' ");

if ($count > 0){
    $title = "هام";
    $body  =  "تم تسليم الطلبية  بنجاح "; 
    sendNotifySpecificUser($userid, $title, $body, "", "");
    sendNotifySpecificRes($resid, $title, $body, "", "");
}

countresault($count);
