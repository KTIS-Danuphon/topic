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
$comment_id = $Encrypt->DeCrypt_pass($_POST['comment_id']);
$table = 'tb_comment_c t1 ';
$fields = 't1.* ';
$where = 'WHERE t1.fd_comment_id = "' . $comment_id . '"  AND t1.fd_comment_active = "1" ';
$where .= ' ORDER BY t1.fd_comment_id DESC ';
$data_comment_detail = $object->ReadData($table, $fields, $where);
function select_name_user($id_user, $object)
{
  //ค้นหาชื่อผู้ใช้งาน
  $table = 'tb_user_c ';
  $fields = 'fd_user_id,fd_user_fullname '; //todo จะเพิ่ม id ทำ tag a 
  $where = 'WHERE fd_user_id IN (' . $id_user . ')  ';
  $data_post = $object->ReadData($table, $fields, $where);
  return $data_post;
}
if (!empty($data_comment_detail)) {
  $response['success'] = true;
  $response['message'] = 'Post found';
  $response['data'] = $data_comment_detail[0]; // ส่งเฉพาะโพสต์เดียว
} else {
  $response['message'] = 'Post not found';
}

echo json_encode($response);
exit;
