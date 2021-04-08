<?php
include "../../connect.php" ;
$table   = "restaurants";
if ($_SERVER['REQUEST_METHOD'] == "POST"){
  $lat       =  superFilter($_POST['lat']);
  $long      =  superFilter($_POST['long']);
  $email     =  superFilter($_POST['email']) ;
  $data = array(
      "restaurants_lat" => $lat , 
      "restaurants_long" => $long
  );
  $count = updateData($table, $data , "restaurants_email = '$email'");
  countresault($count) ; 
}