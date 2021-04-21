<?php

include "../../connect.php";

$table = "restaurantsview";

$resid = $_POST['resid'];

$limit = paginationLimit($_GET['page'] ?? null, 9);

if (isset($_POST['type'])){
    $type = $_POST['type']  ; 
    $and = "restaurants_type = '$type'" ; 
}else {
    $and = null ; 
}

$data  = getAllData($table, "1 = 1  $and $limit ");

createJson($data['count'], $data['values']);
