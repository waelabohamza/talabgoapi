<?php

include "../../../connect.php";

$table = "categoriesfoodview";

$limit = paginationLimit($_GET['page'] ?? null, 100);

$resid = superFilter($_POST['resid']);

$data  = getAllData($table, "categoriesfood_restaurants = '$resid'    $limit ");

createJson($data['count'], $data['values']);
