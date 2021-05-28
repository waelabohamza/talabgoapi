<?php

include "../../connect.php";  
  
$table = "restaurants";

// Request

$resid  = superFilter($_POST['resid']);
 
// ================

$data = array("restaurants_approve" => 1);

$count = updateData($table, $data, "restaurants_id = '$resid'");


countresault($count) ; 