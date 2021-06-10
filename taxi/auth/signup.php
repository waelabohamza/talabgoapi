<?php

include  "../../connect.php";

$table = "taxi";

$msgerrors = array();

$verfiycode = rand(10000, 99999) ; 

$filedir = "taxi" ; 

if ($_SERVER['REQUEST_METHOD'] == "POST") {

   // ========================= IMAGE ======================== //

   $imagetwo      = image_data("file");

   $filetmptwo   =  $imagetwo['tmp'];

   $imagetaxi =  rand(0, 1000000) . "_" . $imagetwo['name'];

   // ========================================================= 
    
    $image      = image_data("filetwo");

    $filetmp   =  $image['tmp'];

    $imagelicencename =  rand(0, 1000000) . "_" . $image['name'];

    // =========================================================



    $username = superFilter($_POST['username']);

    checkLength("username",  $username, 2, 100);

    $password = sha1($_POST['password']);

    checkLength("password",  $password, 2, 100);

    $email    = superFilter($_POST['email']);

    checkLength("email",  $email, 2, 100);

    $phone    = superFilter($_POST['phone']);

    checkLength("phone",  $phone, 2, 100);

    $data = getData("taxi", "taxi_email",  $email);

    $count = $data['count'];

    if ($count > 0) {

        echo json_encode(array("status" => "fail", "cause" => "email Or phone already existst", "key" => "found"));
    } else {

        if (empty($msgerrors)){

            move_uploaded_file($filetmptwo, "../../upload/" . $filedir . "/"    .  $imagetaxi);
            move_uploaded_file($filetmp, "../../upload/" . $filedir . "/"     . $imagelicencename);
            
            $values = array(
                "taxi_name" => $username,
                "taxi_phone" => $phone,
                "taxi_email" => $email,
                "taxi_password" => $password,
                "taxi_verfiycode" => $verfiycode, 
                "taxi_licence" => $imagelicencename , 
                "taxi_image"  => $imagetaxi 
            );

            $countinsert  = insertData($table, $values);
            if ($countinsert > 0) {
                // sendEmail($email , "Verfiy Code" , " Code = '$verfiycode' ") ; 
                echo json_encode(array(
                    "status" => "success",
                    "username" => $username,
                    "password" => $_POST['password'],
                    "email"    => $email
                ));
            } else {
                echo json_encode(array("status" => "fail", "cause" => "Insert fail", "key" => "insert"));
            }
        } else {
            echo json_encode(array("status" => "fail", "cause" => $msgerrors, "key" => "insert"));
        }
    }
}
