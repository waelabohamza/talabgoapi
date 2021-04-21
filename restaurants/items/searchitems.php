<?php
include "../../connect.php";
$table = "itemsfoodview";
$search = superFilter($_POST['search']);
$resid = $_POST['resid'];
if (isset($_POST['catid']) && $_POST['catid'] == "all") {
    $and = null;
} else {
    $and   = filterResualt($_POST['catid'] ?? null, "itemsfood_cat");
}
$limit = paginationLimit($_GET['page'] ?? null, 100);
$data  = getAllData($table, "categoriesfood_restaurants = '$resid' And ( itemsfood_name LIKE '%$search%' OR itemsfood_name_ar LIKE '%$search%')  $and $limit ");
createJson($data['count'], $data['values']);
