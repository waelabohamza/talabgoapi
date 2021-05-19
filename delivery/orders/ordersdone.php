<?php

include "../../connect.php";

$table = "ordersfood";

$ordersid = superFilter($_POST['ordersid']);


$data = array(
    "ordersfood_status" => "3"
);

$count = updateData(
    $table,
    $data,
    "ordersfood_id = '$ordersid' 
     AND ordersfood_status = 2 
  "
);

countresault($count);
