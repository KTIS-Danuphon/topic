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
$table = 'tb_user_c t1 ';
$fields = 't1.*,t2.fd_group_name ';
// $where = 'WHERE fd_user_active = "1"  ';
$where = 'LEFT JOIN tb_group_c071568 t2 ON t2.fd_group_id = t1.fd_user_group ';

if ($userStatus == 'executive') {

  // $where = ' WHERE fd_user_name = "' . trim($PostUserName) . '" and fd_user_password = "' . md5($Encrypt->EnCrypt_pass($PostPassWord)) . '" and fd_user_active IN ("1") ';
  $data_user = $object->ReadData($table, $fields, $where);

  // ส่งข้อมูลกลับในรูปแบบ HTML
  $count_i = 1;
  foreach ($data_user as $user) {
    $user_id = $Encrypt->EnCrypt_pass($user['fd_user_id']);
    echo '<tr id="' . $user_id . '">';
    // echo '<td>' . $count_i . '</td>';
    echo      '<td>';
    if (!empty($user['fd_user_email'])) {
      echo ' <h5 class="mb-1">' . $user['fd_user_fullname'] . '</h5>
           <p class="text-muted f-12 mb-0">' . $user['fd_user_email'] . '</p>';
    } else {
      echo '<h5 class="mb-1">' . $user['fd_user_fullname'] . '</h5>';
    }
    echo '</td>';
    echo '<td>' . $user['fd_user_position'] . '</td>';
    echo '<td>' . $user['fd_group_name'] . '</td>';
    echo '<td>' . $user['fd_user_status'] . '</td>';
    if ($user['fd_user_active'] == '1') {
      echo '<td><span class="badge bg-light-success rounded-pill f-12">ใช้งาน</span> </td>';
    } else {
      echo '<td><span class="badge bg-light-danger rounded-pill f-12">ปิดใช้งาน</span> </td>';
    }
    echo '<td class="text-center">
                        <ul class="list-inline me-auto mb-0">
                          <!-- <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" title="View">
                            <a href="#" class="avtar avtar-xs btn-link-secondary" data-bs-toggle="modal"
                              data-bs-target="#user-modal">
                              <i class="ti ti-eye f-18"></i>
                            </a>
                          </li> -->
                          <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" title="Edit" onclick="EditUser(\'' . $user_id . '\')">
                            <a href="#" class="avtar avtar-xs btn-link-primary" data-bs-toggle="modal"
                              data-bs-target="#user-edit_add-modal">
                              <i class="ti ti-edit-circle f-18"></i>
                            </a>
                          </li>
                          <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" title="User off" onclick="CloseUser(\'' . $user_id . '\')">
                            <a href="#" class="avtar avtar-xs btn-link-danger">
                              <i class="ti ti-user-off f-18"></i>
                            </a>
                          </li>
                        </ul>
                      </td>
                    </tr>';
    $count_i++;
  }
} else {
  // echo '<tr><td colspan="6" class="text-center">ไม่มีข้อมูล</td></tr>';
  echo '';
}
