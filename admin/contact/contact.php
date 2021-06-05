<?php 

include "../../connect.php" ; 

$sid  = superFilter($_POST['id']) ; 

$type = superFilter($_POST['type']) ; 



if ($type == "users"){

    $data = getAllData("contactadminusers" , "1 = 1") ; 

}
if ($type == "restaurants"){
  
    $data = getAllData("contactadminusers" , "1 = 1") ; 


}


$count = $data['count'] ; 

$data = $data['values'] ; 

if ($count > 0){
  
    echo json_encode($data) ; 

}else {

    zeroCount() ; 

}
