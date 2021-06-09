<?php
include "../../connect.php";

$filedir = "restaurants";

$table   = "restaurants";

$msgerrors = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // Image Request 


    $image      = image_data("file");

    $filetmp   =  $image['tmp'];

    $imagerestaurantsname =  rand(0, 1000000) . "_" . $image['name'];


    $imagetwo      = image_data("filetwo");

    $filetmptwo   =  $imagetwo['tmp'];

    $imagelicencename =  rand(0, 1000000) . "_" . $imagetwo['name'];

    // ======= POST ======= //

    $name       = superFilter($_POST['name']);
    $namear     = superFilter($_POST['namear']);
    $email      = superFilter($_POST['email']);
    $password   = sha1($_POST['password']);
    $phone      = intval($_POST['phone']);



    $checkRes = getData("restaurants", "restaurants_email", $email, "OR restaurants_phone = '$phone' ");

    if ($checkRes['count'] > 0) {

        failCount();
    } else {

        $data = array(

            "restaurants_name"      => $name,
            "restaurants_name_ar"   => $namear,
            "restaurants_email"     => $email,
            "restaurants_phone"     => $phone,
            "restaurants_password"  => $password,
            "restaurants_image"     => $imagerestaurantsname,
            "restaurants_licence"   => $imagelicencename

        );

        if (empty($msgerrors)) {

            move_uploaded_file($filetmp, "../../upload/" . $filedir . "/"    .  $imagerestaurantsname);
            move_uploaded_file($filetmptwo, "../../upload/" . $filedir . "/"     . $imagelicencename);
            $count = insertData($table, $data);
        } else {

            failCount();
        }
    }
}
