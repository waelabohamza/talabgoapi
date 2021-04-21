<?php

include "../../connect.php";

$table = "itemsfoodview";

$resid = $_POST['resid'];
if (isset($_POST['catid']) && $_POST['catid'] == "all") {
    $and = null;
} else {
    $and   = filterResualt($_POST['catid'] ?? null, "itemsfood_cat");
}

$limit = paginationLimit($_GET['page'] ?? null, $countrowinpage);

$data  = getAllData($table, "categoriesfood_restaurants = '$resid' $and $limit ");

createJson($data['count'], $data['values']);
