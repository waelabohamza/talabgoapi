<?php

include "../../connect.php";  
  
$table = "taxi";

// Request

$taxiid  = superFilter($_POST['taxiid']);

$image = superFilter($_POST['image']) ; 

$licence = superFilter($_POST['licence']) ; 
 
// ================

$count = deleteData($table , "taxi_id" , $resid); 

if ($count > 0){

    deleteFile("../../upload/taxi" , $image) ; 
    deleteFile("../../upload/taxi" , $licence) ; 

}


countresault($count) ; 