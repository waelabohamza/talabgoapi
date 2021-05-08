<?php 

include "../../connect.php" ; 

 $resid = superFilter($_POST['resid']) ; 

 $status = getDataColumn("restaurants" , "restaurants_active" , "restaurants_id" , $resid ) ; 

 if ($status == "1" ){
       successCount() ; 
 }else {
       failCount() ; 
 }
