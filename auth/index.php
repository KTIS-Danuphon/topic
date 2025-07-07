<?php
session_start();
date_default_timezone_set('Asia/Bangkok');


require_once '../class/crud.class.php';
$object = new CRUD();
require_once '../class/util.class.php';
$util = new Util();
require_once '../class/encrypt.class.php';
$Encrypt = new Encrypt_data();
// $redirectURL = 'demo.php';
$PostUserName = $util->testInput($_POST['TxtUserName']);
$PostPassWord = $util->testInput($_POST['TxtPassWord']);
// isset
$PostUserName = isset($PostUserName) ? $PostUserName : '';
$PostPassWord = isset($PostPassWord) ? $PostPassWord : '';
// echo "User " . $PostUserName . "<br>";
// echo "Pass " . $PostPassWord . "<br>";

$table = 'tb_user_c ';
$fields = '* ';
$where = ' WHERE fd_user_name = "' . trim($PostUserName) . '" and fd_user_password = "' . trim($PostPassWord) . '" and fd_user_active IN ("1") ';
// $where = ' WHERE fd_user_name = "' . trim($PostUserName) . '" and fd_user_password = "' . md5($Encrypt->EnCrypt_pass($PostPassWord)) . '" and fd_user_active IN ("1") ';
$data_user = $object->ReadData($table, $fields, $where);

if ($data_user && (is_array($data_user) || is_object($data_user))) {
    foreach ($data_user as $row) {
        // echo  "NAME " . $row['NAME'] . "<br>";
    }
    unset($object);
    $_SESSION["TopicUserId"] = $row['fd_user_id'];
    $_SESSION["TopicUsername"] = $row['fd_user_name'];
    $_SESSION["TopicFullname"] = $row['fd_user_fullname'];
    $_SESSION["TopicPassword"] = $row['fd_user_password'];
    $_SESSION["TopicPosition"] = $row['fd_user_position'];
    $_SESSION["TopicUser_status"] = $row['fd_user_status'];
    header("Location: ../pages");
} else {
    // echo "<br>ไม่พบข้อมูล";
    $_SESSION["Alert_login"] = '<div class="form-group mb-3">
                                <code>*ผู้ใช้หรือรหัสผ่านไม่ถูกต้อง</code>
                            </div>';

    echo "<script>	
	
	window:history.go(-1);
	</script>";
}
exit;
