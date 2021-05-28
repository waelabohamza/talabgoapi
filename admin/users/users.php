<?php

include "../../connect.php";

$table = "users";

$limit = paginationLimit($_GET['page'] ?? null, $countrowinpage);

$data  = getAllData($table, "1 = 1    $limit ");

createJson($data['count'], $data['values']);
