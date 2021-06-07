<?php

include "../../connect.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $email    = superFilter($_POST['email']);

    $password = sha1($_POST['password']);

    $data = getData("restaurants", "restaurants_email",  $email);

    $count = $data['count'];

    if ($count > 0) {

        $updatedata = array(
            "restaurants_password" => $password
        );

        $countupdate = updateData("restaurants", $updatedata, "restaurants_email = '$email' ");

        countresault($countupdate);
        
    } else {

        zeroCount();
    }
} else {
    zeroCount();
}
