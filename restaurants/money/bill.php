<?php

include "../../connect.php";

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




$stmt = $con->prepare("SELECT  bill.*   FROM `bill`
 
 WHERE bill_sid  =  ? And  bill_cat = 'restaurants' $and  ORDER BY bill_id DESC ");

$stmt->execute(array($resid));

$bill = $stmt->fetchAll(PDO::FETCH_ASSOC);

$count = $stmt->rowCount();

if ($count > 0) {
    echo json_encode(array("status" => "success", "bill" => $bill));
} else {
    zeroCount();
}
