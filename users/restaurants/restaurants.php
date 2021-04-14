<?php

include "../../connect.php";

$arraydatahome = array();

$data = getAllData("restaurantsview", " 1 =  1");

if ($data['count'] > 0) {

    echo json_encode(array("status" => "success", "restaurants" => $data['values']));
    
} else {

    echo json_encode(array("status" => "fail"));
}
