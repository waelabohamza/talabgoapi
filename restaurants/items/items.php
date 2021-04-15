<?php

include "../../connect.php";

$table = "itemsfoodview";

$resid = $_GET['resid'] ; 

if (isset($_GET['catid'])){

   $and = "AND ";         

}else {

   $and = null ;  
   
}

$limit = paginationLimit($_GET['page'] ?? null, 10000);

$data = getAllData($table, "categoriesfood_restaurants = '$resid' $and $limit ");

createJson($data['count'], $data['values']);

