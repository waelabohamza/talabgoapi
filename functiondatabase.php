<?php

//=====================================================================
// جميع الحقوق محفوظة للمهندس وائل احمد ابو حمزه 
// 
//  CopyRight By Wael Abu Hamza
//=====================================================================

// date_default_timezone_set('Asia/Beirut');
date_default_timezone_set('Asia/Kuwait');

define('KB', 1024);
define('MB', 1048576);
define('GB', 1073741824);
define('TB', 1099511627776);

$now = date('Y-m-d H:i:s', time());

function superFilter($var)
{
    return  htmlspecialchars(strip_tags(trim($var)));
}
function checkLength($name, $str, $min, $max)
{
    global  $msgerrors;
    if (strlen($str) > $max) {
        $msgerrors[] = $name  . " Can't To be more than " . $max  .  "  letter  or number";
    }
    if (strlen($str) < $min) {
        $msgerrors[] = $name . "   Can't To be less than  " . $min . " letter or number ";
    }
}

function getAllData($table, $where = null, $values = null, $and = null)
{
    global $con;
    $data = array();
    $stmt = $con->prepare("SELECT  * FROM $table WHERE   $where  $and ");
    $stmt->execute($values);
    $values = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $count  = $stmt->rowCount();
    $data['values'] = $values;
    $data['count'] = $count;
    return $data;
}
function insertData($table, $data)
{
    global $con;
    foreach ($data as $field => $v)
        $ins[] = ':' . $field;
    $ins = implode(',', $ins);
    $fields = implode(',', array_keys($data));
    $sql = "INSERT INTO $table ($fields) VALUES ($ins)";

    $stmt = $con->prepare($sql);
    foreach ($data as $f => $v) {
        $stmt->bindValue(':' . $f, $v);
    }
    $stmt->execute();
    $count = $stmt->rowCount();
    return $count;
}


function updateData($table, $data, $where)
{
    global $con;
    $cols = array();
    $vals = array();

    foreach ($data as $key => $val) {
        $vals[] = "$val";
        $cols[] = "`$key` =  ? ";
    }
    $sql = "UPDATE $table SET " . implode(', ', $cols) . " WHERE $where";

    $stmt = $con->prepare($sql);
    $stmt->execute($vals);
    $count = $stmt->rowCount();
    return $count;
}

function deleteData($table, $col, $value, $and = null)
{
    global $con;
    $stmt = $con->prepare("DELETE FROM $table WHERE $col  = ?  $and ");
    $stmt->execute(array($value));
    $count = $stmt->rowCount();
    return $count;
}
// ==============

function getData($table, $where, $value, $and = NULL)
{

    global $con;

    $data = array();

    $stmt = $con->prepare("SELECT * FROM $table WHERE $where = ? $and  ");

    $stmt->execute(array($value));

    $count = $stmt->rowCount();

    $item = $stmt->fetch(PDO::FETCH_ASSOC);

    $data['count'] = $count;
    $data['values'] = $item;

    return $data;
}

function getDataColumn($table, $columnname, $where, $value, $and = NULL)
{

    global $con;

    $stmt = $con->prepare("SELECT $columnname FROM $table WHERE $where = ? $and  ");

    $stmt->execute(array($value));

    $data = $stmt->fetchColumn();

    return $data;
}


function paginationLimit($getpage, $countrow)
{
    //  CountRow :  Number Items view In Evey Page
    if ($getpage != null) {
        $page = $getpage;
        $limit = "LIMIT $page , $countrow";
    } else {
        $limit = null;
    }
    return $limit;
}

function filterResualt($get, $column)
{

    if (isset($get) && $get != null) {

        $and = "AND   $column  = '$get'  ";
    } else {

        $and = null;
    }

    return $and;
}

function createJson($count, $values)
{
    if ($count > 0) {
        echo json_encode($values);
    } else {
        zeroCount();
    }
}

// ===========================

