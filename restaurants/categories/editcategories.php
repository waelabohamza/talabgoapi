<?php

include "../../connect.php";

$filedir = "categories";

$table = "categoriesfood";


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $id             = superFilter($_POST['id']);
    $name           = superFilter($_POST['name']);
    $namear         = superFilter($_POST['namear']);
    $categoriedata  = getData($table, "categoriesfood_id", $id);
    $count          = $categoriedata['count'];
    $imageold       = $categoriedata['values']['categoriesfood_image'];


    // $datauser  =  $user['data'];
    if ($count > 0) {

        if (isset($_FILES['file'])) {

                // Image Request 


                    $image      = image_data("file");

                    $filetmp   =  $image['tmp'];

                    $imagename =  rand(0, 1000000) . "_" . $image['name'];

                    // Request 

            $data = array(
                "categoriesfood_name" => $name,
                "categoriesfood_name_ar" => $namear,
                "categoriesfood_image" => $imagename
            );

            $where =  "categoriesfood_id = $id ";

            $count =  updateData($table, $data, $where);

            deleteFile($filedir, $imageold);

            move_uploaded_file(  $filetmp , "../../upload/" . $filedir . "/" . $imagename);
      
        } else {


            $data = array("categoriesfood_name" => $name, "categoriesfood_name_ar" => $namear,  "categoriesfood_image" => $imageold);

            $where =  "categoriesfood_id = $id ";

            $count =  updateData($table, $data, $where);
        }
    }
    countresault($count);
} else {

    zeroCount();
}
