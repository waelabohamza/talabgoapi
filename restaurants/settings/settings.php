<?php
include "../../connect.php";

$resid = $_POST['id'];

if (isset($_POST['email'])) {

    $email = superFilter($_POST['email']);

    $stmt = $con->prepare("SELECT * FROM restaurants WHERE  restaurants_email = ?  AND  `restaurants_id` != ?  ");

    $stmt->execute(array($email, $resid));

    $count = $stmt->rowCount();

    if ($count > 0) {
        echo json_encode(array("status" => "email already exists"));
    } else {
        $data = array(
            "restaurants_email" =>  $email,
        );
        $count = updateData("restaurants", $data, "restaurants_id = '$resid' ");
        countresault($count);
    }
}

if (isset($_POST['phone'])) {
    $phone =  superFilter($_POST['phone']);
    $stmt = $con->prepare("SELECT * FROM restaurants WHERE  restaurants_phone  = ?  AND  `restaurants_id` != ?  ");
    $stmt->execute(array($phone, $resid));
    $count = $stmt->rowCount();
    if ($count > 0) {
        echo json_encode(array("status" => "phone already exists"));
    } else {
        $data = array(
            "restaurants_phone" =>  $phone,
        );
        $count = updateData("restaurants", $data, "restaurants_id = '$resid' ");
        countresault($count);
    }
}
if (isset($_POST['password'])) {
    $password =  sha1($_POST['password']);
    $data = array(
        "restaurants_password" =>  $password,
    );
    $count = updateData("restaurants", $data, "restaurants_id = '$resid' ");
    countresault($count);
}
if (isset($_POST['minpriceorders'])) {
    $minpriceorders =  superFilter($_POST['minpriceorders']);
    $data = array(
        "restaurants_minpriceorders" =>  $minpriceorders,
    );
    $count = updateData("restaurants", $data, "restaurants_id = '$resid' ");
    countresault($count);
}
if (isset($_POST['username'])) {
    $username =  superFilter($_POST['username']);
    $data = array(
        "restaurants_name" =>  $username,
    );
    $count = updateData("restaurants", $data, "restaurants_id = '$resid' ");
    countresault($count);
}
