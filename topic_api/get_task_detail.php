<?php
session_start();
date_default_timezone_set('Asia/Bangkok');
// ตรวจสอบ session
if (!isset($_SESSION["user_id"])) {
    echo json_encode([
        "status" => "error",
        "message" => "กรุณาเข้าสู่ระบบก่อน"
    ]);
    exit;
}

$userID = (int)$_SESSION["user_id"];
$userStatus = $_SESSION["user_status"];

require_once '../class/crud.class.php';
require_once '../class/util.class.php';
require_once '../class/encrypt.class.php';

$object   = new CRUD();
$util     = new Util();
$Encrypt  = new Encrypt_data();

if (empty($Encrypt->DeCrypt_pass($_GET['task_id']))) {
    echo json_encode([
        "status" => "error",
        "message" => "ข้อมูลไม่ถูกต้อง"
    ]);
    exit;
} else {
    $task_id = $Encrypt->DeCrypt_pass($_GET['task_id']);
}
header('Content-Type: application/json; charset=utf-8');
try {
    $table = 'tb_topics_c050968 t1 ';
    $table .= 'LEFT JOIN tb_users_c050968 t2 ON t2.fd_user_id  = t1.fd_topic_created_by  ';
    $fields = 't1.fd_topic_id AS id, t1.fd_topic_title AS title, t1.fd_topic_category AS category,t1.fd_topic_status AS status,t1.fd_topic_importance AS importance, t1.fd_topic_created_at AS created_at ';
    $fields .= ',t1.fd_topic_created_by AS created_by, t2.fd_user_fullname AS fullname ';
    $fields .= ',t1.fd_topic_detail AS task_detail, t1.fd_topic_mentioned AS task_mentioned, t1.fd_topic_participant AS task_participant,t1.fd_topic_updated_at AS updated_at ';
    // ดึง task ทั้งหมด (หรือกรองตาม user ก็ได้)
    if ($userStatus === "admin" || $userStatus === "Ex") {
        // admin เห็นทุกงาน
        $where = 'WHERE fd_topic_private = "1" AND fd_topic_id = ' . $task_id;
    } else {
        // user ทั่วไป เห็นเฉพาะที่ตัวเองเกี่ยวข้อง
        $where = "WHERE (
        fd_topic_participant LIKE '%$userID%'     
        OR fd_topic_participant LIKE '%[$userID,%'     
        OR fd_topic_participant LIKE '%,$userID,%'    
        OR fd_topic_participant LIKE '%,$userID]'
        OR fd_topic_created_by = $userID ) AND fd_topic_active = '1' AND fd_topic_id = " . $task_id;
    }
    $result = $object->ReadData($table, $fields, $where);
    if (empty($result)) {
        echo json_encode([
            "status" => "error",
            "message" => "ไม่สิทธิ์ดูข้อมูล"
        ]);
        exit;
    }
    foreach ($result as $key => $row) {
        $result[$key]['encrypt_id'] = $Encrypt->EnCrypt_pass($row['id']);
    }

    //ประเภทไฟล์
    $table = 'tb_topic_files_c050968 ';
    $fields = 'fd_file_id AS file_id, fd_file_path AS file_path, fd_file_type AS file_type, fd_file_created_at AS file_created_at,fd_file_updated_at AS file_updated_at ';
    $where = 'WHERE fd_file_active = "1" AND fd_topic_id = ' . $task_id;
    $result_file = $object->ReadData($table, $fields, $where);

    $task_participant = trim($result[0]['task_participant'], "[]");
    // // ชื่อผู้ที่เกี่ยวข้อง
    $table = 'tb_users_c050968 ';
    $fields = 'fd_user_fullname ';
    $where = 'WHERE fd_user_active = "1" AND fd_user_id IN (' . $task_participant . ')';
    $result_task_participant = $object->ReadData($table, $fields, $where);
    echo json_encode([
        "status" => "success",
        "tasks"  => $result,
        "tasks_file"  => $result_file,
        "task_participant" => $result_task_participant
    ]);
} catch (Exception $e) {
    echo json_encode([
        "status"  => "error",
        "message" => $e->getMessage()
    ]);
}
