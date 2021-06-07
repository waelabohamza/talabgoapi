<?php 

include "../../connect.php" ; 

$email = superFilter($_POST['email']) ; 

$data = getData("delivery", "delivery_email",  $email);

$count = $data['count'];


$code = rand(10000 , 99999)  ; 

if ($count > 0 ) {

    $datapass = array(

        "delivery_verifycode" => $code 

    );

    sendEmail($email , "Verfiy Code" , " Code = '$code' ") ; 

    updateData("delivery" , $datapass , "delivery_email  = '$email' ");

    echo json_encode(array("status" => "success" , "code" => $code  ));

}else {

    echo json_encode(array("status" => "fail")) ; 

}

?>