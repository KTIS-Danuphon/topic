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

header('Content-Type: application/json; charset=utf-8');
try {
    $table = 'tb_topics_c050968 t1 ';
    $fields = 'fd_topic_id AS id, fd_topic_title AS title, fd_topic_category AS category,fd_topic_status AS status,fd_topic_importance AS importance, fd_topic_created_at AS created_at ';
    // ดึง task ทั้งหมด (หรือกรองตาม user ก็ได้)
    if ($userStatus === "admin" || $userStatus === "Ex") {
        // admin เห็นทุกงาน
        $where = 'WHERE fd_topic_private = "1"  ';
    } else {
        // user ทั่วไป เห็นเฉพาะที่ตัวเองเกี่ยวข้อง
        $where = "WHERE (
        fd_topic_participant LIKE '%$userID%'     
        OR fd_topic_participant LIKE '%[$userID,%'     
        OR fd_topic_participant LIKE '%,$userID,%'    
        OR fd_topic_participant LIKE '%,$userID]'
        OR fd_topic_created_by = $userID ) AND fd_topic_active = '1' ";
    }
    $result = $object->ReadData($table, $fields, $where);
    foreach ($result as $key => $row) {
        $result[$key]['encrypt_id'] = $Encrypt->EnCrypt_pass($row['id']);
    }
    echo json_encode([
        "status" => "success",
        "tasks"  => $result
    ]);
} catch (Exception $e) {
    echo json_encode([
        "status"  => "error",
        "message" => $e->getMessage()
    ]);
}
