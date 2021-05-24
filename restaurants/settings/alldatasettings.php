<?php

include "../../connect.php";


$resid = superFilter($_POST['resid']);


$data = getData("restaurants", "restaurants_id", $resid)['values'];


echo json_encode($data);
