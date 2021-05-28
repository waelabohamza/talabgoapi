<?php
include "../../connect.php";
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if (isset($_POST['email']) && isset($_POST['password'])){
        $token    = $_POST['token'];
        $email    = superFilter($_POST['email']);
        $password = sha1($_POST['password']);
        $data     = signInWithEmailAndPassword("admin", "admin_email", "admin_password", $email, $password);
        $users    = $data['values'];
        $count    = $data['count'];
        if ($count > 0){
            $count2 = insertToken($users['admin_id'], $token, "admin");

            // sendNotifySpecificDelviery($users['admin_id'], "مرحيا", "مرحبا بك في تطبيق TalabGo الشامل", "", "");

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
