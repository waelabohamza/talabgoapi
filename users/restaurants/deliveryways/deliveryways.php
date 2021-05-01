<?php

include "../../../connect.php";

$table = "deliverywaysview";

$resid  = superFilter($_POST['resid']);

$data  = getAllData($table, "rdtw_res = '$resid'");

createJson($data['count'], $data['values']);
