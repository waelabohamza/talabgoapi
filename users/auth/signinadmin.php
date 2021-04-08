<?php 

include "../../connect.php" ; 

$email    = superFilter($_POST['email']) ; 
$password = $_POST['password'] ; 

$data     = signInWithEmailAndPassword("users" ,"users_email" , "users_password" , $email , $password , "AND users_role = 1 ");
$users    = $data['values'] ; 
$count    = $data['count'] ; 

if ($count > 0 ) {
  
    echo json_encode(array("status" => "success" , "message" => $users)) ; 

}else {
  
    echo json_encode(array("status" => "fail")) ; 

}
