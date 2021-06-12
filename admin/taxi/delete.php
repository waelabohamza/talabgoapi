<?php

include "../../connect.php";  
  
$table = "taxi";

// Request

$id  = superFilter($_POST['id']);

$image = superFilter($_POST['image']) ; 

$licence = superFilter($_POST['licence']) ; 
 
// ================

$count = deleteData($table , "taxi_id" , $id); 

if ($count > 0){

    deleteFile("../../upload/taxi" , $image) ; 
    deleteFile("../../upload/taxi" , $licence) ; 

}


countresault($count) ; 