<?php

include "../../connect.php";

$table = "ordersfood";

$ordersid = superFilter($_POST['ordersid']);

$deliveryid = superFilter($_POST['deliveryid']);

$userid =  superFilter($_POST['userid']) ; 


$data = array(
    "ordersfood_status" => "2",
    "ordersfood_delivery" =>  $deliveryid
);

$count = updateData($table, $data, 
  "ordersfood_id = '$ordersid' 
  AND ordersfood_status = 1 
  AND ordersfood_delivery = 0 
  AND (ordersfood_type = 'deliveryspec' OR ordersfood_type = 'delivery' )
  ");

countresault($count);
