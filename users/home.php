<?php 

include "../connect.php";

$arraydatahome = array();

$data = getAllData("typeres", " 1 =  1");

if ($data['count'] > 0) {

   $arraydatahome['typeres'] = $data['values'];
   
}else {

    $arraydatahome['typeres'] = "0" ;

}

$data = getAllData("restaurantsview", " restaurants_approve = 1  LIMIT 5");

if ($data['count'] > 0) {

   $arraydatahome['res'] = $data['values'];
   
}else {

    $arraydatahome['res'] = "0" ;

}

$userid = superFilter($_POST['usersid']);
$data = getDataColumn("users","users_balance" , "users_id" , $userid);
$arraydatahome['money'] = $data;

 


echo json_encode($arraydatahome); 
