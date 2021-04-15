<?php

include "../../connect.php";

$table = "categories";

$resid = $_POST['resid'] ; 

$limit = paginationLimit($_GET['page'] ?? null, 10000);

$data = getAllData($table, "categories_restaurants = '$resid'  $limit ");

createJson($data['count'], $data['values']);
