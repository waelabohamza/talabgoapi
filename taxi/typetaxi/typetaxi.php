<?php

include "../../connect.php";

$table = "typetaxi";

$limit = paginationLimit($_GET['page'] ?? null, 10000);

$data = getAllData($table, "1 = 1  $limit ");

createJson($data['count'], $data['values']);
