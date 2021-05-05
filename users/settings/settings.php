<?php
include "../connect.php";

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
    $phone = $_POST['phone'];
    $stmt = $con->prepare("SELECT * FROM users WHERE  users_phone  = ?  AND  `users_id` != ?  ");
    $stmt->execute(array($phone, $userid));
    $count = $stmt->rowCount();
    if ($count > 0) {
        echo json_encode(array("status" => "phone already exists"));
    } else {
        $stmt2 = $con->prepare("UPDATE users SET users_phone = ? WHERE `users_id` = ?  ");
        $stmt2->execute(array($phone, $userid));
        $count = $stmt2->rowCount();
        echo json_encode(array("status" => "success"));
    }
}
if (isset($_POST['password'])) {
    $password = $_POST['password'];
    $stmt = $con->prepare("UPDATE users SET `users_password` = ? WHERE `users_id` = ?  ");
    $stmt->execute(array($password, $userid));
    $count = $stmt->rowCount();
    echo json_encode(array("status" => "success"));
}
if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $stmt = $con->prepare("UPDATE users SET `users_name` = ? WHERE `users_id` = ?  ");
    $stmt->execute(array($username, $userid));
    $count = $stmt->rowCount();
    echo json_encode(array("status" => "success"));
}
