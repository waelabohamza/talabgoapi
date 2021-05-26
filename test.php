<?php

include "connect.php" ; 
$resid = "13" ; 
$title = "a" ; 
$body = "a" ; 
sendGCM($title , $body , "" , "" , "Dordersscreen" , "delivery$resid");