<?php

include "../../connect.php";  
  
$table = "restaurants";

// Request
$resid  = superFilter($_POST['resid']);
 



// ================
$data = array("ordersfood_status" => 1);

$count = updateData($table, $data, "ordersfood_id = '$ordersid' ");