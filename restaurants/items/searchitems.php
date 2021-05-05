<?php
include "../../connect.php";
$table = "itemsfoodview";
$data = json_decode(file_get_contents('php://input'), true);
$search = superFilter($data['search']);
$resid =  superFilter($data['datasearch']['resid']);
$limit = paginationLimit($_GET['page'] ?? null, 100);
$data  = getAllData($table, "categoriesfood_restaurants = '$resid' And ( itemsfood_name LIKE '%$search%' OR itemsfood_name_ar LIKE '%$search%')    $limit ");
createJson($data['count'], $data['values']);
