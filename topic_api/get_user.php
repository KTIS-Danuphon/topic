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
$userGroup = $_SESSION["user_group"];

require_once '../class/crud.class.php';
require_once '../class/util.class.php';
require_once '../class/encrypt.class.php';

$object   = new CRUD();
$util     = new Util();
$Encrypt  = new Encrypt_data();

header('Content-Type: application/json; charset=utf-8');
try {
    $table = 'tb_users_c050968 ';
    $fields = 'fd_user_id AS id ,fd_user_fullname AS name ';
    // ดึง task ทั้งหมด (หรือกรองตาม user ก็ได้)
    $where = 'WHERE fd_user_group = ' . $userGroup . ' AND  fd_user_active = "1"  ';
    $result_user = $object->ReadData($table, $fields, $where);
    echo json_encode([
        "status" => "success",
        "users"  => $result_user
    ]);
} catch (Exception $e) {
    echo json_encode([
        "status"  => "error",
        "message" => $e->getMessage()
    ]);
}
