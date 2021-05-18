<?php

include "../../connect.php";

$table = "ordersdetailsview";

$ordersid  = superFilter($_POST['ordersid']);

$data  = getAllData($table, "ordersfood_id = '$ordersid'");

createJson($data['count'], $data['values']);
