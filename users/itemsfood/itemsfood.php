<?php

include "../../connect.php";

$table = "itemsfoodview";

$limit = paginationLimit($_GET['page'] ?? null, 1000);

$resid  = superFilter($_POSt['resid']);

if (isset($_POST['categories']) && $_POST['categories'] == "all") {
    $and = null;
} else {
    $and   = filterResualt($_POST['categories'] ?? null, "categoriesfood_id");
}

$data  = getAllData($table, "categoriesfood_restaurants = '$resid'  $and $limit ");

createJson($data['count'], $data['values']);
