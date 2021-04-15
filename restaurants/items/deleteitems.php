<?php
include "../../connect.php";

$filedir = "categories";
$table   = "categoriesfood";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id         = superFilter($_POST['id']);
    $category   = getData($table, "categoriesfood_id", $id);
    $imageold   = $category['values']['categoriesfood_image'];
    $checkcat   = $category['count'];
    if ($checkcat > 0) {
        $count = deleteData($table, "categoriesfood_id", $id);
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
