<?php

include "../../connect.php";

$table = "taxi";

// Request ==================

$id  = superFilter($_POST['id']);

$minprice = superFilter($_POST['minprice']);

$price = superFilter($_POST['price']);

$data = array(
    "taxi_mincharge" => $minprice,
    "taxi_price"     => $price,
    "taxi_approve"   => 1
);

$count  = updateData("taxi", $data, "taxi_id = $id ");

countresault($count) ; 
 
 
// ================
