<?php
include "../../connect.php" ;
$id    = $_POST['id'];
$token = $_POST['token'] ;
$count = deleteToken($id , $token , "users");
// countresault($count);   
successCount() ; 