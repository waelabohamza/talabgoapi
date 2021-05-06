<?php
include "../../connect.php";

$userid = $_POST['userid'];

if (isset($_POST['email'])) {

    $email = superFilter($_POST['email']);

    $stmt = $con->prepare("SELECT * FROM users WHERE  users_email = ?  AND  `users_id` != ?  ");

    $stmt->execute(array($email, $userid));

    $count = $stmt->rowCount();

    if ($count > 0) {
        echo json_encode(array("status" => "email already exists"));
    } else {
        $data = array(
            "users_email" =>  $email,
        );
        $count = updateData("users", $data, "users_id = '$userid' ");
        countresault($count);
    }
}

if (isset($_POST['phone'])) {
    $phone =  superFilter($_POST['phone']);
    $stmt = $con->prepare("SELECT * FROM users WHERE  users_phone  = ?  AND  `users_id` != ?  ");
    $stmt->execute(array($phone, $userid));
    $count = $stmt->rowCount();
    if ($count > 0) {
        echo json_encode(array("status" => "phone already exists"));
    } else {
        $data = array(
            "users_phone" =>  $phone,
        );
        $count = updateData("users", $data, "users_id = '$userid' ");
        countresault($count);
    }
}
if (isset($_POST['password'])) {
    $password =  sha1($_POST['password']);
    $data = array(
        "users_password" =>  $password,
    );
    $count = updateData("users", $data, "users_id = '$userid' ");
    countresault($count);
}
if (isset($_POST['username'])) {
    $username =  superFilter($_POST['username']);
    $data = array(
        "users_name" =>  $username,
    );
    $count = updateData("users", $data, "users_id = '$userid' ");
    countresault($count);
}
