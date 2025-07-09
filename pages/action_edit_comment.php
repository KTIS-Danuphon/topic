<?php
session_start();
require_once '../class/crud.class.php';
require_once '../class/util.class.php';
require_once '../class/encrypt.class.php';
$object = new CRUD();
$util = new Util;
$Encrypt = new Encrypt_data();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ตรวจสอบก่อนว่าโพสต์นี้มีอยู่แล้วหรือยัง
    date_default_timezone_set('Asia/Bangkok'); // ตั้งเวลาไทย
    $date_time = date("Y-m-d H:i:s"); // เวลา timestamp ปัจจุบัน

    $comment_id = isset($_POST['comment_id_edit']) ? $_POST['comment_id_edit'] : '';
    $comment_content = isset($_POST['comment_content_edit']) ? $_POST['comment_content_edit'] : '';
    $comment_tag_in = isset($_POST['comment_tag_inpost_edit']) ? $_POST['comment_tag_inpost_edit'] : '';
    $tag_ids = explode(',', $comment_tag_in);
    if (isset($_POST['comment_content_edit'])) {

        // ใช้ DOMDocument เพื่อจัดการ HTML
        $doc = new DOMDocument();
        libxml_use_internal_errors(true); // ป้องกัน warning กรณี HTML ไม่สมบูรณ์
        $doc->loadHTML('<?xml encoding="utf-8" ?>' . $comment_content);
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

    $table = 'tb_comment_c ';
    $fields = array(
        'fd_comment_mesage' => $new_content,
        'fd_comment_tag' => $comment_tag_in,
    );

    $comment_file = '';
    if ($_FILES['comment_file_edit']['name'] != "" && $_POST['has_old_file'] == 1) {
        if ($_FILES['comment_file_edit']['name'] != "" && $_FILES['comment_file_edit']['error'] === UPLOAD_ERR_OK) {
            //! อัปไฟล์   
            $NameFolder = date("Y-m-d");
            if (!file_exists("file_upload/" . $NameFolder)) { //เช็คโฟลเดอร์ img ว่าไม่มีโฟลเดอร์  $NameFolder ใช่ไหม //ถ้าโฟลเดอร์ที่จะอัปโหลด ไม่ได้อยู่ตำแหน่งเดียวกับไฟล์นี้ ให้ ../img
                mkdir("file_upload/" . $NameFolder, 0777, true); //ถ้าไม่มี ในโฟลเดอร์ img ให้สร้างโฟลเดอร์ใหม่ชื่อ $NameFolder
                // echo "create folder" . $NameFolder;
            } else {
                // echo "folder" . $NameFolder . "/" . " id Exists";
            }
            $time_ = time();
            $file_name = $_FILES['comment_file_edit']['name'];
            $file_tmp = $_FILES['comment_file_edit']['tmp_name'];
            $file_extension = pathinfo($_FILES['comment_file_edit']['name'], PATHINFO_EXTENSION); // นามสกุลไฟล์ เท่านั้น (โดยไม่รวมจุด .)
            $new_file_name = 'File_' .  $time_ . "." . $file_extension; //สร้างชื่อไฟล์ใหม่ 
            move_uploaded_file($file_tmp, "file_upload/" . $NameFolder . "/" . $new_file_name); //อัพโหลดไฟล์ไว้ที่ โฟลเดอร์ file_upload/โฟลเดอร์ $NameFolder / ชื่อไฟล์ใหม่
            $comment_file  = $NameFolder . "/" . $new_file_name; //ที่อยู่ไฟล์ที่จะเก็บในฐานข้อมูล
            $fields['fd_comment_file'] = $comment_file;
        }
    } else if ($_POST['has_old_file'] == 0) {
        $fields['fd_comment_file'] = '';
    }

    $conditions = array(
        'fd_comment_id' => $comment_id,
    );
    $result = $object->Update_Data($table, $fields, $conditions);

    if ($result) {
        $table = 'tb_comment_c ';
        $fields = '* ';
        $where = 'WHERE fd_comment_id = "' . $comment_id . '" AND fd_comment_active = "1" ';
        $data_comment_newupdate = $object->ReadData($table, $fields, $where);

        $newContent = '';
        foreach ($data_comment_newupdate as $comment) {
            $newContent = '<div>' . $comment['fd_comment_mesage'] . '</div>';
            if (preg_match('/\.(jpg|jpeg|png)$/i', $comment['fd_comment_file'])) {
                $newContent .= ' <!-- รูปที่แนบมา -->
                    <div class="mt-2">
                        <a href="OpenFile_link.php?key=' . $Encrypt->EnCrypt_pass($comment['fd_comment_file']) . '" target="_blank">
                        <img src="OpenFile_show.php?key=' . $Encrypt->EnCrypt_pass($comment['fd_comment_file']) . '" alt="แนบมา" class="img-thumbnail"
                          style="max-width: 200px; transition: 0.3s; cursor: zoom-in;">
                        </a>
                    </div>';
            } else if (preg_match('/\.(pdf)$/i', $comment['fd_comment_file'])) {
                $newContent .= ' <!-- ไฟล์ PDF แนบ -->
                    <div class="mt-2 d-flex align-items-center bg-white border rounded p-2" style="max-width: 300px;">
                      <i class="ti ti-file-text text-danger me-2" style="font-size: 20px;"></i>
                      <a href="OpenFile_link.php?key=' . $Encrypt->EnCrypt_pass($comment['fd_comment_file']) . '" target="_blank" class="text-decoration-none">
                        ไฟล์แนบ.pdf
                      </a>
                    </div>';
            } else {
                $newContent .= '<div class="mt-2"></div>';
            }
        }
        echo json_encode(['success' => true, 'comment_id' => $Encrypt->EnCrypt_pass($comment_id), 'newcontent' => $newContent]);
    }
} else {
    echo json_encode(['success' => false]);
}
