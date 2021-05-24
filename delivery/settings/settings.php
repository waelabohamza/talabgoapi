<?php
include "../../connect.php";

$deliveryid = $_POST['id'];

if (isset($_POST['email'])) {

    $email = superFilter($_POST['email']);

    $stmt = $con->prepare("SELECT * FROM delivery WHERE  delivery_email = ?  AND  `delivery_id` != ?  ");

    $stmt->execute(array($email, $delivery));

    $count = $stmt->rowCount();

    if ($count > 0) {
        echo json_encode(array("status" => "email already exists"));
    } else {
        $data = array(
            "delivery_email" =>  $email,
        );
        $count = updateData("delivery", $data, "delivery_id = '$deliveryid' ");
        countresault($count);
    }
}

if (isset($_POST['phone'])) {
    $phone =  superFilter($_POST['phone']);
    $stmt = $con->prepare("SELECT * FROM delivery WHERE  delivery_phone  = ?  AND  `delivery_id` != ?  ");
    $stmt->execute(array($phone, $delivery));
    $count = $stmt->rowCount();
    if ($count > 0) {
        echo json_encode(array("status" => "phone already exists"));
    } else {
        $data = array(
            "delivery_phone" =>  $phone,
        );
        $count = updateData("delivery", $data, "delivery_id = '$deliveryid' ");
        countresault($count);
    }
}
if (isset($_POST['password'])) {
    $password =  sha1($_POST['password']);
    $data = array(
        "delivery_password" =>  $password,
    );
    $count = updateData("delivery", $data, "delivery_id = '$deliveryid' ");
    countresault($count);
}
if (isset($_POST['username'])) {
    $username =  superFilter($_POST['username']);
    $data = array(
        "delivery_name" =>  $username,
    );
    $count = updateData("delivery", $data, "delivery_id = '$deliveryid' ");
    countresault($count);
}
