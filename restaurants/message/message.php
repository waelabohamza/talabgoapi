
<?php

include "../../connect.php";

$table = "message";

$limit = paginationLimit($_GET['page'] ?? null, 1000);

$resid = superFilter($_POST['id']);

$data  = getAllData($table, "message_cat = 'restaurants' AND message_sid = '$resid' ORDER BY message_id DESC  LIMIT 20 ");

createJson($data['count'], $data['values']);


?>