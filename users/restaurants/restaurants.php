<?php

include "../../connect.php";

$table = "restaurantsview";

$limit = paginationLimit($_GET['page'] ?? null, $countrowinpage);

if (isset($_POST['type']) && $_POST['type'] == "all") {
    $and = null;
} else {
    $and   = filterResualt($_POST['type'] ?? null, "restaurants_type");
}

$data  = getAllData($table, "restaurants_approve = 1  $and $limit ");

createJson($data['count'], $data['values']);
