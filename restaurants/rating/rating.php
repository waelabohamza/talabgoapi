<?php

include "../../connect.php";

$datarating = array();
$resid = superFilter($_POST['resid']);
$stmt  = $con->prepare("SELECT ROUND(AVG(rating.rating_value)) FROM rating WHERE rating_sid = ? AND rating.rating_type = 'restaurants'");
$stmt->execute(array($resid));
$rating = $stmt->fetchColumn();
$datarating['rating'] =   $rating == "" ? "0" : $rating;
$stmt2  = $con->prepare("SELECT  * FROM ratingviewres WHERE rating_sid = ?   ");
$stmt2->execute(array($resid));
$comments = $stmt2->fetchAll(PDO::FETCH_ASSOC);
$count = $stmt2->rowCount();
if ($count > 0) {
    
    $datarating['comments'] = $comments;

}else {


    $datarating['comments'] = "0";
}

echo json_encode($datarating);
