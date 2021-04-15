<?php
include "../../connect.php";

$filedir = "items";
$table   = "itemsfood";

if ($_SERVER['REQUEST_METHOD'] == "POST"){

    $id         = superFilter($_POST['id']);
    $item       = getData($table, "itemsfood_id", $id);
    $imageold   = $item['values']['itemsfood_image'];
    $checkcat   = $item['count'];

    if ($checkcat > 0){
        $count = deleteData($table, "itemsfood_id", $id);
        if ($count > 0) {
            deleteFile($filedir, $imageold);
        }
        countresault($count);
    } else {
        failCount();
    }
} else {
    failCount();
}
