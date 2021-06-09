<?php

include  "../../connect.php";

$table = "taxi";

$msgerrors = array();

 
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $email    = superFilter($_POST['email']); 

    // 

    $type = superFilter($_POST['type'])  ; 

    $year = superFilter($_POST['year']) ; 

    $desc = superFilter($_POST['desc']) ;

    // 
 
    $data = getData("taxi", "taxi_email",  $email);

    $count = $data['count'];

    if ($count > 0){

    

    } else {

        echo json_encode(array("status" => "fail", 
                               "cause" => "email Or phone not exists", 
                               "key" => "found"
                              ));
       
    }
}
