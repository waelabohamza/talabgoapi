<?php 

include "../../connect.php" ; 

$resid = superFilter($_POST['resid']);

$datebetween = intval($_POST['datebetween'] ?? null);

if (isset($_POST['datebetween']) && $datebetween != null) {
    $rangetime = strtotime("now", time() -  (3600 * 24) * $datebetween);
    $startdate = date("Y-m-d", $rangetime);
    $enddate = date("Y-m-d");
    $and = "AND  DATE(bill_date) BETWEEN DATE('$startdate') AND DATE('$enddate')   ";
} else {
    $and = null;
}


if (isset($_POST['grossing'])){
    $orders = "ORDER BY  totalprice DESC"; 
}else {
    $orders = "ORDER BY countitems DESC" ; 
}

$reports = getAllData("reportresview" , "ordersfood_res = '$resid' $orders LIMIT 5 ") ; 

if ($count > 0) {
    echo json_encode($report) ; 
}else {
    echo json_encode(array("0" => "faild")) ; 
}
