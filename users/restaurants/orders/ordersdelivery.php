<?php

include "../../../connect.php";

$table = "ordersfoodview";

$userid  = superFilter($_POST['userid']);

$data  = getAllData($table, "ordersfood_users = '$userid' AND ordersfood_status = 1");

createJson($data['count'], $data['values']);
