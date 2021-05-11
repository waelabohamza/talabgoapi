<?php

include "../../../connect.php";

$table = "ordersfood";

$limit = paginationLimit($_GET['page'] ?? null, 1000);

$resid  = superFilter($_POST['resid']);



$data  = getAllData($table, "categoriesfood_restaurants = '$resid'  $and $limit ");

createJson($data['count'], $data['values']);
