<?php

include "../../connect.php";

$reportAll = array();

$resid = superFilter($_POST['resid']);

$datebetween = intval($_POST['datebetween'] ?? null);

if (isset($_POST['datebetween']) && $datebetween != null) {
    $rangetime = strtotime("now", time() -  (3600 * 24) * $datebetween);
    $startdate = date("Y-m-d", $rangetime);
    $enddate = date("Y-m-d");
    $and = "AND  DATE(ordersfood_date) BETWEEN DATE('$startdate') AND DATE('$enddate')   ";
} else {
    $and = null;
}



$orders = "ORDER BY  totalprice DESC";
$reports = getAllData("reportresview", "ordersfood_res = '$resid' $and $orders LIMIT 5 ");
$count  =  $reports['count'];
if ($count > 0) {
    $reportAll['grossing'] = $reports['values'];
} else {
    $reportAll['grossing'] = "0";
}
$orders = "ORDER BY countitems DESC";
$reports = getAllData("reportresview", "ordersfood_res = '$resid' $and $orders LIMIT 5 ");
$count  =  $reports['count'];
if ($count > 0) {
    $reportAll['countitems'] = $reports['values'];
} else {
    $reportAll['countitems'] = "0";
}

$reports = getDataColumn("ordersfood" , "COUNT(ordersfood_id)" , "ordersfood_res" , $resid) ; 
$reportAll['totalcount'] = $reports  ;   

echo json_encode($reportAll);
