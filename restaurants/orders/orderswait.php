<?php

include "../../connect.php";

$table = "ordersfoodview";

$resid  = superFilter($_POST['resid']);

$data  = getAllData($table, "ordersfood_res = '$resid' AND ordersfood_status = 0");

createJson($data['count'], $data['values']);