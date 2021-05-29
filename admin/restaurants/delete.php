<?php

include "../../connect.php";  
  
$table = "restaurants";

// Request

$resid  = superFilter($_POST['resid']);
 
// ================

$count = deleteData($table , "restaurants_id" , $resid); 

if ($count > 0){
    
}


countresault($count) ; 