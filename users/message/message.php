
<?php

include "../../connect.php";

$table = "message";

$limit = paginationLimit($_GET['page'] ?? null, 1000);

$userid = superFilter($_POST['id']);

$data  = getAllData($table, "message_cat = 'users' AND message_sid = '$userid' ORDER BY message_id DESC  LIMIT 20 ");

createJson($data['count'], $data['values']);


?>