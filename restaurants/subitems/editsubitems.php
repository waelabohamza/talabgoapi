<?php

include "../../connect.php";


$table = "	subitemsfood";


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $id             = superFilter($_POST['id']);
    $name           = superFilter($_POST['name']);
    $namear         = superFilter($_POST['namear']);
    $price          = superFilter($_POST['price']);
    $subitemsdata   = getData($table, "subitemsfood_id", $id);
    $count          = $subitemsdata['count'];

    // $datauser  =  $user['data'];
    
    if ($count > 0) {

        $data = array(
            "subitemsfood_name" => $name,
            "subitemsfood_name_ar" => $namear,
            "subitemsfood_price" => $price
        );

        $where =  "subitemsfood_id = $id ";

        $count =  updateData($table, $data, $where);

        countresault($count);
    }
} else {

    failCount();
}
