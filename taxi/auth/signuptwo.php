<?php

include  "../../connect.php";

$table = "taxi";

$msgerrors = array();


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $email    = superFilter($_POST['email']);

    // 

    $type = superFilter($_POST['type']);

    $year = superFilter($_POST['year']);

    $model = superFilter($_POST['model']);

    $desc = superFilter($_POST['desc']);

    $price = superFilter($_POST['price']);

    $mincharge = superFilter($_POST['mincharge']);

    $typedelivery = superFilter($_POST['typedelivery']) ; 

    // 

    $data = array(

        "taxi_type"         => $type,
        "taxi_year"         => $year,
        "taxi_model"        => $model,
        "taxi_description"  => $desc,
        "taxi_price"        => $price,
        "taxi_mincharge"    => $mincharge , 
        "taxi_typedelivery" => $typedelivery

    );

    $count = updateData("taxi", $data, "taxi_email = '$email' ");

    countresault($count);
}
