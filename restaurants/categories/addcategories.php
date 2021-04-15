<?php

include "../../connect.php";

$filedir = "categories";

$table   = "categoriesfood";

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
        "categoriesfood_name" => $name,
        "categoriesfood_name_ar" => $namear,
        "categoriesfood_image" => $imagename,
        "categoriesfood_restaurants" =>  $resid
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
