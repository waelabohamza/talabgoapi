<?php

include "../../connect.php";

$filedir = "categories";

$table = "categories";


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $id             = superFilter($_POST['id']);
    $name           = superFilter($_POST['name']);
    $namear         = superFilter($_POST['namear']);
    $categoriedata  = getData($table, "categories_id", $id);
    $count          = $categoriedata['count'];
    $imageold       = $categoriedata['values']['categories_image'];


    // $datauser  =  $user['data'];
    if ($count > 0) {

        if (isset($_FILES['file'])) {

                // Image Request 


                    $image      = image_data("file");

                    $filetmp   =  $image['tmp'];

                    $imagename =  rand(0, 1000000) . "_" . $image['name'];

                    // Request 

            $data = array(
                "categories_name" => $name,
                "categories_name_ar" => $namear,
                "categories_image" => $imagename
            );

            $where =  "categories_id = $id ";

            $count =  updateData($table, $data, $where);

            deleteFile($filedir, $imageold);

            move_uploaded_file(  $filetmp , "../../upload/" . $filedir . "/" . $imagename);
      
        } else {


            $data = array("categories_name" => $name, "categories_name_ar" => $namear,  "categories_image" => $imageold);

            $where =  "categories_id = $id ";

            $count =  updateData($table, $data, $where);
        }
    }
    countresault($count);
} else {

    zeroCount();
}
