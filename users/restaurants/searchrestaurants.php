<?php

include "../../connect.php";

$table = "restaurantsview";
$data = json_decode(file_get_contents('php://input'), true);
$search = superFilter($data['search']);
// $limit = paginationLimit($_GET['page'] ?? null, $countrowinpage);

$data  = getAllData($table, "restaurants_name  LIKE '%$search%' LIMIT 10 ");

createJson($data['count'], $data['values']);
