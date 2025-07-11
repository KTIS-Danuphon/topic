<?php
session_start();
require_once '../class/crud.class.php';
require_once '../class/util.class.php';
require_once '../class/encrypt.class.php';
$object = new CRUD();
$util = new Util;
$Encrypt = new Encrypt_data();
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ตรวจสอบก่อนว่าโพสต์นี้มีอยู่แล้วหรือยัง
    date_default_timezone_set('Asia/Bangkok'); // ตั้งเวลาไทย

    $date_time = date("Y-m-d H:i:s"); // เวลา timestamp ปัจจุบัน

    $table = 'tb_posts_c ';
    $fields = '* ';
    $where = 'WHERE fd_post_time_create = "' . $date_time . '" AND fd_post_active ="1" ';
    $data_post = $object->ReadData($table, $fields, $where);
    if (empty($data_post)) {
        // $user_id = isset($_POST['post_user_id']) ? $_POST['post_user_id'] : '';
        $post_id = isset($_POST['post_user_id_edit']) ? $_POST['post_user_id_edit'] : '';
        $header = isset($_POST['post_header_edit']) ? $_POST['post_header_edit'] : '';
        $post_content = isset($_POST['post_content_edit']) ? $_POST['post_content_edit'] : '';
        // $add_file = $_POST['post_add_file'];
        $post_tag_inpost = isset($_POST['post_tag_inpost_edit']) ? $_POST['post_tag_inpost_edit'] : '';
        $tag_ids = explode(',', $post_tag_inpost);
        $post_status = isset($_POST['post_status_edit']) ? $_POST['post_status_edit'] : '';
        $post_tag_other = isset($_POST['post_tag_other_edit']) ? $_POST['post_tag_other_edit'] : '';
        // ตรวจสอบว่ามี post_content ส่งมาหรือไม่
        if (isset($_POST['post_content_edit'])) {

            // ใช้ DOMDocument เพื่อจัดการ HTML
            $doc = new DOMDocument();
            libxml_use_internal_errors(true); // ป้องกัน warning กรณี HTML ไม่สมบูรณ์
            $doc->loadHTML('<?xml encoding="utf-8" ?>' . $post_content);
            libxml_clear_errors();

            $spans = $doc->getElementsByTagName('span');
            $index = 0;

            foreach ($spans as $span) {
                if ($span->getAttribute('class') === 'mention' && $index < count($tag_ids)) {
                    $id = $tag_ids[$index];
                    $text = $span->nodeValue;

                    // สร้างแท็ก <a>
                    $a = $doc->createElement('a', '');
                    $a->setAttribute('href', "farmer.php?id={$id}");
                    $a->setAttribute('target', '_blank');

                    // clone span เก่าไว้ใน a
                    $new_span = $span->cloneNode(true);
                    $a->appendChild($new_span);

                    // แทนที่ span เดิมด้วย a
                    $span->parentNode->replaceChild($a, $span);
                    $index++;
                }
            }

            // คืนค่า HTML เฉพาะ <body> ด้านใน
            $body = $doc->getElementsByTagName('body')->item(0);
            $new_content = '';
            foreach ($body->childNodes as $child) {
                $new_content .= $doc->saveHTML($child);
            }
        } else {
            echo 'ไม่มีค่าที่ส่งมาใน post_content';
        }



        $table = 'tb_posts_c ';
        $fields = array(

            'fd_post_title' => $header,
            'fd_post_content' => $new_content,
            'fd_post_in_tag' => $post_tag_inpost,
            'fd_post_status' => $post_status,
            'fd_post_tag' => $post_tag_other,

        );

        $post_file = '';
        if ($_FILES['post_file_edit']['name'] != "" && $_POST['has_old_file'] == 1) {
            if ($_FILES['post_file_edit']['name'] != "" && $_FILES['post_file_edit']['error'] === UPLOAD_ERR_OK) {
                //! อัปไฟล์   
                $NameFolder = date("Y-m-d");
                if (!file_exists("file_upload/" . $NameFolder)) { //เช็คโฟลเดอร์ img ว่าไม่มีโฟลเดอร์  $NameFolder ใช่ไหม //ถ้าโฟลเดอร์ที่จะอัปโหลด ไม่ได้อยู่ตำแหน่งเดียวกับไฟล์นี้ ให้ ../img
                    mkdir("file_upload/" . $NameFolder, 0777, true); //ถ้าไม่มี ในโฟลเดอร์ img ให้สร้างโฟลเดอร์ใหม่ชื่อ $NameFolder
                    // echo "create folder" . $NameFolder;
                } else {
                    // echo "folder" . $NameFolder . "/" . " id Exists";
                }
                $time_ = time();
                $file_name = $_FILES['post_file_edit']['name'];
                $file_tmp = $_FILES['post_file_edit']['tmp_name'];
                $file_extension = pathinfo($_FILES['post_file_edit']['name'], PATHINFO_EXTENSION); // นามสกุลไฟล์ เท่านั้น (โดยไม่รวมจุด .)
                $new_file_name = 'File_' .  $time_ . "." . $file_extension; //สร้างชื่อไฟล์ใหม่ 
                move_uploaded_file($file_tmp, "file_upload/" . $NameFolder . "/" . $new_file_name); //อัพโหลดไฟล์ไว้ที่ โฟลเดอร์ file_upload/โฟลเดอร์ $NameFolder / ชื่อไฟล์ใหม่
                $post_file  = $NameFolder . "/" . $new_file_name; //ที่อยู่ไฟล์ที่จะเก็บในฐานข้อมูล
                $fields['fd_post_file'] = $post_file;
            }
        } else if ($_POST['has_old_file'] == 0) {
            $fields['fd_post_file'] = '';
        }

        $conditions = array(
            'fd_post_id' => $post_id,
        );
        $result = $object->Update_Data($table, $fields, $conditions);

        if ($result) {
            $table = 'tb_posts_c ';
            $fields = '* ';
            $where = 'WHERE fd_post_id = "' . $post_id . '" AND fd_post_active ="1" ';
            $data_post_newupdate = $object->ReadData($table, $fields, $where);
            $newstatus = '';
            $newContent = '';
            foreach ($data_post_newupdate as $post) {
                $content = $post['fd_post_content'];
                if (!empty($post['fd_post_tag'])) {
                    $post_tag = select_name_user($post['fd_post_tag'], $object);
                } else {
                    $post_tag = '';
                }
                switch ($post['fd_post_status']) {
                    case "success":
                        $newstatus =  '<span class="badge bg-light-success rounded-pill f-12"><b>เสร็จสิ้น</b></span>';
                        break;
                    case "doing":
                        $newstatus = '<span class="badge bg-light-primary rounded-pill f-12"><b>ดำเนินการ</b></span>';
                        break;
                    case "todo":
                        $newstatus = '<span class="badge bg-light-danger rounded-pill f-12"><b>ต้องทำ</b></span>';
                        break;
                }

                $newContent = '<h5>' . htmlspecialchars($post['fd_post_title']) . '</h5>
<p class="mb-4">' . htmlspecialchars_decode($content) . '</p>';
                if (!empty($post['fd_post_file'])) {

                    if (preg_match('/\.(jpg|jpeg|png)$/i', $post['fd_post_file'])) {
                        $newContent .= ' <!-- รูปที่แนบมา -->
                    <div class="mt-2 d-flex justify-content-center align-items-center">
                        <a href="OpenFile_link.php?key=' . $Encrypt->EnCrypt_pass($post['fd_post_file']) . '" target="_blank">
                        <img src="OpenFile_show.php?key=' . $Encrypt->EnCrypt_pass($post['fd_post_file']) . '" alt="แนบมา" class="img-thumbnail"
                          style="max-width: 300px; transition: 0.3s; cursor: zoom-in;">
                        </a>
                    </div>';
                    } else if (preg_match('/\.(pdf)$/i', $post['fd_post_file'])) {
                        $newContent .= ' <!-- ไฟล์ PDF แนบ -->
                    <div class="mt-2 d-flex align-items-center bg-white border rounded p-2" style="max-width: 300px;">
                      <i class="ti ti-file-text text-danger me-2" style="font-size: 20px;"></i>
                      <a href="OpenFile_link.php?key=' . $Encrypt->EnCrypt_pass($post['fd_post_file']) . '" target="_blank" class="text-decoration-none">
                        ไฟล์แนบ.pdf
                      </a>
                    </div>';
                    } else {
                        $newContent .= '<div class="mt-2"></div>';
                    }
                }

                if (!empty($post_tag)) {
                    $newContent .= '<div class="mt-3"><span class="">ผู้ที่ได้รับการแท็ก : </span>';
                    foreach ($post_tag as $tag) {
                        if (trim($tag['fd_user_fullname']) !== '') {
                            $newContent .= '<a href="farmer.php?id=' . $tag['fd_user_id'] . '" target="_blank">
                <span class="badge bg-light-secondary border border-secondary bg-transparent f-14 me-1 mt-1">'
                                . htmlspecialchars($tag['fd_user_fullname']) .
                                '</span></a>';
                        }
                    }
                    $newContent .= '</div>'; // ✅ ปิด div ตรงนี้
                } else {
                    $newContent .= '<div class="mt-3"></div>'; // ✅ ปิด div ถึงแม้ไม่มี tag
                }


                // echo '<span class="badge bg-light-secondary border border-secondary bg-transparent f-14 me-1 mt-1">ผู้บริหาร</span>';

                $newContent .= '</div>';
            }
            echo json_encode(['success' => true, 'newstatus' => $newstatus, 'newcontent' => $newContent]);
        }
        //   $table = 'tb_posts_c ';
        //     $fields = '* ';
        //     $where = 'WHERE fd_post_id = 5';
        //     $data_username = $object->ReadData($table, $fields, $where);
        // print_r($data_username);
        // echo "<hr>";
        // htmlspecialchars_decode($data_username[0]['fd_post_content']);

    }
} else {
    echo json_encode(['success' => false]);
}
