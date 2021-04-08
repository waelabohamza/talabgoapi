<?php

include "../../connect.php";

$table   = "restaurants";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $country        =  superFilter($_POST['country']);
    $area           =  superFilter($_POST['area']);
    $street         =  superFilter($_POST['street']);
    $timedelivery   =  superFilter($_POST['timedelivery']);
    $pricedelivery  =  superFilter($_POST['pricedelivery']);
    $desc           =  superFilter($_POST['desc']);
    $descar         =  superFilter($_POST['descar']);
    $type           =  superFilter($_POST['type']);
    $email          =  superFilter($_POST['email']);

    $data = array(
        "restaurants_country"       => $country,
        "restaurants_area"          => $area,
        "restaurants_street"        => $street,
        "restaurants_timedelivery"  => $timedelivery,
        "restaurants_desc"          => $desc , 
        "restaurants_desc_ar"       => $descar , 
        "restaurants_type"          => $type 
    );

    $count = updateData($table, $data, "restaurants_email = '$email'");
    
    countresault($count) ; 
}
