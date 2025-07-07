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
$table = 'tb_comment_c t1 ';
$fields = 't1.*,t2.fd_user_fullname ';
$where = 'LEFT JOIN tb_user_c t2 ON t2.fd_user_id = t1.fd_user_id WHERE t1.fd_post_id = ' . $post_id . ' ';
if ($userStatus == 'executive') {
  $where .= ' AND t1.fd_comment_active = "1"  ';
} else {
  $where .= ' AND t1.fd_comment_active = "1" ';
}
$where .= ' ORDER BY t1.fd_comment_id DESC ';
// $where = ' WHERE fd_user_name = "' . trim($PostUserName) . '" and fd_user_password = "' . md5($Encrypt->EnCrypt_pass($PostPassWord)) . '" and fd_user_active IN ("1") ';
$data_comment = $object->ReadData($table, $fields, $where);
$count_comment = count($data_comment);
// รับค่าที่ส่งมาจาก JS
$offset = isset($_POST['offset']) ? intval($_POST['offset']) : intval($_POST['offset_new']);
$limit = isset($_POST['limit']) ? intval($_POST['limit']) : intval($_POST['limit_new']);

// ตัด array ตาม offset/limit
$comments = array_slice($data_comment, $offset, $limit);

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
// echo print_r($data_comment);

// ส่งข้อมูลกลับในรูปแบบ HTML
foreach ($comments as $comment) {
  if (!empty($post['fd_post_tag'])) {
    $post_tag = select_name_user($post['fd_post_tag'], $object);
  } else {
    $post_tag = '';
  }
  echo '<div class="d-flex mb-3">
            <!-- รูปโปรไฟล์ -->
            <div class="flex-shrink-0 me-2">
                <img src="../assets/images/user/avatar-3.jpg" alt="user" class="rounded-circle" style="width: 32px; height: 32px;">
            </div>
             <!-- เนื้อหาคอมเมนต์ + จุดไข่ปลา -->
            <div class="flex-grow-1 position-relative">
                <!-- จุดไข่ปลา -->
                <div class="dropdown position-absolute top-0 end-0">
                    <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="bi bi-three-dots-vertical"></i> <!-- ถ้าใช้ Tabler: ti-dots-vertical -->
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                      <li><a class="dropdown-item" href="#">แก้ไข</a></li>
                      <li><a class="dropdown-item" href="#">ลบ</a></li>
                      <!-- <li><a class="dropdown-item" href="#">รายงาน</a></li> -->
                    </ul>
                </div>

                <!-- เนื้อคอมเมนต์ -->
                <div class="bg-light rounded px-3 py-2" >
                    <strong>' . $comment['fd_user_fullname'] . '</strong>
                    <div id="comment_' . $Encrypt->EnCrypt_pass($comment['fd_comment_id']) . '"> 
                    <div>' . $comment['fd_comment_mesage'] . '</div>';

  if (preg_match('/\.(jpg|jpeg|png)$/i', $comment['fd_comment_file'])) {
    echo ' <!-- รูปที่แนบมา -->
                    <div class="mt-2">
                        <a href="img/post/2025-06-24/File_1750748863.png" target="_blank">
                        <img src="file_upload/' . $comment['fd_comment_file'] . '" alt="แนบมา" class="img-thumbnail"
                          style="max-width: 200px; transition: 0.3s; cursor: zoom-in;">
                        </a>
                    </div>';
  } else if (preg_match('/\.(pdf)$/i', $comment['fd_comment_file'])) {
    echo ' <!-- ไฟล์ PDF แนบ -->
                    <div class="mt-2 d-flex align-items-center bg-white border rounded p-2" style="max-width: 300px;">
                      <i class="ti ti-file-text text-danger me-2" style="font-size: 20px;"></i>
                      <a href="file_upload/' . $comment['fd_comment_file'] . '" target="_blank" class="text-decoration-none">
                        ไฟล์แนบ.pdf
                      </a>
                    </div>';
  } else {
    echo '          <div class="mt-2"></div>';
  }
  echo '            </div>
                    <div class="text-muted small mt-1">เมื่อ ' . $comment['fd_time_create'] . '</div>
                </div>
            </div>
        </div>';
}
$mix_offset = $offset + $limit;
if ($limit != 1) {
  if ($mix_offset < $count_comment) {
    echo '<div class="text-center mt-3" id="btn-refresh-comment" onclick="load_more_comments()">
    <button class="btn btn-outline-primary btn-sm rounded-pill px-3 shadow-sm" id="loadMoreCommentsBtn">
    <i class="bi bi-chevron-down"></i> แสดงคอมเมนต์เพิ่มเติม
    </button>
    </div>
    ';
    // <i class="bi bi-chevron-down"></i> แสดงคอมเมนต์เพิ่มเติม ' . $count_comment . '//' . $offset . '//' . $limit . '
  } else if ($mix_offset >= $count_comment - 1 && $offset >= 5) {
    echo '<div id="text-no-data" class="text-center">ข้อมูลล่าสุดแล้ว</div>';
  }
}
//  $('#btn-refresh-comment').remove();
// text-no-data
