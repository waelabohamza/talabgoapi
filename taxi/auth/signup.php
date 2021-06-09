<?php

include  "../../connect.php";

$table = "taxi";

$msgerrors = array();

$verfiycode = rand(10000, 99999) ; 

if ($_SERVER['REQUEST_METHOD'] == "POST") {

   // ================== IMAGE  
    
    $image      = image_data("file");

    $filetmp   =  $image['tmp'];

    $imagerestaurantsname =  rand(0, 1000000) . "_" . $image['name'];
     
 
    $imagetwo      = image_data("filetwo");

    $filetmptwo   =  $imagetwo['tmp'];

    $imagelicencename =  rand(0, 1000000) . "_" . $imagetwo['name'];


    // ===================

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
            
            $values = array(
                "taxi_name" => $username,
                "taxi_phone" => $phone,
                "taxi_email" => $email,
                "taxi_password" => $password,
                "taxi_verfiycode" => $verfiycode
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
