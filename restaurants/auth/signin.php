<?php
include "../../connect.php";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $token    = $_POST['token'] ?? "0" ; 
        $email    = superFilter($_POST['email']);
        $password = sha1($_POST['password']);
        $data     = signInWithEmailAndPassword("restaurants", "restaurants_email", "restaurants_password", $email, $password ,  "AND restaurants_approve = 1" );
        $restaurants    = $data['values'];
        $count    = $data['count'];
        if ($count > 0){
            $count2 = insertToken($restaurants['restaurants_id'] , $token, "restaurants") ; 
            if ($count2 > 0 ){
             sendNotifySpecificUser($restaurants['restaurants_id'], "مرحبا", "مرحبا بك في تطبيق المطاعم الشامل", "", "") ; 
            }
            echo json_encode(array("status" => "success", "restaurants" => $restaurants , "token" => $token));
        }else{
            failCount() ; 
        }
    } else {
        failCount() ; 
    }
} else {
    echo json_encode(array("status" => "Page Not Found"));
}
