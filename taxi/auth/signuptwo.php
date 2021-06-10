<?php

include  "../../connect.php";

$table = "taxi";

$msgerrors = array();


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $ordersid  =  maxId("taxi_id", "taxi");

    $email    = superFilter($_POST['email']);

    // 

    $type = superFilter($_POST['type']);

    $year = superFilter($_POST['year']);

    $model = superFilter($_POST['model']);

    $desc = superFilter($_POST['desc']);

    $typedelivery = superFilter($_POST['typedelivery']);

    $lat = superFilter($_POST['lat']);
    
    $long = superFilter($_POST['long']);

    // Multiple Files Upload 

    $imagemultipe = image_data_multiple("files");


    $data = array(

        "taxi_type"         => $type,
        "taxi_year"         => $year,
        "taxi_model"        => $model,
        "taxi_description"  => $desc,
        "taxi_typedelivery" => $typedelivery,
        "taxi_lat"          => $lat,
        "taxi_long"         => $long

    );

    if (empty($msgerrors)) {

        image_upload_multiple($imagemultipe, "../../upload/taxi", $ordersid,  "taxi");
        $count = updateData("taxi", $data, "taxi_email = '$email' ");
        countresault($count);
    } else {
        failCount();
    }
}
