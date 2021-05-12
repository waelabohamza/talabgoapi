<?php 

include "../../../connect.php" ; 


$ordersid = superFilter($_POST['ordersid']) ; 


$count = deleteData("ordersfood" , "ordersfood_id" , $ordersid , "ordersfood_status = 0") ; 


if ($count > 0){

   

}
