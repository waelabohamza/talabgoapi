
<?php

include "../../connect.php";

$table = "message";

$limit = paginationLimit($_GET['page'] ?? null, 1000);

$deliveryid = superFilter($_POST['id']);

$data  = getAllData($table, "message_cat = 'delivery' AND message_sid = '$deliveryid' ORDER BY message_id DESC  LIMIT 20 ");

createJson($data['count'], $data['values']);


?>