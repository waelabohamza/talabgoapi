<?php
include "../../connect.php" ;
$id    = $_POST['id'];
$token = $_POST['token'] ;
$count = deleteToken($id , $token , "admin");
// countresault($count);   
successCount() ; 