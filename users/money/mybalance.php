<?php

include "../../connect.php"  ;  

$userid = superFilter($_POST['userid']);

$data = getDataColumn("users","users_balance" , "users_id" , $userid);

echo json_encode(array("balance" => $data )) ;

?>