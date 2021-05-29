<?php

include "../../connect.php";

$table = "restaurantsview";

$limit = paginationLimit($_GET['page'] ?? null, $countrowinpage);

$data  = getAllData($table, "restaurants_approve = 0  $limit ");

createJson($data['count'], $data['values']);
