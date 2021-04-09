<?php

include "../connect.php";

$data = json_decode(file_get_contents('php://input'), true);


$deliveryways = $data['deliveryways'];
$email        = $data['email'];

$stmt  = $con->prepare("SELECT restaurants_id FROM restaurants WHERE restaurants_email = ?");
$stmt->execute(array($email));
$resid = $stmt->fetchColumn();
$count = $stmt->rowCount();
if ($count > 0) {
    foreach ($deliveryways as $val) {
        $stmt2 = $con->prepare("INSERT INTO `rdtw`(`rdtw_res`, `rdtw_deliveryways`) VALUES ($resid , $val)");
        $stmt2->execute();
    }
    $count = $stmt2->rowCount();
    countresault($count);
} else {
    failCount();
}
