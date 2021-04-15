<?php

include "../../connect.php";

$table = "itemsfoodview";

$resid = $_GET['resid'];
 
$and   = filterResualt($_GET['catid'] ?? null, "itemsfood_cat");

$limit = paginationLimit($_GET['page'] ?? null, 10000);

$data  = getAllData($table, "categoriesfood_restaurants = '$resid' $and $limit ");

createJson($data['count'], $data['values']);
