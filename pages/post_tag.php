<?php
session_start();
date_default_timezone_set('Asia/Bangkok');
require_once '../class/crud.class.php';
$object = new CRUD();
require_once '../class/util.class.php';
$util = new Util();
require_once '../class/encrypt.class.php';
$Encrypt = new Encrypt_data();
if ($_SESSION["TopicUserId"]) {
    $userID =  $_SESSION["TopicUserId"];
    $userStatus =  $_SESSION["TopicUser_status"];

    $table = 'tb_user_c';
    $fields = 'fd_user_id AS inpost_user_id, fd_user_fullname AS inpost_user_name';
    if (isset($_GET['tag_in_post'])) {

        $where = 'WHERE fd_user_active = "1" ';
        $data = $object->ReadData($table, $fields, $where);
        echo json_encode($data);
    }

    if (isset($_GET['tag_other'])) {

        $where = 'WHERE fd_user_id != '.$userID.' AND fd_user_status = "user" AND fd_user_active = "1" ';
        $data = $object->ReadData($table, $fields, $where);
        echo json_encode($data);
    }
} else {
    header("location:../");
}





exit;
