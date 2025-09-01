<?php
session_start();

if (empty($_SESSION['TopicUserId'])) { //เช็ค Session การ login
    http_response_code(403);
    echo "<script>alert('Please Login')</script>";
    exit;
}

require_once '../class/crud.class.php';
require_once '../class/util.class.php';
require_once '../class/encrypt.class.php';
$Encry = new Encrypt_data();

$key = $_GET['key'] ?? '';
$filename = $Encry->DeCrypt_pass($key);

// ป้องกัน path traversal
if (strpos($filename, '..') !== false) {
    http_response_code(400);
    echo 'Invalid file path.';
    exit;
}

// โฟลเดอร์หลักที่อนุญาต
$baseDir = realpath(__DIR__ . '/file_upload'); //เปลี่ยนชื่อโฟลเดอร์ตั้งต้น
$fullPath = realpath($baseDir . '/' . $filename);

// ตรวจสอบว่า path ถูกต้องและไฟล์มีอยู่จริง
if ($fullPath && strpos($fullPath, $baseDir) === 0 && file_exists($fullPath)) {
    // ตรวจสอบนามสกุลไฟล์
    $allowedExtensions = [
        'pdf' => 'application/pdf',
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'png' => 'image/png',
        'doc' => 'application/msword',
        'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        // Excel
        'xls'  => 'application/vnd.ms-excel',
        'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        // เพิ่มตามต้องการ
    ];

    $extension = strtolower(pathinfo($fullPath, PATHINFO_EXTENSION));

    if (!isset($allowedExtensions[$extension])) {
        http_response_code(403);
        echo 'File type not allowed.';
        exit;
    }

    $mime = $allowedExtensions[$extension];

    // แสดงไฟล์
    header('Content-Type: ' . $mime);
    header('Content-Disposition: inline; filename="' . basename($fullPath) . '"');
    header('Content-Length: ' . filesize($fullPath));
    readfile($fullPath);
    exit;
} else {
    http_response_code(403);
    echo "<script>alert('file not found')</script>";
    echo 'Access denied or file not found.';
}
