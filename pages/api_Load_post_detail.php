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
$where = 'LEFT JOIN tb_user_c t2 ON t2.fd_user_id = t1.fd_post_user_create WHERE t1.fd_post_id = ' . $post_id . ' ';
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

function select_count_conment($post_id, $object)
{
  //ค้นหาชื่อผู้ใช้งาน
  $table = 'tb_comment_c ';
  $fields = 'count(*) AS count_conment '; //todo จะเพิ่ม id ทำ tag a 
  $where = 'WHERE fd_post_id = ' . $post_id . ' AND fd_comment_active = "1"  ';
  $data_post = $object->ReadData($table, $fields, $where);
  $count_comment = $data_post[0]['count_conment'];
  return $count_comment;
}

// ส่งข้อมูลกลับในรูปแบบ HTML
foreach ($data_post_detail as $post) {
  if (!empty($post['fd_post_tag'])) {
    $post_tag = select_name_user($post['fd_post_tag'], $object);
  } else {
    $post_tag = '';
  }
  echo ' <div class="card-header">
                <div class="d-flex">
                  <div class="flex-shrink-0">
                    <img src="../assets/images/user/avatar-2.jpg" alt="user-image" class="wid-40 rounded-circle">
                  </div>
                  <div class="flex-grow-1 mx-3">
                    <h6 class="mb-1">' . $post['fd_user_fullname'] . '</h6>
                    <p class="text-muted text-sm mb-0">Manager IT</p>
                  </div>';
  switch ($post['fd_post_status']) {

    case 'todo':
      echo '<div class="dropdown"><span id="post_status_' . $post['fd_post_id'] . '"><span class="badge bg-light-danger rounded-pill f-12"><b>ต้องทำ</b></span></span> <a class="avtar avtar-s btn-link-secondary dropdown-toggle arrow-none" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
      break;
    case 'doing':
      echo '<div class="dropdown"><span id="post_status_' . $post['fd_post_id'] . '"><span class="badge bg-light-primary rounded-pill f-12"><b>ดำเนินการ</b></span></span> <a class="avtar avtar-s btn-link-secondary dropdown-toggle arrow-none" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
      break;
    case 'success':
      echo '<div class="dropdown"><span id="post_status_' . $post['fd_post_id'] . '"><span class="badge bg-light-success rounded-pill f-12"><b>เสร็จสิน</b></span></span> <a class="avtar avtar-s btn-link-secondary dropdown-toggle arrow-none" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
      break;
  }
  echo ' <i class="ti ti-dots-vertical f-18"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                      <a class="dropdown-item" href="#" onclick="loadPosts()">ประวัติการแก้ไข</a>';
  // <a class="dropdown-item" href="#">แก้ไข</a>
  if ($userID == $post['fd_post_user_create']) {
    echo '<a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#edit-post-modal" onclick="EditPost(\'' . $Encrypt->EnCrypt_pass($post['fd_post_id']) . '\')">แก้ไข</a>';
  } else if ($userStatus == "executive") {
    echo '<a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#edit-post-modal" onclick="EditPost(\'' . $Encrypt->EnCrypt_pass($post['fd_post_id']) . '\')">แก้ไข(สิทธ์ผู้บริหาร)</a>';
  }

  echo '<a class="dropdown-item" onclick="removeCardWithEffect(\'' . $Encrypt->EnCrypt_pass($post['fd_post_id']) . '\')">ส่งโพสต์ไปถังขยะ</a>';
  echo '</div>
                  </div>
                </div>
              </div>
               <div class="card-body" id="post_content_' . $post['fd_post_id'] . '">
                <h5>' . $post['fd_post_title'] . '</h5>
                <p class="mb-4">' . $post['fd_post_content'] . '</p>';
  if ($post['fd_post_file']) {
    echo '<div class="row g-2">
                                  <div class="col-sm-12">
                                      <div class="d-inline-flex align-items-center justify-content-start w-100">
                                          <i class="ti ti-file-symlink"></i>
                                          <a href="' . $post['fd_post_file'] . '" class="link-primary text-truncate">
                                              <p class="mb-0 ms-2 text-truncate">' . $post['fd_post_file'] . '</p>
                                          </a>
                                      </div>
                                  </div>
                              </div>';
  }
  if (!empty($post_tag)) {
    echo '<div class="mt-3"><span class="">ผู้ที่ได้รับการแท็ก : </span>';
    foreach ($post_tag as $tag) {
      if (trim($tag['fd_user_fullname']) !== '') {
        echo '<a href="farmer.php?id=' . $tag['fd_user_id'] . '" target="_blank"><span class="badge bg-light-secondary border border-secondary bg-transparent f-14 me-1 mt-1">' . htmlspecialchars($tag['fd_user_fullname']) . '</span> </a>';
      }
    }
  } else {
    echo '<div class="mt-3">';
  }

  // echo '<span class="badge bg-light-secondary border border-secondary bg-transparent f-14 me-1 mt-1">ผู้บริหาร</span>';

  echo '</div>';
  echo ' </div>
              <div class="card mb-2 shadow-sm">
                <div class="card-body py-2 px-3 d-flex align-items-center justify-content-between">

                  <!-- ด้านซ้าย: วันที่โพสต์ -->
                  <div class="text-muted" style="font-size: 14px; margin-left:1%">
                    <i class="ti ti-clock me-1"></i> โพสต์เมื่อ ' . $post['fd_post_time_create'] . '
                  </div>

                  <!-- ด้านขวา: จำนวนความคิดเห็น -->
                  <div class="text-muted d-flex align-items-center" style="font-size: 14px; margin-right:1%;cursor: pointer;" onclick="scroll_down()">
                    <i class="ti ti-message-circle me-1" style="font-size: 18px;"></i><span id="count_comment">&nbsp;' . select_count_conment($post_id, $object) . '&nbsp;</span> ความคิดเห็น
                  </div>

                </div>
              </div>';
}
