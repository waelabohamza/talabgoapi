<?php

include "../../connect.php";

$table = "restaurantsview";

$resid = $_POST['resid'];

$limit = paginationLimit($_GET['page'] ?? null, $countrowinpage);

if (isset($_POST['type']) && $_POST['type'] == "all") {
    $and = null;
} else {
    $and   = filterResualt($_POST['catid'] ?? null, "restaurants_type");
}

$data  = getAllData($table, "1 = 1  $and $limit ");

createJson($data['count'], $data['values']);
