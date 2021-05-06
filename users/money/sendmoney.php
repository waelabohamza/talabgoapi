<?php
include "../../connect.php";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $phone =   superFilter($_POST['phone']);
    $price =   superFilter($_POST['price']);
    $userid = superFilter($_POST['userid']);
    $getinfouser = $con->prepare("SELECT * FROM users WHERE users_id = ? LIMIT 1  ");
    $getinfouser->execute(array($userid));
    $datausersender = $getinfouser->fetch(PDO::FETCH_ASSOC);
    $mybalance = $datausersender['users_balance'];
    $countone = $getinfouser->rowCount();
    //    التاكد من ان الشخص الذي يريد التحويل موجود   
    if ($countone > 0) {
        //     التاكد من توفر الرصيد الكافي للتحويل 
        if ($mybalance > $price) {
            $checkuser = $con->prepare("SELECT * FROM users WHERE users_id = '$userid' ");
            $username = superFilter($_POST['username']);
            $checkuser = $con->prepare("SELECT * FROM users WHERE users_phone = ?");
            $checkuser->execute(array($phone));
            $countuser = $checkuser->rowCount();
            if ($countuser > 0) {
                $get = getInfoUserByPhone($phone);
                $useridrecive = $get['users_id'];
                $usernamerecive = $get['users_name'];
                $count = addMoneyById("users", "users_balance",  $price, "users_phone", $phone);
                if ($count > 0) {
                    $counttwo = removeMoneyById("users", "users_balance", $price, "users_id", $userid);
                    echo json_encode(array("status" => "success"));
                    $title = "TalabGoFoodDelivery";
                    $message = " تم تحويل رصيد"  . $price . " دينار من قبل  "   . $username  .  " اليك ";
                    bill($price, $useridrecive, 1, "تحويل مالي", $message, "users");
                    sendNotifySpecificUser($useridrecive, $title, $message, "", "home");
                    $title = "تنبيه";
                    $message = " تم التحويل   الى " . $usernamerecive;
                    sendNotifySpecificUser($userid, $title, $message, "", "donetransfermoney");
                    bill($price, $userid, 0, "تحويل مالي", $message, "users");
                } else {
                    removeMoneyById("users", "users_balance",  $price, "user_phone", $phone);
                    echo json_encode(array("status" => "fail add money"));
                }
            } else {
                echo json_encode(array("status" => "usernotexists"));
            }
        } else {
            echo json_encode(array("status" => "moneynotenough"));
        }
    } else {
        failCount();
    }
}
