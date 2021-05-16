<?php

include "../../connect.php";

$username   = superFilter($_POST['username']);
$email      = superFilter($_POST['email']);
$phone      = superFilter($_POST['phone']);
$password   = sha1($_POST['password']);
$resid      = superFilter($_POST['resid']);


// $title  = "TalabGo";
// $body  = "تم انشاء حسابك بنجاح كلمة المرور الحالية  "  . $_POST['password'];

// sendEmail($email, $title, $body);


$data = array(
    "delivery_name"       => $username,
    "delivery_email"      => $email,
    "delivery_password"   => $password,
    "delivery_phone"      => $phone,
    "delivery_res"        => $resid
);


$count = insertData("delivery", $data);

countresault($count);
