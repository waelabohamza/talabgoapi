<?php

include "../../connect.php";

$table = "ordersdetailsview";

$ordersid  = superFilter($_POST['ordersid']);

$data  = getAllData($table, "ordersfood_id = '$ordersid'");

createJson($data['count'], $data['values']);


// 0 wait approve 
// 1 wait approve delivery or prepare 
// 2 on the ways OR on the table (there is notify if table and live location if delivery)
// 3 done orders Or done table  