<?php

include "../../connect.php";  
  
$table = "taxi";

// Request

$taxiid  = superFilter($_POST['taxiid']);
 
// ================

$data = array("taxi_approve" => 1);

$count = updateData($table, $data, "taxi_id = '$resid'");


countresault($count) ; 