<?php

include "../../connect.php";

$table = "delivery";

$resid = superFilter($_POST['resid']);

$limit = paginationLimit($_GET['page'] ?? null, 10000);

$data  = getAllData($table, "delivery_res = '$resid'  $limit ");

createJson($data['count'], $data['values']);
