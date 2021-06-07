<?php 

include "../../connect.php" ; 
if ($_SERVER['REQUEST_METHOD'] == "POST"){
$code  = superFilter($_POST['code']) ; 
$email = superFilter($_POST['email']) ; 
$data = getData("restaurants", "restaurants_email",  $email , "AND restaurants_verfiycode = '$code' ");
$count = $data['count'];
countresault($count) ; 
}else {
    echo json_encode(array("status" => "falid"));
}
?>  