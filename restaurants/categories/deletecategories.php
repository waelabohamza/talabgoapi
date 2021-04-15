<?php
include "../../connect.php";

$filedir = "categories";
$table   = "categories";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id         = superFilter($_POST['id']);
    $category   = getData($table, "categories_id", $id);
    $imageold   = $category['values']['categories_image'];
    $checkcat   = $category['count'];
    if ($checkcat > 0) {
        $count = deleteData($table, "categories_id", $id);
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
