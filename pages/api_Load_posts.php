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
$table = 'tb_posts_c t1 ';
$fields = 't1.*,t2.* ';
$where = 'LEFT JOIN tb_user_c t2 ON t2.fd_user_id = t1.fd_post_user_create  ';
if ($userStatus == 'executive') {
  $where .= 'WHERE fd_post_active = "1" ';
} else {
  $where .= 'WHERE (FIND_IN_SET(' . intval($userID) . ',fd_post_tag) > 0 OR fd_post_user_create = ' . $userID . ' ) AND fd_post_active = "1" ';
}
$where .= ' ORDER BY fd_post_time_create DESC ';
// $where = ' WHERE fd_user_name = "' . trim($PostUserName) . '" and fd_user_password = "' . md5($Encrypt->EnCrypt_pass($PostPassWord)) . '" and fd_user_active IN ("1") ';
$data_post = $object->ReadData($table, $fields, $where);

// รับค่าที่ส่งมาจาก JS
$offset = isset($_POST['offset']) ? intval($_POST['offset']) : intval($_POST['offset_new']);
$limit = isset($_POST['limit']) ? intval($_POST['limit']) : intval($_POST['limit_new']);

// ตัด array ตาม offset/limit
$posts = array_slice($data_post, $offset, $limit);

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
foreach ($posts as $post) {
  $title = htmlspecialchars($post['fd_post_title']);
  $content = $post['fd_post_content'];
  if (!empty($post['fd_post_tag'])) {
    $post_tag = select_name_user($post['fd_post_tag'], $object);
  } else {
    $post_tag = '';
  }
  // $tags = array_filter(explode(',', $post_tag)); // สมมติเป็น ID หรือชื่อ, แล้วแสดงเป็น badge
  $time_create = nl2br(htmlspecialchars($post['fd_post_time_create']));

  echo '<div class="col-md-12 col-xl-12" id="post_id_' . $Encrypt->EnCrypt_pass($post['fd_post_id']) . '">
        <div class="card">
          <div class="card-header">
            <div class="d-flex">
              <div class="flex-shrink-0">
                <img src="../assets/images/user/avatar-2.jpg" alt="user-image" class="wid-40 rounded-circle">
              </div>
              <div class="flex-grow-1 mx-3">
                <h6 class="mb-1 fs-6 text-muted">' . htmlspecialchars($post['fd_user_fullname']) . '</h6>
                <p class="text-muted text-sm mb-0">' . htmlspecialchars($post['fd_user_position']) . '</p>
              </div>
             

              <div class="dropdown"><span id="post_status_' . $post['fd_post_id'] . '">';
  switch ($post['fd_post_status']) {
    case "success":
      echo '<span class="badge bg-light-success rounded-pill f-12"><b>เสร็จสิ้น</b></span>';
      break;
    case "doing":
      echo '<span class="badge bg-light-primary rounded-pill f-12"><b>ดำเนินการ</b></span>';
      break;
    case "todo":
      echo '<span class="badge bg-light-danger rounded-pill f-12"><b>ต้องทำ</b></span>';
      break;
  }
  //  <span class="badge bg-light-success rounded-pill f-12"><b>เสร็จสิ้น</b></span> 
  // <span class="badge bg-light-success rounded-pill f-12">เสร็จ</span>
  // <span class="badge bg-light-primary rounded-pill f-12">กำลังทำ</span>
  // <span class="badge bg-light-danger rounded-pill f-12">ล้มเหลว</span>
  // <span class="badge bg-light-warning rounded-pill f-12">ต้องทำ</span>
  echo ' </span><a class="avtar avtar-s btn-link-secondary dropdown-toggle arrow-none" href="#"
                  data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="ti ti-dots-vertical f-18"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                  <a class="dropdown-item" href="detail_post.php?post=' . $Encrypt->EnCrypt_pass($post['fd_post_id']) . '" target="_blank">แสดรายละเอียด</a>
                  <!-- <a class="dropdown-item" href="#">Share</a> -->';
  if ($userID == $post['fd_post_user_create']) {
    echo '<a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#edit-post-modal" onclick="EditPost(\'' . $Encrypt->EnCrypt_pass($post['fd_post_id']) . '\')">แก้ไข</a>
          <a class="dropdown-item" onclick="removeCardWithEffect(\'post_id_' . $Encrypt->EnCrypt_pass($post['fd_post_id']) . '\')" style="cursor: pointer;">ส่งโพสต์ไปถังขยะ</a>';
  } else if ($userStatus == "executive") {
    echo '<a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#edit-post-modal" onclick="EditPost(\'' . $Encrypt->EnCrypt_pass($post['fd_post_id']) . '\')">แก้ไข(สิทธ์ผู้บริหาร)</a>
          <a class="dropdown-item" onclick="removeCardWithEffect(\'post_id_' . $Encrypt->EnCrypt_pass($post['fd_post_id']) . '\')" style="cursor: pointer;">ส่งโพสต์ไปถังขยะ(สิทธ์ผู้บริหาร)</a>';
  }
  echo '
                </div>
              </div>
            </div>
          </div>
          <div class="card-body" id="post_content_' . $post['fd_post_id'] . '">
            <h5 class="fs-4 fw-bold text-dark">' . $title . '</h5>
            <label>' . htmlspecialchars_decode($content) . '&nbsp;</label>';

  if (!empty($post['fd_post_file'])) {
    $files = explode(",", $post['fd_post_file']); // แยกไฟล์ออกมาเป็น array

    // !ทดสอบแสดงรูป
    $total = count($files); //ไฟล์ทั้งหมด
    $index = 0;
    $total_img = 0;
    foreach ($files as $file) {
      $file = trim($file);
      if (!preg_match('/\.(jpg|jpeg|png)$/i', $file)) {
        $total_img++;
      }
    }
    echo '<div class="row mt-2 justify-content-center">';

    foreach ($files as $file) {
      $file = trim($file);
      if (!preg_match('/\.(jpg|jpeg|png)$/i', $file)) {
        continue;
      }
      $index++;
      $enc = $Encrypt->EnCrypt_pass($file);

      // เคส 1 รูป
      if ($total == 1) {
        echo '
        <div class="col-auto">
            <a href="OpenFile_link.php?key=' . $enc . '" target="_blank">
                <img src="OpenFile_show.php?key=' . $enc . '" 
                     class="img-thumbnail" 
                     style="max-width:300px; transition:0.3s; cursor:zoom-in;">
            </a>
        </div>';
      }

      // เคส 2 รูป → ซ้าย + ขวา
      elseif ($total == 2) {
        echo '
        <div class="col-6 text-center">
            <a href="OpenFile_link.php?key=' . $enc . '" target="_blank">
                <img src="OpenFile_show.php?key=' . $enc . '" 
                     class="img-thumbnail w-100" 
                     style="max-height:300px; object-fit:cover; transition:0.3s; cursor:zoom-in;">
            </a>
        </div>';
      }

      // เคส 3 รูปขึ้นไป
      else {
        // แสดงแค่ 2 รูปแรก
        if ($index <= 1) {
          echo '
            <div class="col-6 text-center">
                <a href="OpenFile_link.php?key=' . $enc . '" target="_blank">
                    <img src="OpenFile_show.php?key=' . $enc . '" 
                         class="img-thumbnail w-100" 
                         style="max-height:300px; object-fit:cover; transition:0.3s; cursor:zoom-in;">
                </a>
            </div>';
        }
        // ที่รูปที่ 3 → overlay +X
        else if ($index == 3) {
          $remain = $total_img - 1;
          echo '
            <div class="col-6 position-relative text-center">
                <a  href="detail_post.php?post=' . $Encrypt->EnCrypt_pass($post['fd_post_id']) . '" target="_blank">
                    <img src="OpenFile_show.php?key=' . $enc . '" 
                         class="img-thumbnail w-100" 
                         style="max-height:300px; object-fit:cover;">
                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center"
                         style="background:rgba(0,0,0,0.5); color:white; font-size:2rem; font-weight:bold; border-radius:.375rem;">
                         +' . $remain . '
                    </div>
                </a>
            </div>';
          break; // ไม่ต้องวน loop ต่อ
        }
      }
    }
    echo '</div>';
    // !ทดสอบแสดงรูป

    // foreach ($files as $file) {
    //   $file = trim($file); // กันช่องว่างเกินมา

    //   if (preg_match('/\.(jpg|jpeg|png)$/i', $file)) {
    //     echo ' <!-- รูปที่แนบมา -->
    //             <div class="row mt-2 justify-content-center">
    //             <div class="col-auto">
    //                 <a href="OpenFile_link.php?key=' . $Encrypt->EnCrypt_pass($file) . '" target="_blank">
    //                     <img src="OpenFile_show.php?key=' . $Encrypt->EnCrypt_pass($file) . '" alt="แนบมา" class="img-thumbnail"
    //                         style="max-width: 300px; transition: 0.3s; cursor: zoom-in;">
    //                 </a>
    //             </div>
    //             </div>';
    //   } else if (preg_match('/\.(pdf)$/i', $file)) {
    //     echo ' <!-- ไฟล์ PDF แนบ -->
    //             <div class="mt-2 d-flex align-items-center bg-white border rounded p-2" style="max-width: 300px;">
    //                 <i class="bi bi-file-earmark-pdf text-danger me-2" style="font-size: 20px;"></i>
    //                 <a href="OpenFile_link.php?key=' . $Encrypt->EnCrypt_pass($file) . '" target="_blank" class="text-decoration-none">
    //                     ไฟล์แนบ.pdf
    //                 </a>
    //             </div>';
    //   } else if (preg_match('/\.(doc|docx)$/i', $file)) {
    //     echo ' <!-- ไฟล์ WORD แนบ -->
    //             <div class="mt-2 d-flex align-items-center bg-white border rounded p-2" style="max-width: 300px;">
    //                 <i class="bi bi-file-earmark-word text-danger me-2" style="font-size: 20px;"></i>
    //                 <a href="OpenFile_link.php?key=' . $Encrypt->EnCrypt_pass($file) . '" target="_blank" class="text-decoration-none">
    //                     ไฟล์แนบ.doc
    //                 </a>
    //             </div>';
    //   } else if (preg_match('/\.(xls|xlsx)$/i', $file)) {
    //     echo ' <!-- ไฟล์ excel แนบ -->
    //             <div class="mt-2 d-flex align-items-center bg-white border rounded p-2" style="max-width: 300px;">
    //                 <i class="bi bi-file-earmark-excel text-danger me-2" style="font-size: 20px;"></i>
    //                 <a href="OpenFile_link.php?key=' . $Encrypt->EnCrypt_pass($file) . '" target="_blank" class="text-decoration-none">
    //                     ไฟล์แนบ.xls
    //                 </a>
    //             </div>';
    //   } else {
    //     echo '<div class="mt-2"></div>';
    //   }
    // }
  }

  if (!empty($post_tag)) {
    echo '<div class="mt-3"><span class="">ผู้ที่ได้รับการแท็ก : </span>';
    foreach ($post_tag as $tag) {
      if (trim($tag['fd_user_fullname']) !== '') {
        echo '<a href="farmer.php?id=' .  $Encrypt->EnCrypt_pass($tag['fd_user_id']) . '" target="_blank"><span class="badge bg-light-secondary border border-secondary bg-transparent f-14 me-1 mt-1">' . htmlspecialchars($tag['fd_user_fullname']) . '</span> </a>';
      }
    }
  } else {
    echo '<div class="mt-3" style="margin-bottom:-25px">';
  }

  // echo '<span class="badge bg-light-secondary border border-secondary bg-transparent f-14 me-1 mt-1">ผู้บริหาร</span>';

  echo '</div>';
  echo '</div>
          <div class="card-footer">
            <div class="d-flex align-items-center justify-content-between">
              <p class="mb-0 text-muted">โพสต์เมื่อ ' . htmlspecialchars($time_create) . '</p>
              <span><i class="ti ti-message-circle" style="font-size:20px"></i>' . select_count_conment($post['fd_post_id'], $object) . '</span>
              <!-- <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#user-modal">แสดงรายละเอียดโพสต์</button> -->
              <a class="btn btn-sm btn-outline-primary" href="detail_post.php?post=' . $Encrypt->EnCrypt_pass($post['fd_post_id']) . '" target="_blank">แสดงรายละเอียดโพสต์</a>
            </div>
          </div>
        </div>
      </div>';
}
