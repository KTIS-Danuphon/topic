<?php
session_start();
date_default_timezone_set('Asia/Bangkok');

$userID =  $_SESSION["TopicUserId"];
$userStatus =  $_SESSION["TopicUser_status"];
require_once '../class/crud.class.php';
$object = new CRUD();
require_once '../class/util.class.php';
$util = new Util();
require_once '../class/encrypt.class.php';
$Encrypt = new Encrypt_data();
$user_id = $Encrypt->DeCrypt_pass($_POST['user_id']);
$table = 'tb_user_c t1 ';
$fields = 't1.*,t2.fd_group_name ';
// $where = 'WHERE fd_user_active = "1"  ';
$where = 'LEFT JOIN tb_group_c071568 t2 ON t2.fd_group_id = t1.fd_user_group WHERE fd_user_id = "' . $user_id . '"  ';
// $where = ' WHERE fd_user_name = "' . trim($PostUserName) . '" and fd_user_password = "' . md5($Encrypt->EnCrypt_pass($PostPassWord)) . '" and fd_user_active IN ("1") ';
$data_user_detail = $object->ReadData($table, $fields, $where);

$table = 'tb_group_c071568 ';
$fields = 'fd_group_id, fd_group_name ';
$where = 'WHERE fd_group_active = "1" ';
$data_group = $object->ReadData($table, $fields, $where);

if (!empty($data_user_detail)) {
  $data_user_detail[0]['fd_user_id'] = $_POST['user_id'];
  $response['success'] = true;
  $response['data'] = $data_user_detail[0]; // ส่งเฉพาะโพสต์เดียว
  $response['data_group'] = $data_group;
} else {
  $response['message'] = 'User not found';
}

echo json_encode($response);
exit;
