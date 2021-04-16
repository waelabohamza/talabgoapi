<?php

include "../../connect.php";

$table   = "subitemsfood";

$msgerrors = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $itemsid = superFilter($_POST['itemsid']);
    $name    = superFilter($_POST['name']);
    $namear  = superFilter($_POST['namear']);
 
 

    $data = array(
        "subitemsfood_name"         =>  $name,
        "subitemsfood_name_ar"      =>  $namear,
        "subitemsfood_items"        =>  $itemsid 
    );

    if (empty($msgerrors)) {

        $count = insertData($table, $data);
        
        countresault($count);
        
        
    } else {
        failCount();
    }
}
