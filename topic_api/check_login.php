<?php
session_start();
date_default_timezone_set('Asia/Bangkok');

require_once '../class/crud.class.php';
require_once '../class/util.class.php';
require_once '../class/encrypt.class.php';

$object   = new CRUD();
$util     = new Util();
$Encrypt  = new Encrypt_data();

header('Content-Type: application/json; charset=utf-8');

// ตรวจสอบว่าเป็น POST เท่านั้น
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        "status"  => "error",
        "message" => "Method not allowed"
    ]);
    exit;
}

// รับค่าที่ส่งมาเป็น JSON
$data = json_decode(file_get_contents("php://input"), true);

// ป้องกันกรณีส่ง JSON ว่าง
if (!isset($data['user_name']) || !isset($data['password'])) {
    echo json_encode([
        "status"  => "error",
        "message" => "ข้อมูลไม่ครบถ้วน"
    ]);
    exit;
}

try {
    $user_name = trim($data['user_name']);
    $password  = trim($data['password']);

    $table = 'tb_users_c050968 t1 ';
    $fields = 'fd_user_id, fd_user_name, fd_user_fullname, fd_user_password, fd_user_status, fd_user_group ';
    $where = 'WHERE fd_user_name = "' . $user_name . '" AND fd_user_password = "' . $password . '" AND fd_user_active = "1"  ';

    $result_user = $object->ReadData($table, $fields, $where);

    if (!empty($result_user)) {
        $_SESSION['user_id'] = $result_user[0]['fd_user_id'];
        $_SESSION['user_name'] = $result_user[0]['fd_user_name'];
        $_SESSION['user_fullname'] = $result_user[0]['fd_user_fullname'];
        $_SESSION['user_status'] = $result_user[0]['fd_user_status'];
        $_SESSION['user_group'] = $result_user[0]['fd_user_group'];
        $_SESSION['login_time'] = time(); // เก็บเวลาที่ login
        //    if (time() - $_SESSION['login_time'] > 3600) 
        echo json_encode([
            "status" => "success",
            "login_status" => true,
            "data"  => $result_user
        ]);
    } else {
        echo json_encode([
            "status" => "success",
            "login_status" => false
        ]);
    }
} catch (Exception $e) {
    echo json_encode([
        "status"  => "error",
        "message" => $e->getMessage()
    ]);
}
