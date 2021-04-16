<?php

include "../../connect.php";

$filedir = "items";

$table = "itemsfood";


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $id             = superFilter($_POST['id']);
    $name           = superFilter($_POST['name']);
    $namear         = superFilter($_POST['namear']);
    $desc           = superFilter($_POST['desc']);
    $descar         = superFilter($_POST['descar']);
    $catid         = superFilter($_POST['catid']);
    $categoriedata  = getData($table, "itemsfood_id", $id);
    $count          = $categoriedata['count'];
    $imageold       = $categoriedata['values']['itemsfood_image'];


    // $datauser  =  $user['data'];
    if ($count > 0) {

        if (isset($_FILES['file'])) {

                // Image Request 


                    $image      = image_data("file");

                    $filetmp   =  $image['tmp'];

                    $imagename =  rand(0, 1000000) . "_" . $image['name'];

                    // Request 

            $data = array(
                "itemsfood_name"        =>  $name,
                "itemsfood_name_ar"     =>  $namear,
                "itemsfood_desc"        =>  $desc,
                "itemsfood_desc_ar"     =>  $descar,
                "itemsfood_image"       =>  $imagename,
                "itemsfood_cat"         =>  $catid
            );

            $where =  "itemsfood_id = $id ";

            $count =  updateData($table, $data, $where);

            deleteFile($filedir, $imageold);

            move_uploaded_file(  $filetmp , "../../upload/" . $filedir . "/" . $imagename);
      
        } else {


            $data = array(
                "itemsfood_name"        =>  $name,
                "itemsfood_name_ar"     =>  $namear,
                "itemsfood_desc"        =>  $desc,
                "itemsfood_desc_ar"     =>  $descar,
                "itemsfood_cat"         =>  $catid
            );


            $where =  "itemsfood_id = $id ";

            $count =  updateData($table, $data, $where);
        }
    }
    countresault($count);
} else {

    zeroCount();
}
