<?php
include "../../connect.php";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $token    = $_POST['token'];
        $email    = superFilter($_POST['email']);
        $password = sha1($_POST['password']);
        $data     = signInWithEmailAndPassword("users", "users_email", "users_password", $email, $password, "AND users_approve = 1");
        $users    = $data['values'];
        $count    = $data['count'];
        if ($count > 0) {
            $count2 = insertToken($users['users_id'], $token, "users");

            sendNotifySpecificUser($users['users_id'], "مرحيا", "مرحبا بك في تطبيق المطاعم الشامل", "", "");

            echo json_encode(array("status" => "success", "users" => $users, "token" => $token));
        } else {
            echo json_encode(array("status" => "fail"));
        }
    } else {
        echo json_encode(array("status" => "fail"));
    }
} else {
    echo json_encode(array("status" => "Page Not Found"));
}
