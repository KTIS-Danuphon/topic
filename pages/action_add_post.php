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

    $table = 'tb_posts_c ';
    $fields = '* ';
    $where = 'WHERE fd_post_time_create = "' . $date_time . '" AND fd_post_active ="1" ';
    $data_post = $object->ReadData($table, $fields, $where);
    if (empty($data_post)) {
        $user_id = isset($_POST['post_user_id']) ? $_POST['post_user_id'] : '';
        $header = isset($_POST['post_header']) ? $_POST['post_header'] : '';
        $post_content = isset($_POST['post_content']) ? $_POST['post_content'] : '';
        // $add_file = $_POST['post_add_file'];
        $post_tag_inpost = isset($_POST['post_tag_inpost']) ? $_POST['post_tag_inpost'] : '';
        $tag_ids = explode(',', $post_tag_inpost);
        $tag_other = isset($_POST['post_tag_other']) ? $_POST['post_tag_other'] : '';
        $post_status = isset($_POST['post_status']) ? $_POST['post_status'] : '';
        // ตรวจสอบว่ามี post_content ส่งมาหรือไม่
        if (isset($_POST['post_content'])) {

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
        $namefile_address_upload = "";
        if ($_FILES['post_add_file']['name'] != "" && $_FILES['post_add_file']['error'] === UPLOAD_ERR_OK) {
            //! อัปไฟล์   
            $NameFolder = date("Y-m-d");
            if (!file_exists("file_upload/" . $NameFolder)) { //เช็คโฟลเดอร์ img ว่าไม่มีโฟลเดอร์  $NameFolder ใช่ไหม //ถ้าโฟลเดอร์ที่จะอัปโหลด ไม่ได้อยู่ตำแหน่งเดียวกับไฟล์นี้ ให้ ../img
                mkdir("file_upload/" . $NameFolder, 0777, true); //ถ้าไม่มี ในโฟลเดอร์ img ให้สร้างโฟลเดอร์ใหม่ชื่อ $NameFolder
                // echo "create folder" . $NameFolder;
            } else {
                // echo "folder" . $NameFolder . "/" . " id Exists";
            }
            $time_ = time();
            $file_name = $_FILES['post_add_file']['name'];
            $file_tmp = $_FILES['post_add_file']['tmp_name'];
            $file_extension = pathinfo($_FILES['post_add_file']['name'], PATHINFO_EXTENSION); // นามสกุลไฟล์ เท่านั้น (โดยไม่รวมจุด .)
            $new_file_name = 'File_' .  $time_ . "." . $file_extension; //สร้างชื่อไฟล์ใหม่ 
            move_uploaded_file($file_tmp, "file_upload/" . $NameFolder . "/" . $new_file_name); //อัพโหลดไฟล์ไว้ที่ โฟลเดอร์ file_upload/โฟลเดอร์ $NameFolder / ชื่อไฟล์ใหม่
            $namefile_address_upload  = $NameFolder . "/" . $new_file_name; //ที่อยู่ไฟล์ที่จะเก็บในฐานข้อมูล

        }


        $table = 'tb_posts_c ';
        $fields = array(
            'fd_post_user_create' => $user_id,
            'fd_post_title' => $header,
            'fd_post_content' => $new_content,
            'fd_post_tag' => $tag_other,
            'fd_post_status' => $post_status,
            'fd_post_in_tag' => $post_tag_inpost,
            'fd_post_file' => $namefile_address_upload,
            'fd_post_active' => "1",
            'fd_post_time_create' => $date_time
        );
        // print_r($fields);

        $result = $object->Insert_data($table, $fields);
        // echo '<h3>ค่าที่ส่งมาทาง GET:</h3>';
        // foreach ($_POST as $key => $value) {
        //     echo "<strong>$key</strong> : $value<br>";
        // }

        if ($result) {
            echo json_encode(['success' => true]);
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
