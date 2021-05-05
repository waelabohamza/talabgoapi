<?php

include "../connect.php";
$i = 0;
$searcharray = array();
$search = $_POST['search'];
$stmtres = $con->prepare("SELECT * FROM restaurants WHERE restaurants_name LIKE '%$search%' LIMIT 10 ");
$stmtres->execute();
$countres = $stmtres->rowCount();

$datares = array();



while ($res = $stmtres->fetch(PDO::FETCH_ASSOC)) {



    $searcharray[$i]['type_name']   = $res['restaurants_name'];
    $searcharray[$i]['type_id']     = $res['restaurants_id'];
    $searcharray[$i]['type']        = "restaurants";
    $searcharray[$i]['data']        = $datares;


    $i++;
}

$stmtitem = $con->prepare("SELECT * FROM itemsfoodview
WHERE itemsfood_name LIKE '%$search%' LIMIT 10 ");
$stmtitem->execute();
$countitem = $stmtitem->rowCount();
$dataitems = array();


while ($items = $stmtitem->fetch(PDO::FETCH_ASSOC)) {



    $searcharray[$i]['type_name'] = $items['itemsfood_name'];
    $searcharray[$i]['type_id'] = $items['itemsfood_id'];
    $searcharray[$i]['type'] = "items";
    $searcharray[$i]['data'] = $items;


    $i++;
}

if (  $countres > 0 || $countitem > 0) {
    echo json_encode($searcharray);
} else {
    echo json_encode(array(0 => "faild"));
}


// echo "<pre>";

// print_r($searcharray);

// echo "</pre>";