function countCoulmn($column, $table, $where = null)
{
    global $con;
    $stmt = $con->prepare("SELECT COUNT($column) FROM $table 
    $where ");
    $stmt->execute();
    $countcolumn = $stmt->fetchColumn();
    return $countcolumn;
}

function maxId($column, $table)
{
    global $con;
    $stmt = $con->prepare("SELECT MAX($column) FROM $table  ");
    $stmt->execute();
    $maxid = $stmt->fetchColumn();
    return $maxid;
}

//===========================

function signInWithEmailAndPassword($table, $columnemail, $columnpassword, $email, $password, $and = null)
{
    global $con;
    $stmt = $con->prepare("SELECT * FROM $table WHERE $columnemail = ? AND $columnpassword = ? $and ");
    $stmt->execute(array($email, $password));
    $user  = $stmt->fetch(PDO::FETCH_ASSOC);
    $data = array();
    $data['values'] = $user;
    $data['count'] = $stmt->rowCount();
    return $data;
}



//===========================

function deleteFile($dir , $image){
    if (file_exists($dir . "/" . $image)) {
        unlink( $dir . "/" . $image);
    }
}
 
// ==========================
//  count fail or success
// ==========================

function zeroCount()
{
    echo json_encode(array(0 => "fail"));
}

function failCount()
{
    echo json_encode(array("status" => "fail"));
}
function successCount()
{
    echo json_encode(array("status" => "success"));
}


function countresault($count, $data = null)
{
    if ($count  > 0) {
        echo json_encode(array("status" => "success"));
    } else {
        if ($data != null) {
            echo json_encode(array("status" => "fail", "error" => $data));
        } else {
            echo json_encode(array("status" => "fail"));
        }
    }
}





// Send Email 

function sendEmail($email, $title, $body)
{
    $to         = $email;
    $subject    = $title;
    $txt        = $body;
    $headers    = "From: Support@TalabGo.com" . "\r\n" .
        "CC: ddd@ddd.com";
    mail($to, $subject, $txt, $headers);
}


















//=================================================================================
// SEND NOTIFY FOR USERS AND RESTURSANTS AND DELIVERY AND TAXI AND ADMIN  Specifc
//====================================================================================

//===============================================
// Token Insert And Delete
//===============================================
function insertToken($sid, $token, $type)
{
    global $con;
    $check = $con->prepare("SELECT * FROM tokens WHERE tokens_sid = ? AND tokens_token = ?");
    $check->execute(array($sid, $token));
    $checkcount = $check->rowCount();
    if ($checkcount == 0) {
        $sql  = "INSERT INTO `tokens`(`tokens_token`,`tokens_sid` , `tokens_type`) VALUES (? , ? , ?)";
        $stmt = $con->prepare($sql);
        $stmt->execute(array($token, $sid, $type));
        $count = $stmt->rowCount();
        return $count;
    }
}
function deleteToken($sid, $token, $type)
{
    global $con;
    $check = $con->prepare("SELECT * FROM tokens WHERE tokens_sid = ? AND tokens_token = ? AND tokens_type = ?");
    $check->execute(array($sid, $token, $type));
    $checkcount = $check->rowCount();
    if ($checkcount > 0) {
        $sql  = "DELETE FROM `tokens` WHERE tokens_sid = ? AND tokens_token = ? ";
        $stmt = $con->prepare($sql);
        $stmt->execute(array($sid, $token));
        $count = $stmt->rowCount();
        return $count;
    }
}
//===========================================================

// ====================================================================================
//  SEND NOTEFICATION API
//=====================================================================================

function sendGCM($title, $message, $fcm_id, $pageid, $pagename, $topic = null)
{
    //$message = utf8_decode($message);

    $url = 'https://fcm.googleapis.com/fcm/send';

    if ($topic  == null) {

        $fields = array(
            'registration_ids' => array(
                $fcm_id
            ),
            'priority' => 'high',
            'content_available' => true,

            'notification' => array(
                "body" =>  $message,
                "title" =>  $title,
                "click_action" => "FLUTTER_NOTIFICATION_CLICK",
                "sound" => "default"

            ),
            'data' => array(
                "pageid" => $pageid,
                "pagename" => $pagename
                //			'message' => 'Hello World!'
            )

        );

    } else {
        $fields = array(
            "to" => '/topics/'.$topic,
            'priority' => 'high',
            'content_available' => true,

            'notification' => array(
                "body" =>  $message,
                "title" =>  $title,
                "click_action" => "FLUTTER_NOTIFICATION_CLICK",
                "sound" => "default"

            ),
            'data' => array(
                "pageid" => $pageid,
                "pagename" => $pagename
                //			'message' => 'Hello World!'
            )

        );
    }



    $fields = json_encode($fields);
    $headers = array(
        // 'Authorization: key=' . "AIzaSyBUuLepXI4xjIuWBO78hagHX9ntj9j_mU4",
        'Authorization: key=' . "AAAAtjxA1VY:APA91bFRwt6Ea_0VJl-Cl71ZbxKF6K2fZlEiLp3SN5IVSaCfGgUYEoh8gaVDebBwHv-DC_mpN_OJf10QHbo2t-fnSPy-zTvwzNfqz6dOZbnC2peQ1dB7YTh6au_n_OXxCjvUqPRXlazB",
        'Content-Type: application/json'
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

    $result = curl_exec($ch);
    return $result;
    curl_close($ch);
}



function sendNotifySpecificUser($userid, $title, $message, $p_id, $p_name)
{
    global $con;
    $stmt = $con->prepare("SELECT users.users_id , tokens.* FROM users
                         INNER JOIN tokens ON tokens.tokens_sid = users.users_id
                         WHERE users.users_id = ? And tokens_type = 'users' ");
    $stmt->execute(array($userid));
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($users as $user) {
        sendGCM($title, $message, $user['tokens_token'], $p_id, $p_name);
    }
    insertNotifySpecifcCatInDatabase($title, $message, "users", $userid);
    insertmessagebadgesUsers($userid);
}



function sendNotifySpecificDelviery($deliveryid, $title, $message, $p_id, $p_name)
{
    global $con;
    $stmt = $con->prepare("SELECT delivery.delivery_id , tokens.* FROM  delivery
    INNER JOIN tokens ON tokens.tokens_sid = delivery.delivery_id
    WHERE delivery.delivery_id = ? AND tokens_type = 'delivery'
    ");

    $stmt->execute(array($deliveryid));

    $deliverys = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($deliverys as $delivery) {
        sendGCM($title, $message, $delivery['tokens_token'], $p_id, $p_name);
    }
    insertNotifySpecifcCatInDatabase($title, $message, "delivery", $deliveryid);
}



function sendNotifySpecificRes($resid, $title, $message, $p_id, $p_name)
{
    global $con;
    $stmt = $con->prepare("SELECT restaurants.restaurants_id , tokens.* FROM restaurants
                           INNER JOIN tokens ON tokens.tokens_sid = restaurants.restaurants_id
                           WHERE restaurants.restaurants_id = ? AND tokens_type = 'restaurants'
                        ");
    $stmt->execute(array($resid));
    $ress = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($ress as $res) {
        sendGCM($title, $message, $res['tokens_token'], $p_id, $p_name);
    }
    insertNotifySpecifcCatInDatabase($title, $message, "restaurants", $resid);
}




//=======================================================================================
// Insert All NOTIFY FOR USERS AND RESTURSANTS AND DELIVERY AND TAXI AND ADMIN In DATABASE 
//========================================================================================





function insertNotifySpecifcCatInDatabase($title, $body, $cat, $sid)
{
    global $con;
    global $now;
    $stmt = $con->prepare("INSERT INTO `message`(
    `message_title`,
    `message_body`,
    `message_cat` , 
    `message_sid` , 
    `message_time`
)
VALUES(? ,  ? ,   ?  ,  ? , ? )");
    $stmt->execute(array($title, $body, $cat, $sid, $now));
}

function insertmessagebadgesUsers($sid)
{
    $checksid = getData("badges", "badges_sid", $sid);
    if ($checksid['count'] > 0) {
        $data = array(
            "badges_count" =>    1 + intval($checksid['values']['badges_count']),
        );
        updateData("badges", $data, "badges_sid = '$sid' AND badges_type = 'users'");
    } else {
        $data = array(
            "badges_sid"     => $sid,
            "badges_count"   =>  1,
            "badges_type"    =>  "users"
        );
        insertData("badges", $data);
    }
}

//===========================================================
// Bill invoice statement account 
//===========================================================

function bill($price, $userid, $type, $title, $body, $cat)
{
    global $con;
    global $now;
    $stmt = $con->prepare("INSERT INTO `bill`(`bill_price`, `bill_sid`, `bill_type`, `bill_date`, `bill_title`, `bill_body` , `bill_cat`)
                         VALUES (? , ? , ? , ? , ? , ? , ?)");
    $stmt->execute(array($price, $userid, $type,  $now, $title, $body, $cat));
    $count = $stmt->rowCount();
    return $count;
}



// Money 

function removeMoneyById($table, $columnprice,  $price, $column_id, $valueid)
{
    global $con;
    $stmt = $con->prepare("UPDATE $table SET $columnprice = $columnprice - $price WHERE $column_id = ?  ");
    $stmt->execute(array($valueid));
    $count = $stmt->rowCount();
    return $count;
}

function addMoneyById($table, $columnprice,  $price, $column_id, $valueid)
{
    global $con;
    $stmt = $con->prepare("UPDATE $table SET $columnprice = $columnprice + $price WHERE $column_id = ?  ");
    $stmt->execute(array($valueid));
    $count = $stmt->rowCount();
    return $count;
}

function getInfoUserByPhone($phone)
{

    global $con;

    $stmt = $con->prepare("SELECT  users.users_id , users.users_name    FROM  `users`  WHERE users_phone = ? ");

    $stmt->execute(array($phone));

    $values  = $stmt->fetch(PDO::FETCH_ASSOC);

    return $values;
}








// ======================================
//  Image Upload Function 
// ======================================



function image_data($imagerequset)
{
    global  $msgerrors;
    $imagename          = $_FILES[$imagerequset]['name'];
    $imagetype          = $_FILES[$imagerequset]['type'];
    $imagetmp           = $_FILES[$imagerequset]['tmp_name'];
    $imagesize          = $_FILES[$imagerequset]['size'];
    $allowextention     = array("jpg", "png", "jpeg", "gif", "pdf");
    $strtoarray         = explode(".", $imagename);
    $imageextentionone  = end($strtoarray);
    $imageextension     = strtolower($imageextentionone);
    if (!empty($imagename) && !in_array($imageextension, $allowextention)) {
        $msgerrors[] = "File Not Image";
    }
    if ($imagesize > 10 * MB) {
        $msgerrors[] = "can't upload File larger than 10 mb ";
    }
    if (empty($imagename)) {
        $msgerrors[] = "Not exist File";
    }
    $image = array();
    $image['name'] = $imagename;
    $image['tmp'] =  $imagetmp;
    return  $image;
}



function edit_image($imagename, $imageold, $imagetmp, $directory)
{

    if (!empty($imagename)) {
        $image = rand(0, 10000) . "_" . $imagename;
        if (file_exists($directory . $imageold) && $imageold != "") {
            unlink($directory . $imageold);
        }
        move_uploaded_file($imagetmp, $directory . $image);
    } else {
        $image = $imageold;
    }
    return $image;
}


function image_data_multiple($imagerequset)
{
    global  $msgerrors;
    $imagename          = $_FILES[$imagerequset]['name'];
    $imagetype          = $_FILES[$imagerequset]['type'];
    $imagetmp           = $_FILES[$imagerequset]['tmp_name'];
    $imagesize          = $_FILES[$imagerequset]['size'];
    $numberarray = count($imagename);
    $allowextention     = array("jpg", "png", "jpeg", "gif");
    $image = array();


    for ($i = 0; $i < $numberarray; $i++) {

        $strtoarray[$i]         = explode(".", $imagename[$i]);
        $imageextentionone[$i]  = end($strtoarray[$i]);
        $imageextension[$i]     = strtolower($imageextentionone[$i]);
        if (!empty($imagename[$i]) && !in_array($imageextension[$i], $allowextention)) {
            $msgerrors[] = "this is file "  . $imagename[$i] . " Not Image ";
        }

        if ($imagesize[$i] > 10 * MB) {

            $msgerrors[] =  "this is file "  . $imagename[$i] . " larger Than 10 Mega ";
        }
        $image[$i]['name'] = $imagename[$i];
        $image[$i]['tmp'] =  $imagetmp[$i];
    }


    return  $image;
}


function image_upload_multiple($imagemultipe, $filedir , $numbercat,  $columnname , $columncat , $table)
{
    for ($n = 0; $n < count($imagemultipe); $n++) {
        $imagename[$n] = $imagemultipe[$n]["name"];
        if (!$imagemultipe[$n]["name"] == "") {
            $imagetmp[$n]  = $imagemultipe[$n]["tmp"];
            move_uploaded_file($imagetmp[$n], $filedir . "/" . $imagename[$n]);
            $data = array(
                "$columnname"  => $imagename[$n],
                "$columncat" => $numbercat
            );
            insertData($table, $data);
        }
    }
}


 

  //==================================================
  // End Functions Upload 
  //==================================================