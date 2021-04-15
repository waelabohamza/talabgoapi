<?php

include "../../connect.php";

$table = "categoriesfood";

$resid = $_GET['resid'] ; 

$limit = paginationLimit($_GET['page'] ?? null, 10000);

$data = getAllData($table, "categoriesfood_restaurants = '$resid'  $limit ");

createJson($data['count'], $data['values']);
