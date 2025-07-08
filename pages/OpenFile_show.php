<?php
// session_start();
// if (empty($_SESSION["login_test99"])) { //เช็ค Session การ login
//     http_response_code(403);
//     echo "<script>alert('Please Login')</script>";
//     exit;
// }
require_once '../class/crud.class.php';
require_once '../class/util.class.php';
require_once '../class/encrypt.class.php';
$Encrypt = new Encrypt_data();


if (isset($_GET['key'])) {
    $filepath = $Encrypt->DeCrypt_pass($_GET['key']);

    // เพิ่มความปลอดภัย: ตรวจสอบว่าอยู่ในโฟลเดอร์ที่อนุญาต
    $baseDir = realpath('file_upload'); // โฟลเดอร์หลักที่เก็บรูป
    $fullPath = $baseDir . DIRECTORY_SEPARATOR . $filepath;  // ต่อ path ให้เป็น full path

    $realPath = realpath($fullPath);

    if ($realPath !== false && strpos($realPath, $baseDir) === 0 && file_exists($realPath)) {
        $mime = mime_content_type($realPath); // ตรวจชนิดไฟล์
        header("Content-Type: $mime");
        readfile($realPath);
        exit;
    } else {
        http_response_code(403);
        echo "ไม่อนุญาตให้เข้าถึงไฟล์นี้";
    }
} else {
    http_response_code(400);
    echo "คำขอไม่ถูกต้อง";
}
