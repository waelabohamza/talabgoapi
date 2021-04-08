<?php 

include "../connect.php";

$arraydatahome = array();

$data = getAllData("typeres", " 1 =  1");

if ($data['count'] > 0) {

   $arraydatahome['typeres'] = $data['values'];
   
}else {

    $arraydatahome['typeres'] = "0" ;

}


echo json_encode($arraydatahome); 
