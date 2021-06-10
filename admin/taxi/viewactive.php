<?php

include "../../connect.php";

$table = "taxiview";

$limit = paginationLimit($_GET['page'] ?? null, $countrowinpage);

$data  = getAllData($table, "taxi_approve = 1 $limit");

createJson($data['count'], $data['values']);
