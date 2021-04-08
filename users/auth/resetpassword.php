<?php

include "../../connect.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $email    = superFilter($_POST['email']);

    $password = sha1($_POST['password']);

    $data = getData("users", "users_email",  $email);

    $count = $data['count'];

    if ($count > 0) {

        $updatedata = array(
            "users_password" => $password
        );

        $countupdate = updateData("users", $updatedata, "users_email = '$email' ");

        countresault($countupdate);
        
    } else {

        zeroCount();
    }
} else {
    zeroCount();
}
