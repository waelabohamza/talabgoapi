<?php

include "../../connect.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $email    = superFilter($_POST['email']);

    $password = sha1($_POST['password']);

    $data = getData("delivery", "delivery_email",  $email);

    $count = $data['count'];

    if ($count > 0) {

        $updatedata = array(

            "delivery_password" => $password

        );

        $countupdate = updateData("delivery", $updatedata, "delivery_email = '$email' ");

        countresault($countupdate);
        
    } else {

        zeroCount();
    }

} else {

    zeroCount();

}
