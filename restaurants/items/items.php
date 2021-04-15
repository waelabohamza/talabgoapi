<?php

include "../../connect.php";

$table = "itemsfoodview";

$resid = $_GET['resid'] ; 

$limit = paginationLimit($_GET['page'] ?? null, 10000);

$data = getAllData($table, "categoriesfood_restaurants = '$resid' $limit ");

createJson($data['count'], $data['values']);

//categoriesfood_restaurants = '$resid' 