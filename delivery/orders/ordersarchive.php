<?php

include "../../connect.php";

$table = "ordersfoodview";

$resid  = superFilter($_POST['resid']);

$data  = getAllData($table, "ordersfood_res = '$resid' AND ordersfood_status = 3  
                     AND (ordersfood_type = 'deliveryspec' OR ordersfood_type = 'delivery' ) ");

createJson($data['count'], $data['values']);
