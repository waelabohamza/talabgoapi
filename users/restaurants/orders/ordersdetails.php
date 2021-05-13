<?php

include "../../../connect.php";

$table = "ordersfooddetailsview";

$ordersid  = superFilter($_POST['ordersid']);

$data  = getAllData($table, "ordersfood_id = '$ordersid'");

createJson($data['count'], $data['values']);
