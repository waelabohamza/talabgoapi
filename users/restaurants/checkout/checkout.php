<?php
include "../../../connect.php";

$data = json_decode(file_get_contents('php://input'), true);


$lat           = superFilter($data['lat']);
$long          = superFilter($data['long']);
$userid        = superFilter($data['userid']);
$itemsNoRepeat =  $data['itemsnorepeat'];
$itemsRepeat   =  $data['itemsrepeate'];
$typeDelivery  = superFilter($data['typedelivery']);
$subitems      =  $data['subitems'];
$notes         = superFilter($data['notes']);
$totalprice    = superFilter($data['totalprice']);
$resid         = superFilter($data['resid']);
$username      = superFilter($data['username']);
$resname       = superFilter($data['resname']);

if ($typeDelivery == "tableqrcode") {
    $orderstable       =  superFilter($data['orderstable']);
} else {
    $orderstable       =  "0";
}


$usersprice = getDataColumn("users", "users_balance", "users_id", $userid);

if ($usersprice < $totalprice) {
    echo json_encode(array("status" => "moneynotenough"));
    exit();
}


$data = array(
    "ordersfood_users"      => $userid,
    "ordersfood_res"        => $resid,
    "ordersfood_notes"      => $notes,
    "ordersfood_lat"        => $lat,
    "ordersfood_long"       => $long,
    "ordersfood_totalprice" => $totalprice,
    "ordersfood_type"       => $typeDelivery , 
    "ordersfood_table"       => $orderstable 

);

$countStageOne = insertData("ordersfood", $data);

if ($countStageOne > 0) {

    $ordersid  =  maxId("ordersfood_id", "ordersfood");
    for ($i = 0; $i < count($itemsRepeat); $i++) {
        $itemsid    =  $itemsRepeat[$i]['itemsid'];
        $itemsprice =  $itemsRepeat[$i]['ordersprice'];
        $quantity   =  $itemsRepeat[$i]['count'];
        $data = array(
            "ordersfooddetails_itemsid"         => $itemsid,
            "ordersfooddetails_price"           => $itemsprice,
            "ordersfooddetails_ordersid"        => $ordersid,
            "ordersfooddetails_quantity"        => $quantity
        );
        $countStageTwoPartOne = insertData("ordersfooddetails", $data);
    }
    for ($i = 0; $i < count($itemsNoRepeat); $i++) {
        $itemsid    =  $itemsNoRepeat[$i]['itemsid'];
        $itemsprice =  $itemsNoRepeat[$i]['price'];
        $parentid   =  $itemsNoRepeat[$i]['id'];
        $data = array(
            "ordersfooddetails_itemsid"         => $itemsid,
            "ordersfooddetails_price"           => $itemsprice,
            "ordersfooddetails_ordersid"        => $ordersid,
            "ordersfooddetails_quantity"        => 1,
            "ordersfooddetails_parentid"        => $parentid
        );
        $countStageTwoPartTwo = insertData("ordersfooddetails", $data);
    }
    for ($i = 0; $i < count($subitems); $i++) {
        $subitemsid     =  $subitems[$i]['subitemsid'];
        $name           =  $subitems[$i]['name'];
        $price          =  $subitems[$i]['price'];
        $itemsid        =  $subitems[$i]['itemsid'];
        $data = array(
            "orderssubitemsfood_subitemsid"       => $subitemsid,
            "orderssubitemsfood_name"             => $name,
            "orderssubitemsfood_price"            => $price,
            "orderssubitemsfood_itemsid"          => $itemsid
        );
        $countStageTwoPartTwoPartThree = insertData("orderssubitemsfood", $data);
    }
    if (isset($countStageTwoPartTwo) || isset($countStageTwoPartOne)) {
        $countStageThree    = removeMoneyById("users", "users_balance", $totalprice, "users_id", $userid);
        if ($countStageThree > 0) {
            $countStagefour     = addMoneyById("restaurants", "restaurants_balance", $totalprice, "restaurants_id", $resid);
            if ($countStagefour > 0) {

                // For User
                $title = "طلب طعام";
                $body  = " طلب طعام من المطعم " . $resname;
                $countStageFivePartOne =    bill($totalprice, $userid, 0, $title, $body, "users");

                // For Restaurants
                $title = "طلب طعام";
                $body  = " طلب طعام من الزبون " . $username;
                $countStageFivePartTwo =    bill($totalprice, $resid, 1, $title, $body, "restaurants");

                if ($countStageFivePartOne > 0 && $countStageFivePartTwo > 0) {
                    // s1 = stage One مرحلة اولى من الطلبية
                    $title = "هام";
                    $body  =  "تم الطلب بنجاح الرجاء انتظار موافقة المطعم";
                    sendNotifySpecificUser($userid, $title, $body, "", "usersordersfoods1");
                    $title = "هام";
                    $body  =  "يوجد طلب بانتظار الموافقة";
                    sendNotifySpecificRes($resid, $title, $body, "", "resordersfoods1");
                    successCount();
                } else {
                    successCount();
                }
            } else {
                addMoneyById("users", "users_balance", $totalprice, "users_id", $userid);
                deleteData("ordersfood", "ordersfood_users", $ordersid);
                failCount();
            }
        }
    } else {
        failCount();
    }
} else {
    echo json_encode(array("status" => "fail", "case" => "fail one Stage"));
}
