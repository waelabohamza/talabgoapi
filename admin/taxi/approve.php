<?php

include "../../connect.php";  
  
$table = "taxi";

// Request ==================

$id  = superFilter($_POST['id']);

$minprice = superFilter($_POST['minprice']) ; 

$price = superFilter($_POST['price']) ; 
 
// ================

$data = array("taxi_approve" => 1);

$count = updateData($table, $data, "taxi_id = '$id'");


countresault($count) ; 