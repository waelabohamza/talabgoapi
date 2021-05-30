<?php

include "../../connect.php";  
  
$table = "restaurants";

// Request

$resid  = superFilter($_POST['resid']);

$image = superFilter($_POST['image']) ; 

$licence = superFilter($_POST['licence']) ; 
 
// ================

$count = deleteData($table , "restaurants_id" , $resid); 

if ($count > 0){

    deleteFile("../../upload/restaurants" , $image) ; 
    deleteFile("../../upload/restaurants" , $licence) ; 

}


countresault($count) ; 