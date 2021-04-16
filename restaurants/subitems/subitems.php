<?php

include "../../connect.php";

$table = "subitemsfoodview";

$itemsid = $_POST['itemsid'] ;  

$limit = paginationLimit($_GET['page'] ?? null, 10000);

$data  = getAllData($table, "subitemsfood_items = '$itemsid'  $limit ");

createJson($data['count'], $data['values']);
