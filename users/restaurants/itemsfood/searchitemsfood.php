<?php

include "../../../connect.php";

$table = "itemsfoodview";

$data = json_decode(file_get_contents('php://input'), true);

$search = superFilter($data['search']);

$resid =  superFilter($data['datasearch']['resid']);

$data  = getAllData($table, "categoriesfood_restaurants = '$resid' LIMIT 10 ");

createJson($data['count'], $data['values']);
