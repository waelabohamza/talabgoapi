<?php 

include "../../connect.php" ; 
if ($_SERVER['REQUEST_METHOD'] == "POST"){
$code  = superFilter($_POST['code']) ; 
$email = superFilter($_POST['email']) ; 
$data = getData("users", "users_email",  $email , "AND users_verfiy = '$code' ");
$count = $data['count'];
countresault($count) ; 
}else {
    echo json_encode(array("status" => "falid"));
}
?>  