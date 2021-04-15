<?php

include "../../connect.php";

$filedir = "categories";

$table   = "categories";

$msgerrors = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // Image Request 


    $image      = image_data("file");

    $filetmp   =  $image['tmp'];

    $imagename =  rand(0, 1000000) . "_" . $image['name'];

    // Request 

    $resid    = superFilter($_POST['resid']);
    $name    = superFilter($_POST['name']);
    $namear  = superFilter($_POST['namear']);

    $data = array(
        "categories_name" => $name,
        "categories_name_ar" => $namear,
        "categories_image" => $imagename,
        "categories_restaurants" =>  $resid
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
