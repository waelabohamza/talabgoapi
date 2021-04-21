<?php
include "../../connect.php";
$table = "itemsfoodview";
$data = json_decode(file_get_contents('php://input'), true);
$search = superFilter($data['search']);
$resid =  superFilter($data['datasearch']['resid']);
if (isset($_POST['catid']) && $_POST['catid'] == "all") {
    $and = null;
} else {
    $and   = filterResualt($_POST['catid'] ?? null, "itemsfood_cat");
}
$limit = paginationLimit($_GET['page'] ?? null, 100);
$data  = getAllData($table, "categoriesfood_restaurants = '$resid' And ( itemsfood_name LIKE '%$search%' OR itemsfood_name_ar LIKE '%$search%')  $and $limit ");
createJson($data['count'], $data['values']);
