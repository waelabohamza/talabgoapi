<?php

include "../../connect.php";

$filedir = "items";

$table   = "subitemsfood";

if ($_SERVER['REQUEST_METHOD'] == "POST"){

    $id         = superFilter($_POST['id']);

    $item       = getData($table, "subitemsfood_id", $id);

    $checkcat   = $item['count'];

    if ($checkcat > 0){

        $count = deleteData($table, "subitemsfood_id", $id);

        countresault($count);

    } else {

        failCount();

    }

} else {

    failCount();

}
