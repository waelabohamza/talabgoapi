<?php

include "../../../connect.php";

$table = "orderssubitemsfoofview";

$ordersid  = superFilter($_POST['ordersdetailsparentid']);

$data  = getAllData($table, "ordersfooddetails_parentid = '$ordersid'");

createJson($data['count'], $data['values']);
