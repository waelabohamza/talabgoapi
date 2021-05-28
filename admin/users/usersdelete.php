<?php

include "../../connect.php";  
  
$table = "users";

// Request

$usersid  = superFilter($_POST['usersid']);
 
// ================

$count = deleteData($table , "users_id" , $usersid); 

countresault($count) ; 