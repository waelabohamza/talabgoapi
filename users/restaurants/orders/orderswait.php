<?php

include "../../../connect.php";

$table = "ordersfoodview";

$userid  = superFilter($_POST['userid']);

$data  = getAllData($table, "ordersfood_users = '$userid' ");

createJson($data['count'], $data['values']);
