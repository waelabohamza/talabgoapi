<?php
include "../../connect.php";

$userid = $_POST['userid'];

if (isset($_POST['email'])) {

    $email = superFilter($_POST['email']);  

    $stmt = $con->prepare("SELECT * FROM admin WHERE  admin_email = ?  AND  `admin_id` != ?  ");

    $stmt->execute(array($email, $userid));

    $count = $stmt->rowCount();

    if ($count > 0) {
        echo json_encode(array("status" => "email already exists"));
    } else {
        $data = array(
            "admin_email" =>  $email,
        );
        $count = updateData("admin", $data, "admin_id = '$userid' ");
        countresault($count);
    }
}

if (isset($_POST['phone'])) {
    $phone =  superFilter($_POST['phone']);
    $stmt = $con->prepare("SELECT * FROM admin WHERE  admin_phone  = ?  AND  `admin_id` != ?  ");
    $stmt->execute(array($phone, $userid));
    $count = $stmt->rowCount();
    if ($count > 0) {
        echo json_encode(array("status" => "phone already exists"));
    } else {
        $data = array(
            "admin_phone" =>  $phone,
        );
        $count = updateData("admin", $data, "admin_id = '$userid' ");
        countresault($count);
    }
}
if (isset($_POST['password'])) {
    $password =  sha1($_POST['password']);
    $data = array(
        "admin_password" =>  $password,
    );
    $count = updateData("admin", $data, "admin_id = '$userid' ");
    countresault($count);
}
if (isset($_POST['username'])) {
    $username =  superFilter($_POST['username']);
    $data = array(
        "admin_name" =>  $username,
    );
    $count = updateData("admin", $data, "admin_id = '$userid' ");
    countresault($count);
}
