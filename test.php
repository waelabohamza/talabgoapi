<?php

include "connect.php" ; 
$msgerrors = array() ;
$imagemultipe = image_data_multiple("files") ;
// print_r($_FILES['files']['name'])  ;

if (empty($msgerrors)) {

    image_upload_multiple($imagemultipe, "upload/test" , '1',  "name" , 'cat' , "test") ; 

}