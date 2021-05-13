<?php

include "../../../connect.php";


$ordersid   = superFilter($_POST['ordersid']);
$resid      = superFilter($_POST['resid']);
$resname    = superFilter($_POST['resname']);
$userid     = superFilter($_POST['userid']);
$username   = superFilter($_POST['username']);
$price      = superFilter($_POST['price']);


$count = deleteData("ordersfood", "ordersfood_id", $ordersid, "AND ordersfood_status = 0 ");


if ($count > 0) {

    $counttwo      = removeMoneyById("restaurants", "restaurants_balance", $price, "restaurants_id", $resid);

    $countthree    = addMoneyById("users", "users_balance", $price, "users_id", $userid);

    // For User
    if ($counttwo > 0 && $countthree > 0){
        $title = "الغاء طلب طعام";
        $body  = " الغاء طلب طعام من المطعم " . $resname;
        $countStageFivePartOne =    bill($price, $userid, 1, $title, $body, "users");
        $body  = " الغاء طلب طعام من الزبون " . $username;
        $countStageFivePartTwo =    bill($price, $resid, 1, $title, $body, "restaurants");
    }
    successCount();
} else {
    failCount();
}
