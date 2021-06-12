<?php
include "../../connect.php";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $token    = $_POST['token'];
        $email    = superFilter($_POST['email']);
        $password = sha1($_POST['password']);
        $data     = signInWithEmailAndPassword("taxi", "taxi_email", "taxi_password", $email, $password, "AND taxi_approve = 1");
        $users    = $data['values'];
        $count    = $data['count'];
        if ($count > 0) {
            $count2 = insertToken($users['taxi_id'], $token, "taxi");

            sendNotifySpecificUser($users['taxi_id'], "مرحيا", "مرحبا بك في تطبيق التكسي الشامل", "", "");

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
