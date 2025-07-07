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
$post_id = $Encrypt->DeCrypt_pass($_POST['post_id']);
$table = 'tb_posts_c t1 ';
$fields = 't1.*,t2.fd_user_fullname ';
$where = 'LEFT JOIN tb_user_c t2 ON t2.fd_user_id = t1.fd_post_user_create WHERE t1.fd_post_id = "' . $post_id . '" ';
if ($userStatus == 'executive') {
  $where .= ' AND t1.fd_post_active = "1"  ';
} else {
  $where .= ' AND t1.fd_post_active = "1" ';
}
$where .= ' ORDER BY t1.fd_post_id DESC ';
// $where = ' WHERE fd_user_name = "' . trim($PostUserName) . '" and fd_user_password = "' . md5($Encrypt->EnCrypt_pass($PostPassWord)) . '" and fd_user_active IN ("1") ';
$data_post_detail = $object->ReadData($table, $fields, $where);
// echo print_r($data_post);
function select_name_user($id_user, $object)
{
  //ค้นหาชื่อผู้ใช้งาน
  $table = 'tb_user_c ';
  $fields = 'fd_user_id,fd_user_fullname '; //todo จะเพิ่ม id ทำ tag a 
  $where = 'WHERE fd_user_id IN (' . $id_user . ')  ';
  $data_post = $object->ReadData($table, $fields, $where);
  // $names = array_column($data_post, 'fd_user_fullname'); // ดึงชื่อจากแต่ละแถว
  // $result = implode(',', $names) . ','; // รวมชื่อและต่อท้ายด้วยคอมม่า

  return $data_post;
}
if (!empty($data_post_detail)) {
  $response['success'] = true;
  $response['message'] = 'Post found';
  $response['data'] = $data_post_detail[0]; // ส่งเฉพาะโพสต์เดียว
} else {
  $response['message'] = 'Post not found';
}

echo json_encode($response);
exit;
