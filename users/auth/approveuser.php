<?php
include "../../connect.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $email  = superFilter($_POST['email']);

    $code   = superFilter($_POST['code']);

    $user = getData("users", "users_email", $email);

    $count = $user['count'];

    if ($count > 0) {

        $data = array(
            "users_approve" =>  1
        );
        $countupdate  =  updateData("users", $data, "users_email = '$email' AND users_verfiy = '$code' ");

        if ($countupdate > 0) {
            echo json_encode(array(
                "status" => "success"
            ));
        } else {
            echo json_encode(array(
                "status" => "fail"
            ));
        }
    } else {
        echo json_encode(array(
            "status" => "fail"
        ));
    }
} else {
    echo json_encode(array(
        "status" => "Page Not Found"
    ));
}
