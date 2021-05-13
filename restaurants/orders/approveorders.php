<?php

include "../../connect.php";

$table = "ordersfood";

$ordersid = superFilter($_POST['ordersid']);

$data = array("ordersfood_status" => 1);

$count = updateData($table, $data, "ordersfood_id = '$ordersid' ");

countresault($count);
