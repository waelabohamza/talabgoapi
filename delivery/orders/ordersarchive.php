<?php

include "../../connect.php";

$table = "ordersfoodview";

$deliveryid  = superFilter($_POST['deliveryid']);

$data  = getAllData($table, "ordersfood_delivery = '$deliveryid' AND ordersfood_status = 3  
                     AND (ordersfood_type = 'deliveryspec' OR ordersfood_type = 'delivery' ) ");

createJson($data['count'], $data['values']);
