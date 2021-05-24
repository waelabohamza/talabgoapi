<?php

include "../../connect.php";


$resid = superFilter($_POST['resid']);

$status = intval(superFilter($_POST['status']));

$data = array(
    "restaurants_active" => $status
);

$count = updateData("restaurants", $data, "restaurants_id = '$resid' ");

countresault($count);
