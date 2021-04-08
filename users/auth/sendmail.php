<?php
include "../../connect.php" ; 
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $email = $_POST['email'];

    $data = getData("users", "users_email",  $email);

    $user = $data['values'];

    $count = $data['count'];

    if ($count > 0) {

        $code = $user['users_verfiy'];

        $to         = $email;
        $subject    = "Reset Password";
        $txt        = "Verfiy Code is " . $code;
        $headers    = "From: ResetPassword@SideShow.com" . "\r\n" .
            "CC: ddd@ddd.com";
        mail($to, $subject, $txt, $headers);
        echo json_encode(array("status" => "success"));
    } else {
        echo json_encode(array("status" => "fail"));
    }
} else {
    echo json_encode(array("status" => "fail"));
}
