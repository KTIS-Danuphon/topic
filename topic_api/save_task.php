<?php
session_start();
require_once '../class/crud.class.php';
require_once '../class/util.class.php';
require_once '../class/encrypt.class.php';

$object   = new CRUD();
$util     = new Util();
$Encrypt  = new Encrypt_data();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    date_default_timezone_set('Asia/Bangkok'); // ตั้งเวลาไทย
    $date_time = date("Y-m-d H:i:s");

    // รับค่าจาก FormData
    $title           = isset($_POST['title']) ? trim($_POST['title']) : '';
    $category        = isset($_POST['category']) ? trim($_POST['category']) : '';
    $description     = isset($_POST['description']) ? trim($_POST['description']) : '';
    $taskStatus      = isset($_POST['taskStatus']) ? trim($_POST['taskStatus']) : '';
    $taskImportance      = isset($_POST['taskImportance']) ? trim($_POST['taskImportance']) : '';
    $related_users   = isset($_POST['related_users']) ? $_POST['related_users'] : '[]';
    $mentioned_users = isset($_POST['mentioned_users']) ? $_POST['mentioned_users'] : '[]';

    try {
        // บันทึกลง DB (ใช้ class CRUD)
        $table = 'tb_topics_c050968 ';
        $fields = array(
            'fd_topic_title' => $title,
            'fd_topic_category' => $category,
            'fd_topic_detail' => $description,
            'fd_topic_mentioned' => $mentioned_users,
            'fd_topic_status' => $taskStatus,
            'fd_topic_importance' => $taskImportance,
            'fd_topic_participant' => $related_users,
            'fd_topic_created_by' => $_SESSION['user_id'],
            'fd_topic_private' => "1",
            'fd_topic_active' => "1",
            'fd_topic_created_at' => $date_time,
            'fd_topic_updated_at' => $date_time
        );
        // print_r($fields);

        $task_id = $object->Insert_data($table, $fields); //last id
        // ===================
        // อัพโหลดไฟล์
        // ===================
        $NameFolder = date("Y-m-d");
        $baseDir = dirname(__DIR__); // ถอยขึ้นไปจาก topic_api
        $targetDir = $baseDir . "/file_upload/" . $NameFolder;

        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $uploadedFiles = [];
        $uploadedFiles_type = [];
        if (isset($_FILES['files'])) {
            foreach ($_FILES['files']['tmp_name'] as $index => $tmpName) {
                if ($_FILES['files']['error'][$index] === UPLOAD_ERR_OK) {
                    $fileName = time() . "_files_" . basename($_FILES['files']['name'][$index]);
                    $filePath = $targetDir . "/" . $fileName;

                    if (move_uploaded_file($tmpName, $filePath)) {
                        // เก็บ path
                        $uploadedFiles[] = "file_upload/$NameFolder/$fileName";
                        $name_filePath = "$NameFolder/$fileName";
                        // ตรวจสอบประเภทไฟล์จาก MIME type หรือจากนามสกุลไฟล์
                        $mime = $_FILES['files']['type'][$index];
                        $ext  = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                        $type = "other";
                        if ($ext === "pdf") {
                            $type = "pdf";
                        } elseif (in_array($ext, ["doc", "docx"])) {
                            $type = "word";
                        } elseif (in_array($ext, ["xls", "xlsx"])) {
                            $type = "excel";
                        } elseif (in_array($ext, ["jpg", "jpeg"])) {
                            $type = "jpg";
                        } elseif ($ext === "png") {
                            $type = "png";
                        }
                        // เก็บ type
                        $uploadedFiles_type[] = $type;

                        try {
                            // save file info ลง DB ถ้าต้องการ
                            $table = 'tb_topic_files_c050968 ';
                            $fields = array(
                                'fd_topic_id' => $task_id,
                                'fd_file_path' => $name_filePath,
                                'fd_file_type' => $type,
                                'fd_file_active' => "1",
                                'fd_file_created_at' => $date_time,
                                'fd_file_updated_at' => $date_time
                            );
                            $object->Insert_data($table, $fields);
                        } catch (Exception $e) {
                            echo json_encode([
                                "status"  => "error",
                                "message" => $e->getMessage(),
                                "x" => "files"
                            ]);
                        }
                        // $object->insert("task_files", [
                        //     "task_id"   => $task_id,
                        //     "file_name" => $fileName,
                        //     "file_path" => "file_upload/$NameFolder/$fileName",
                        //     "uploaded_at" => $date_time
                        // ]);
                    } else {
                        error_log("❌ move_uploaded_file failed: $tmpName -> $filePath");
                    }
                }
            }
        }

        // ส่งกลับ
        echo json_encode([
            "status"  => "success",
            "message" => "บันทึกงานสำเร็จ",
            "task_id" => ($task_id) ?? '0',
            "files"   => $uploadedFiles,
            "files_type"   => $uploadedFiles_type
        ]);
    } catch (Exception $e) {
        echo json_encode([
            "status"  => "error",
            "message" => $e->getMessage()
        ]);
    }
} else {
    echo json_encode([
        "status"  => "error",
        "message" => "Invalid request method"
    ]);
}
