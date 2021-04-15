<?php

include "../../connect.php";

$filedir = "items";

$table   = "itemsfood";

$msgerrors = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // Image Request 


    $image      = image_data("file");

    $filetmp   =  $image['tmp'];

    $imagename =  rand(0, 1000000) . "_" . $image['name'];

    // Request 

    $catid    = superFilter($_POST['catid']);
    $name    = superFilter($_POST['name']);
    $namear  = superFilter($_POST['namear']);
    $desc    = superFilter($_POST['desc']);
    $descar  = superFilter($_POST['descar']);

    $data = array(
        "itemsfood_name"        =>  $name,
        "itemsfood_name_ar"     =>  $namear,
        "itemsfood_desc"        =>  $desc,
        "itemsfood_desc_ar"     =>  $descar,
        "itemsfood_image"       =>  $imagename,
        "itemsfood_cat"         =>  $catid
    );
    if (empty($msgerrors)) {
        $count = insertData($table, $data);
        countresault($count);
        if ($count > 0) {
            move_uploaded_file($filetmp, "../../upload/" . $filedir . "/"    .  $imagename);
        }
    } else {
        failCount();
    }
}
