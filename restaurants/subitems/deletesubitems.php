<?php

include "../../connect.php";

$filedir = "items";

$table   = "itemsfood";

if ($_SERVER['REQUEST_METHOD'] == "POST"){

    $id         = superFilter($_POST['id']);

    $item       = getData($table, "subitemsfood_id", $id);

    $checkcat   = $item['count'];

    if ($checkcat > 0){

        $count = deleteData($table, "itemsfood_id", $id);

        countresault($count);

    } else {

        failCount();

    }

} else {

    failCount();

}
