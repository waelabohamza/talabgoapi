<?php

include "../../connect.php"  ;  

$resid = superFilter($_POST['resid']);

$data = getDataColumn("restaurants","restaurants_balance" , "restaurants_id" , $resid);

echo json_encode(array("balance" => $data )) ;

?>