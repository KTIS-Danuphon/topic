<?php
session_start();
include 'check_session.php';
?>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Topic Tracking - ระบบติดตามงาน</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <?php include 'style.php'; ?>
    <style>
        .btn-header {
            position: absolute;
            top: 5px;
            right: 5px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.95rem;
            font-weight: 600;
            transition: all 0.3s ease;
            z-index: 10;
        }

        .btn-edit-header {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.95rem;
            font-weight: 600;
            transition: all 0.3s ease;
            z-index: 10;
        }

        .btn-edit-header:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.05);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
        }

        .btn-edit-header i {
            font-size: 1.1rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .task-header {
                padding: 60px 20px 30px 20px;
            }

            .btn-edit-header {
                top: 15px;
                right: 15px;
                padding: 8px 16px;
                font-size: 0.85rem;
            }

            .btn-edit-header span {
                display: none;
            }

            .btn-edit-header i {
                font-size: 1.2rem;
                margin: 0;
            }
        }

        /* Toast Notification */
        .toast-notification {
            position: fixed;
            top: 80px;
            right: 20px;
            background: white;
            padding: 20px 25px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            display: none;
            z-index: 1000;
            animation: slideIn 0.3s ease;
        }

        .toast-notification.show {
            display: block;
        }

        /* ทำให้ icon หมุน */
        .spin {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }
    </style>
    <style>
        .confirm-dialog {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            animation: fadeIn 0.3s ease;
        }

        .confirm-dialog.show {
            display: flex;
        }

        .confirm-box {
            animation: slideUp 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
        }

        .btn-yes {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .btn-yes:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        }

        .btn-no {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            border: none;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .btn-no:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(245, 87, 108, 0.4);
            background: linear-gradient(135deg, #f5576c 0%, #f093fb 100%);
        }

        .icon-warning {
            background: linear-gradient(135deg, #FFD700, #FFA500);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            filter: drop-shadow(0 4px 8px rgba(255, 215, 0, 0.3));
        }

        .star-rating {
            display: inline-flex;
            gap: 5px;
        }

        .star {
            background: none;
            border: none;
            font-size: 2rem;
            color: #ddd;
            cursor: pointer;
            transition: color 0.2s;
            padding: 0;
        }

        .star:hover,
        .star.active {
            color: #ffc107;
        }

        .star:focus {
            outline: 2px solid #0d6efd;
            outline-offset: 2px;
        }
    </style>
</head>

<body>
    <!-- Sidebar Toggle Button -->
    <button class="sidebar-toggle" id="sidebarToggle" onclick="toggleSidebar()">
        <i class="bi bi-list"></i>
    </button>
    <!-- Top Navigation Bar -->
    <?php include 'navbar.php'; ?>
    <!-- Left Sidebar -->
    <?php include 'sidebar.php'; ?>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <div class="content-wrapper">
            <div class="container">
                <!-- Page Header -->
                <!-- Loading Indicator -->
                <div id="loadingIndicator" class="text-center py-4 d-none">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">กำลังโหลด...</span>
                    </div>
                    <div class="mt-2">กำลังโหลดข้อมูล...</div>
                </div>

                <!-- Tasks Container -->
                <div id="tasksContainer" class="fade-in" style="margin-top:5%">
                    <!-- Tasks will be loaded here -->
                </div>

            </div>
        </div>
    </div>

    <!-- Task Modal -->
    <div class="modal fade" id="task_updatetopicModal" tabindex="-1" aria-labelledby="taskModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="taskModalLabel">
                        <i class="bi bi-clipboard-plus me-2"></i>แก้ไขงาน
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body" id="updateModalBody_load">
                </div>
                <div class="modal-body" id="updateModalBody">
                    <form id="task_updatetopicForm">
                        <input type="hidden" id="update_taskID">
                        <!-- หัวข้อ -->
                        <div class="mb-3">
                            <label for="update_taskTitle" class="form-label">
                                <i class="bi bi-card-text me-1"></i>หัวข้อ <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="update_taskTitle" placeholder="กรุณาใส่หัวข้องาน" required>
                            <div class="invalid-feedback">
                                กรุณาใส่หัวข้องาน
                            </div>
                        </div>

                        <!-- หมวดหมู่ -->
                        <div class="mb-3">
                            <label for="update_taskCategory" class="form-label">
                                <i class="bi bi-tags me-1"></i>หมวดหมู่
                            </label>
                            <select class="form-select" id="update_taskCategory" required>
                                <option value="" selected disabled>เลือกหมวดหมู่</option>
                                <option value="development">พัฒนาระบบ</option>
                                <option value="design">ออกแบบ</option>
                                <option value="marketing">การตลาด</option>
                                <option value="meeting">ประชุม</option>
                                <option value="other">อื่นๆ</option>
                            </select>
                        </div>

                        <!-- รายละเอียด -->
                        <div class="mb-3">
                            <label for="update_taskDescription" class="form-label">
                                <i class="bi bi-file-text me-1"></i>รายละเอียด
                            </label>
                            <div class="position-relative">
                                <textarea class="form-control" id="update_taskDescription" rows="4"
                                    placeholder="กรุณาใส่รายละเอียดงาน สามารถใช้ @ เพื่อ mention ผู้ใช้อื่น" required></textarea>
                                <div class="invalid-feedback">
                                    กรุณาใส่รายละเอียดงาน
                                </div>
                                <div id="mentionDropdown" class="mention-dropdown"></div>
                            </div>
                            <div class="form-text">
                                <i class="bi bi-info-circle me-1"></i>พิมพ์ @ เพื่อ mention ผู้ใช้อื่น
                                <i class="bi bi-people me-1"></i><span id="tag_span">...</span>
                            </div>
                        </div>

                        <!-- ผู้เกี่ยวข้อง -->
                        <div class="mb-3 position-relative" id="userSection">
                            <label class="form-label">
                                <i class="bi bi-people me-1"></i>ผู้เกี่ยวข้อง
                            </label>
                            <div class="user-tags-container" id="userTagsContainer">
                                <button type="button" class="btn btn-add-user" onclick="showUserDropdown()">
                                    <i class="bi bi-plus me-1"></i>เพิ่มผู้ใช้
                                </button>
                            </div>
                            <select class="form-select mt-2 d-none" id="userSelect">
                                <option value="">เลือกผู้ใช้</option>
                            </select>

                            <!-- 🔒 overlay ใสๆ -->
                            <div id="userSectionOverlay"></div>
                        </div>

                        <style>
                            /* overlay ใส ครอบเต็มกล่อง */
                            #userSectionOverlay {
                                display: none;
                                /* เริ่มต้นซ่อนไว้ */
                                position: absolute;
                                top: 0;
                                left: 0;
                                right: 0;
                                bottom: 0;
                                background: rgba(255, 255, 255, 0);
                                /* โปร่งใส */
                                cursor: not-allowed;
                                /* เมาส์เป็นรูปห้าม */
                                z-index: 10;
                                /* ซ้อนบนสุด */
                            }
                        </style>


                        <!-- สถานะ -->
                        <div class="mb-3">
                            <label for="update_taskStatus" class="form-label">
                                <i class="bi bi-bookmark-star me-1"></i>สถานะการทำงาน
                            </label>
                            <select class="form-select" id="update_taskStatus" required>
                                <option value="" selected disabled>เลือกสถานะการทำงาน</option>
                                <option value="pending">รอดำเนินการ</option>
                                <option value="in-progress">กำลังดำเนินการ</option>
                                <option value="completed">เสร็จสิ้น</option>
                            </select>
                        </div>

                        <!-- ความเร่งด่วน (จำนวนดาว) -->
                        <div class="mb-3">
                            <label class="form-label">
                                <i class="bi bi-speedometer2 me-1"></i>ความเร่งด่วน (1-5 ดาว)
                            </label>
                            <div id="update_taskImportance_stars" class="star-rating" data-value="3" aria-label="เลือกระดับความเร่งด่วน">
                                <button type="button" class="star" data-value="1" aria-label="1 ดาว">★</button>
                                <button type="button" class="star" data-value="2" aria-label="2 ดาว">★</button>
                                <button type="button" class="star" data-value="3" aria-label="3 ดาว">★</button>
                                <button type="button" class="star" data-value="4" aria-label="4 ดาว">★</button>
                                <button type="button" class="star" data-value="5" aria-label="5 ดาว">★</button>
                            </div>
                            <input type="hidden" id="update_taskImportance" value="3" required>
                            <div id="updateRatingLabel" class="rating-label level-3 small text-muted mt-2">
                                ระดับปานกลาง (3 ดาว)
                            </div>
                        </div>

                        <!-- ไฟล์แนบ -->
                        <div class="mb-3">
                            <label class="form-label">
                                <i class="bi bi-paperclip me-1"></i>ไฟล์แนบ
                            </label>
                            <div class="file-attachments" id="fileAttachments_old"></div>

                            <div class="file-attachments" id="fileAttachments">
                                <div class="file-input-container" data-file-index="1">
                                    <input type="file" class="file-input-hidden" id="fileInput1" accept="*/*">
                                    <div class="btn-add-file" onclick="triggerFileInput('fileInput1')">
                                        <i class="bi bi-cloud-upload me-2"></i>เลือกไฟล์
                                    </div>
                                </div>
                            </div>
                            <code>*แต่ละไฟล์ต้องมีขนาดไม่เกิน 2MB และขนาดไฟล์แนบทั้งหมดรวมกันต้องไม่เกิน 7MB</code><br>
                            <button id="btn_addFiles" type="button" class="btn btn-outline-secondary btn-sm mt-2" onclick="addFileInput()">
                                <i class="bi bi-plus me-1"></i>เพิ่มไฟล์แนบ
                            </button>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i>ยกเลิก
                    </button>
                    <button id="updateBtn" type="button" class="btn btn-primary" onclick="showConfirm()">
                        <i class="bi bi-check-circle me-1"></i>บันทึก
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Confirm Dialog -->
    <div id="confirmDialog" class="confirm-dialog">
        <div class="confirm-box">
            <div class="card glass-card shadow-lg border-0" style="max-width: 480px; width: 100%;">
                <div class="card-body text-center p-5">
                    <div class="mb-4">
                        <i class="bi bi-patch-question-fill icon-warning" style="font-size: 5rem;"></i>
                    </div>
                    <h2 class="mb-3 fw-bold">ยืนยันการดำเนินการ</h2>
                    <p class="text-muted mb-4 fs-5">คุณต้องการบันทึกการเปลี่ยนแปลงนี้หรือไม่?</p>
                    <div class="d-flex gap-3 justify-content-center mt-4">
                        <button class="btn btn-yes btn-lg text-white px-5 py-3" onclick="confirmUpdate('yes')" style="border-radius: 14px;">
                            <i class="bi bi-check-circle-fill me-2"></i>Yes
                        </button>
                        <button class="btn btn-no btn-lg text-white px-5 py-3" onclick="confirmUpdate('no')" style="border-radius: 14px;">
                            <i class="bi bi-x-circle-fill me-2"></i>No
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div id="toast" class="toast-notification"></div>
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const sidebar = document.getElementById("sidebar");
        const mainContent = document.querySelector(".main-content");
        const sidebarToggle = document.getElementById("sidebarToggle");

        function toggleSidebar() {
            if (window.innerWidth <= 768) {
                // Mobile: toggle แสดง/ซ่อนแบบ overlay
                sidebar.classList.toggle("show");
            } else {
                // Desktop: toggle ย่อ/ขยาย sidebar
                sidebar.classList.toggle("collapsed");
                mainContent.classList.toggle("sidebar-collapsed");
            }
        }

        // ปิด sidebar เมื่อคลิกนอก sidebar (เฉพาะ mobile)
        document.addEventListener("click", function(e) {
            if (window.innerWidth <= 768) {
                if (!sidebar.contains(e.target) && !sidebarToggle.contains(e.target)) {
                    sidebar.classList.remove("show");
                }
            }
        });

        // รีเซ็ต state เวลา resize
        window.addEventListener("resize", function() {
            if (window.innerWidth > 768) {
                sidebar.classList.remove("show");
            }
        });

        // Global variables
        let users_list = []; //เก็บ id user ไว้โชว์ให้เลือก ผู้ใช้ ที่เกี่ยวข้อง
        // let mockTasks = [];
        let filesToDelete = []; // array เก็บ id ไฟล์ที่ผู้ใช้เลือกจะลบ
        let file_count_size = []; //เก็บ id และ ขนาดของไฟล์แนบ
    </script>

    <script>
        const overlay = document.getElementById("userSectionOverlay"); //Overley ครอบผู้ใช้ที่เกี่ยวข้อง
        // กด overlay = แจ้งเตือน
        overlay.addEventListener("click", () => {
            // alert("คุณไม่มีสิทธิ์แก้ไขผู้เกี่ยวข้อง");
            showAlert('คุณไม่มีสิทธิ์แก้ไขผู้เกี่ยวข้อง', 'danger');

        });
        // ======================================================================
        // UI: โชว์แจ้งเตือนมุมขวาบน (Toast)
        // คำอธิบาย: แสดงข้อความชั่วคราวมุมขวาบน เพื่อแจ้งผลการทำงาน เช่น success, info, warning, danger
        // การเรียกใช้งาน: showToast('ข้อความ', 'success')
        // ======================================================================
        function showToast(message, type = 'info') {
            const toast = document.getElementById('toast');
            toast.className = `toast-notification toast-${type} show`;
            toast.innerHTML = `
                <i class="bi bi-${type === 'success' ? 'check-circle' : type === 'error' ? 'x-circle' : 'info-circle'} me-2"></i>
                ${message}
            `;

            setTimeout(() => {
                toast.classList.remove('show');
            }, 3000);
        }

        // ======================================================================
        // Modal แก้ไขงาน (handleEdit)
        // คำอธิบาย: ฟังก์ชันนี้เปิด modal แก้ไขงานและโหลดข้อมูล task จาก API
        // ขั้นตอนหลัก:
        //  - แสดง modal และ loading placeholder
        //  - ดึงข้อมูล task, ไฟล์, ผู้เกี่ยวข้อง จาก API
        //  - เติมค่าลงในฟอร์ม เพื่อให้ผู้ใช้แก้ไข
        // หมายเหตุ: ฟังก์ชันนี้ไม่ส่งการแก้ไขขึ้นเซิร์ฟเวอร์ — แค่เตรียม UI ให้แก้ไข
        // ======================================================================
        async function handleEdit(id) {
            // เปิด modal
            const editModal = new bootstrap.Modal(document.getElementById('task_updatetopicModal'));
            editModal.show();

            const old_updateModalBody = document.getElementById("updateModalBody").innerHTML;
            // ใส่ข้อความ "กำลังโหลด"

            updateModalBody = document.getElementById("updateModalBody");
            updateModalBody.hidden = true;

            updateModalBody_load = document.getElementById("updateModalBody_load");
            updateModalBody_load.hidden = false;
            updateModalBody_load.innerHTML = `
        <div class="loading">
            <i class="bi bi-arrow-repeat spin me-2"></i> กำลังโหลด...
        </div>
    `;

            try {
                const urlParams = new URLSearchParams(window.location.search);

                // ดึงค่า task_id
                let taskId = urlParams.get("taskID");
                // เรียก API
                const response = await fetch(`../topic_api/get_task_detail.php?task_id=${taskId}`);
                const data = await response.json();

                if (data.status == "success") {

                    const tasks = data.tasks[0];
                    const tasks_file = data.tasks_file;
                    const task_participant = data.task_participant;
                    console.log('data535:', tasks);
                    updateModalBody.hidden = false;
                    updateModalBody_load.hidden = true;


                    document.getElementById('update_taskID').value = tasks.id; //id งาน
                    document.getElementById('update_taskTitle').value = tasks.title; // หัวข้อ
                    const select = document.getElementById("update_taskCategory"); //หมวดหมู่
                    if (select) {
                        select.value = tasks.category; // ตั้งค่าตรงๆ
                    }
                    document.getElementById('update_taskDescription').value = tasks.task_detail; // รายละเอียด
                    mentionUsers = JSON.parse(tasks.task_mentioned); //ไอดี ผู้ใช้ที่กล่าวถึง
                    updateMentionUsers(); //id ผู้ใช้ที่กล่าวถึง ปรับให้อยู่ในรูปแบบที่จะนำไปใช้ต่อ

                    //ผู้ที่เกี่ยวข้อง
                    selectedUsers = JSON.parse(tasks.task_participant);
                    // แปลง id → object ที่มี {id, name}
                    selectedUsers = selectedUsers.map(id => {
                        const user = users_list.find(u => u.id === id);
                        return user ? {
                            id: user.id,
                            name: user.name
                        } : {
                            id,
                            name: "ไม่พบชื่อ"
                        };
                    });

                    // เคลียร์ container ก่อน ไม่ให้ซ้ำซ้อน
                    const container = document.getElementById("userTagsContainer");
                    container.innerHTML = "";

                    // user ปัจจุบัน + เจ้าของงาน
                    // Use json_encode to safely inject PHP values into JS (preserves types and quoting)
                    const currentUserId = <?= json_encode($_SESSION['user_id']) ?>; // ฝั่ง PHP (number/string)
                    const currentStatus = <?= json_encode($_SESSION['user_status']) ?>; // ฝั่ง PHP (e.g. 'user','admin','executive')
                    const taskOwnerId = tasks.created_by; // จากข้อมูล task
                    console.log('taskOwnerId, currentUserId, currentStatus ->', taskOwnerId, currentUserId, currentStatus);

                    // Allow the task owner, admin, or executive to edit (hide overlay).
                    if (taskOwnerId == currentUserId || ['admin', 'executive'].includes(currentStatus)) {
                        // ถ้าเป็นเจ้าของ หรือ เป็น admin/ executive → ปิด overlay
                        overlay.style.display = "none";
                    } else {
                        // ถ้าไม่ใช่เจ้าของ และไม่ใช่ admin/executive → เปิด overlay
                        overlay.style.display = "block";
                    }


                    updateUserTagsDisplay();
                    populateUserDropdown();

                    const taskStatus = document.getElementById("update_taskStatus"); //สถานะ
                    if (taskStatus) {
                        taskStatus.value = tasks.status; // ตั้งค่าตรงๆ
                    }

                    const taskImportance = document.getElementById("update_taskImportance"); //ความสำคัญ
                    taskImportance.value = tasks.importance; // ตั้งค่าตรงๆ
                    updateStars(tasks.importance); // อัพเดตดาว


                    function showOldFiles() { // แสดงไฟล์เก่า ที่มีทั้งหมดรอไว้ + ปุ่มรอลบ
                        const container = document.getElementById('fileAttachments_old');
                        container.innerHTML = "";
                        tasks_file.forEach((file) => {
                            let icon = '<i class="bi bi-file-earmark"></i>';
                            if (file.file_type === "pdf") icon = '<i class="bi bi-file-earmark-pdf text-danger"></i>';
                            if (["png", "jpg", "jpeg"].includes(file.file_type)) icon = '<i class="bi bi-file-earmark-image text-primary"></i>';
                            if (["word", "docx"].includes(file.file_type)) icon = '<i class="bi bi-file-earmark-word text-info"></i>';
                            if (["excel", "xlsx"].includes(file.file_type)) icon = '<i class="bi bi-file-earmark-excel text-success"></i>';

                            const fileName = file.file_path.split('/').pop().substring(17);

                            const fileDiv = document.createElement('div');
                            fileDiv.className = "file-old d-flex align-items-center justify-content-between mb-2";
                            fileDiv.dataset.fileId = file.file_id;

                            fileDiv.innerHTML = `
                            <div class="d-flex align-items-center">
                                <div class="me-2">${icon}</div>
                                    <a href="${file.file_path}" target="_blank">${fileName}</a>
                                    <span class="ms-2 text-danger small status-label" style="display:none;">(รอลบ)</span>
                                </div>
                                <button type="button" class="btn btn-sm btn-danger ms-2 btn-toggle-delete" onclick="toggleFileDelete(${file.file_id}, this)">
                                    <i class="bi bi-trash"></i>
                                </button>
                            `;

                            container.appendChild(fileDiv);
                        });
                    }

                    // เรียกตอนโหลด
                    showOldFiles();
                    // เริ่มนับจากจำนวนไฟล์เก่า
                    //todo let fileInputCounter = tasks_file.length;
                    // แสดงผลข้อมูลที่ได้แทนข้อความโหลด
                } else {
                    // status ไม่ใช่ success → โยน error เอง
                    throw new Error("API Error: " + (data.message || "ไม่สำเร็จ"));
                }

            } catch (err) {
                console.error("โหลดข้อมูลผิดพลาด:", err);
                document.getElementById("updateModalBody").innerHTML = `
                <div class="text-danger">โหลดข้อมูลไม่สำเร็จ</div>
            `;
                showAlert('เกิดข้อผิดพลาด', 'danger');

                // ดึง query string จาก URL ปัจจุบัน
                const urlParams = new URLSearchParams(window.location.search);
                // ดึงค่า task_id
                let taskId = urlParams.get("taskID"); // ถ้าไม่มีค่าจะได้ null
                // รอ 0.5 วิ แล้วค่อยโหลดใหม่
                api_loadTasks(taskId);
                setTimeout(() => {
                    // ปิด modal ถ้า error
                    editModal.hide();
                }, 500);
            }

            // showToast('เปิดหน้าแก้ไขงาน...', 'info');
            // console.log('Edit task');
        }

        // ======================================================================
        // จัดการไฟล์เก่า (ลบ/ยกเลิกลบ)
        // คำอธิบาย: สลับสถานะ 'รอลบ' ให้กับไฟล์ที่มีอยู่แล้ว และเก็บ id ลงใน filesToDelete
        // การใช้งาน: ปุ่มลบไฟล์ในรายการไฟล์เก่า จะเรียกฟังก์ชันนี้
        // ======================================================================
        function toggleFileDelete(fileId, btn) {
            const parent = btn.closest(".file-old");
            const statusLabel = parent.querySelector(".status-label");

            if (!filesToDelete.includes(fileId)) {
                // 👉 กด "ลบ" → เข้าโหมดรอลบ
                // alert("กำลังเตรียมลบไฟล์...");
                showAlert('กำลังเตรียมลบไฟล์...', 'warning');

                filesToDelete.push(fileId);

                parent.style.opacity = "0.5";
                statusLabel.style.display = "inline";

                btn.classList.remove("btn-danger");
                btn.classList.add("btn-secondary");
                btn.innerHTML = '<i class="bi bi-arrow-counterclockwise"></i>'; // ปุ่มยกเลิก

            } else {
                // 👉 กด "ยกเลิก" → กลับมาปกติ
                filesToDelete = filesToDelete.filter(id => id !== fileId);

                parent.style.opacity = "1";
                statusLabel.style.display = "none";

                btn.classList.remove("btn-secondary");
                btn.classList.add("btn-danger");
                btn.innerHTML = '<i class="bi bi-trash"></i>'; // ปุ่มลบ
            }

            console.log("Files queued for delete:", filesToDelete);
        }
    </script>

    <!-- สคริปฟิลเตอร์ -->
    <script>
        // ======================================================================
        // โหลดรายชื่อผู้ใช้จาก API
        // คำอธิบาย: ฟังก์ชันนี้ดึงรายการผู้ใช้ เพื่อใช้ใน dropdown, ระบบ mention และการเลือกผู้เกี่ยวข้อง
        // ======================================================================
        async function api_loadUsers() { //โหลดรายชื่อผู้ใช้
            try {
                const response = await fetch(`../topic_api/get_user.php`);

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const data = await response.json();

                if (Array.isArray(data.users)) {
                    users_list = [...data.users]; // assign ใหม่เลย
                } else {
                    console.warn("API response ไม่มี users array", data);
                }

                console.log('users:565', users_list);

            } catch (error) {
                console.error('Error loading users:', error);
            }
        }

        // ======================================================================
        // โหลดข้อมูลงานและแสดงผลบนหน้า (api_loadTasks)
        // คำอธิบาย: ดึงรายละเอียดงาน (task) และไฟล์ที่แนบมา แล้วสร้าง HTML แสดงผลใน `#tasksContainer`
        // หมายเหตุ: ถ้าเป็น error จะแสดงข้อความว่าไม่พบงาน
        // ======================================================================
        async function api_loadTasks(taskId) {
            try {
                const response = await fetch(`../topic_api/get_task_detail.php?task_id=${taskId}`);

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const data = await response.json();
                const tasks = data.tasks;
                const tasks_file = data.tasks_file;
                const task_participant = data.task_participant;

                // แสดงผลใน console
                console.log('tasks:586', tasks);
                console.log('tasks_file:587', tasks_file);
                console.log('task_participant:588', task_participant);
                // mockTasks.length = 0; // ล้าง array
                // mockTasks.push(...data.tasks); // ใส่ค่าใหม่
                // mockTasks = [...data.tasks];
                // console.log(data);

                // allTasks = [...mockTasks];
                // console.log(data);

                // applyFiltersAndSort();
                // updateSidebarCounts();
                const container = document.getElementById('tasksContainer');
                // const startIndex = (currentPage - 1) * itemsPerPage;
                // const endIndex = startIndex + itemsPerPage;
                // const tasksToShow = filteredTasks.slice(startIndex, endIndex);

                if (data.status === "error") {
                    container.innerHTML = `
                    <div class="text-center py-5">
                        <i class="bi bi-inbox display-1 text-muted"></i>
                        <h4 class="mt-3 text-muted">ไม่พบงานที่ค้นหา</h4>
                        <p class="text-muted">ลิงค์งานที่คุณติดตามอาจเสียหายหรืออาจได้มีการลบออกไปแล้ว</p>
                    </div>
                `;
                    return;
                } else {

                    // container.hidden = true;
                    container.innerHTML = tasks.map(task => {
                        let text = task.task_detail || "";

                        // แทนที่ mention (@...,)
                        text = text.replace(/@[^,]+,/g, match => {
                            let clean = match.slice(0, -1); // ตัด comma ทิ้ง
                            return `<span class="mention-highlight">${clean}</span>`;
                        });

                        // แปลง \n → <br>
                        text = text.replace(/\n/g, "<br>");

                        return `
                    <div class="task-container">
                        <div class="task-card">
                            <!-- Task Header -->
                            <div class="task-header">
                            <div class="btn-header">
                                <button class="btn-edit-header" onclick="handleEdit('${taskId}')">
                                    <i class="bi bi-pencil-square"></i>
                                    <span>แก้ไข</span>
                                </button>
                                 <!-- ปุ่มแสดง Log -->
                                <button class="btn-edit-header" onclick="handleShowLog('${taskId}')">
                                    <i class="bi bi-journal-text"></i>
                                    <span>Log</span>
                                </button>
                                </div>
                                <h1 class="task-title">${task.title}</h1>
                                <div class="task-meta">
                                    <span class="category-badge">
                                        <i class="bi bi-code-slash me-1"></i>${task.category}
                                    </span>
                                    <span class="task-id">
                                        <i class="bi bi-hash me-1"></i>${`TASK-${new Date(task.created_at).getFullYear()}-${String(task.id).padStart(3,'0')}`}
                                    </span>
                                    <span class="created-date">
                                        <i class="bi bi-calendar3 me-1"></i>${formatDate(task.created_at)}
                                    </span>
                                    <span class="priority-badge"><i class="bi bi-speedometer2 me-1"></i>เร่งด่วน ${(() => {
                                        const imp = parseInt(task.importance, 10) || 0;
                                        let stars = '';
                                        for (let i = 1; i <= 5; i++) {
                                            if (i <= imp) {
                                                stars += '<i class="bi bi-star-fill text-warning ms-1" aria-hidden="true"></i>';
                                            } else {
                                                stars += '<i class="bi bi-star text-muted ms-1" aria-hidden="true"></i>';
                                            }
                                        }
                                        return stars;
                                    })()}</span>
                                    <span class="status-badge ">
                                        <i class="bi bi-clock me-1"></i>${getStatusName(task.status)}
                                    </span>
                                </div>
                            </div>

                            <!-- Task Body -->
                            <div class="task-body">
                                <!-- Description Section -->
                                <div class="section">
                                    <h3 class="section-title">
                                        <i class="bi bi-file-text text-primary"></i>รายละเอียด
                                    </h3>
                                   <!-- <div class="description-box"> -->
                                    <div>${text}</div>
                                </div>

                                <!-- Users Section -->
                                <div class="section">
                                    <div class="row">
                                        <div class="col-md-12" style="margin-bottom:10px">
                                            <h3 class="section-title">
                                                <i class="bi bi-at text-warning"></i>ผู้สร้างรายการ
                                            </h3>
                                            <div class="user-badges">
                                                <div class="user-badge mentioned">
                                                    <i class="bi bi-person-fill-check"></i>${task.fullname}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <h3 class="section-title">
                                                <i class="bi bi-people text-info"></i>ผู้เกี่ยวข้อง
                                            </h3>
                                            <div class="user-badges">
                                            ${task_participant.map(name => {
                                                return `
                                                <div class="user-badge">
                                                    <i class="bi bi-person-circle"></i> ${name.fd_user_fullname}
                                                </div>
                                                `;
                                            }).join('')}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Files Section -->
                                <!-- เช็คว่ามีไฟล์ไหม -->
                                ${tasks_file && tasks_file.length > 0 ? `
                                <div class="section">
                                    <h3 class="section-title">
                                        <i class="bi bi-paperclip text-success"></i>ไฟล์แนบ (${tasks_file.length} ไฟล์)
                                    </h3>
                                    <div class="files-grid">
                                      ${tasks_file.map(file => `
                                      <a href="../file_upload/${file.file_path}" target="_blank">
                                        ${file.file_type ==  'png' ? `
                                        <div class="file-card">
                                            <div class="file-icon image">
                                                <i class="bi bi-file-image"></i>
                                            </div>
                                            <div class="file-info">
                                                <div class="file-name"> ${file.file_path.substring(22)}</div>
                                            </div>
                                        </div>
                                        ` : ``}
                                        ${file.file_type ==  'jpg' ? `
                                        <div class="file-card">
                                            <div class="file-icon image">
                                                <i class="bi bi-file-image"></i>
                                            </div>
                                            <div class="file-info">
                                                <div class="file-name"> ${file.file_path.substring(22)}</div>
                                            </div>
                                        </div>
                                        ` : ``}
                                        ${file.file_type ==  'pdf' ? `
                                        <div class="file-card">
                                            <div class="file-icon pdf">
                                                <i class="bi bi-file-pdf"></i>
                                            </div>
                                            <div class="file-info">
                                                <div class="file-name"> ${file.file_path.substring(22)}</div>
                                            </div>
                                        </div>
                                        ` : ``}
                                        ${file.file_type ==  'word' ? `
                                        <div class="file-card">
                                            <div class="file-icon document">
                                                <i class="bi bi-file-word"></i>
                                            </div>
                                            <div class="file-info">
                                                <div class="file-name"> ${file.file_path.substring(22)}</div>
                                            </div>
                                        </div>
                                        ` : ``}
                                        ${file.file_type ==  'excel' ? `
                                        <div class="file-card">
                                            <div class="file-icon document">
                                                <i class="bi bi-file-excel"></i>
                                            </div>
                                            <div class="file-info">
                                                <div class="file-name"> ${file.file_path.substring(22)}</div>
                                            </div>
                                        </div>
                                        </a>
                                        ` : ``}
                                        


                                      `).join('')}
                                  </div>
                                </div>
                                ` : ``}
                              
                            </div>
                        </div>
                    </div>
                `;
                    }).join("");
                }

                return data;

            } catch (error) {
                console.error('Error loading tasks:', error);
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            // ดึง query string จาก URL ปัจจุบัน
            const urlParams = new URLSearchParams(window.location.search);

            // ดึงค่า task_id
            let taskId = urlParams.get("taskID"); // ถ้าไม่มีค่าจะได้ null
            console.log('taskId', taskId);
            api_loadUsers();
            api_loadTasks(taskId);

        });
        // Initialize the application
        document.addEventListener('DOMContentLoaded', function() {
            // allTasks = [...mockTasks];
            // applyFiltersAndSort();
            updateSidebarCounts();
        });

        // Toggle sidebar for mobile
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');

            sidebar.classList.toggle('show');
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('sidebar-collapsed');
        }


        // Update sidebar counts
        function updateSidebarCounts() {
            // const total = allTasks.length;
            // const pending = allTasks.filter(t => t.status === 'pending').length;
            // const inProgress = allTasks.filter(t => t.status === 'in-progress').length;
            // const completed = allTasks.filter(t => t.status === 'completed').length;

            // document.getElementById('totalTaskCount').textContent = "";
            // document.getElementById('pendingTaskCount').textContent = "";
            // document.getElementById('progressTaskCount').textContent = "";
            // document.getElementById('completedTaskCount').textContent = "";
        }

        // Utility functions
        function getCategoryName(category) {
            const categories = {
                'development': 'พัฒนา',
                'design': 'ออกแบบ',
                'marketing': 'การตลาด',
                'meeting': 'ประชุม',
                'other': 'อื่นๆ'
            };
            return categories[category] || 'อื่นๆ';
        }

        function getStatusName(status) {
            const statuses = {
                'pending': 'รอดำเนินการ',
                'in-progress': 'กำลังดำเนินการ',
                'completed': 'เสร็จสิ้น'
            };
            return statuses[status] || 'ไม่ทราบสถานะ';
        }

        function formatDate(dateString) {
            const date = new Date(dateString);
            const options = {
                year: 'numeric',
                month: 'short',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            };
            return date.toLocaleDateString('th-TH', options);
        }

        function showLoading() {
            isLoading = true;
            document.getElementById('loadingIndicator').classList.remove('d-none');
            document.getElementById('tasksContainer').style.opacity = '0.5';
        }

        function hideLoading() {
            isLoading = false;
            document.getElementById('loadingIndicator').classList.add('d-none');
            document.getElementById('tasksContainer').style.opacity = '1';
        }

        // Handle responsive sidebar
        window.addEventListener('resize', function() {
            if (window.innerWidth <= 768) {
                document.getElementById('sidebarToggle').style.display = 'flex';
            } else {
                document.getElementById('sidebarToggle').style.display = 'none';
                document.getElementById('sidebar').classList.remove('show');
            }
        });
    </script>
    <!-- สคริปฟิลเตอร์ -->

    <script>
        // Mock data - normally from API
        const users = users_list;
        // Global variables
        let selectedUsers = []; //เก็บ ไอดี ผู้ที่เกี่ยวข้อง
        let mentionUsers = []; //เก็บ ชื่อ ไอดี ที่ถูกกล่าวถึง
        let fileInputCounter = 1;
        let currentMentionStart = -1;
        let selectedMentionIndex = -1;

        // Initialize when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            setupMentionSystem();
            setupFileInput('fileInput1');
            populateUserDropdown();
            setupModalEvents();
        });

        // Modal Events Setup
        function setupModalEvents() {
            const modal = document.getElementById('task_updatetopicModal');

            modal.addEventListener('hidden.bs.modal', function() {
                resetForm();
            });

            modal.addEventListener('show.bs.modal', function() {
                resetinput_Form();
                populateUserDropdown();
            });

            // Close dropdowns when clicking outside
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.position-relative')) {
                    hideMentionDropdown();
                }
                if (!e.target.closest('.user-tags-container') && !e.target.closest('#userSelect')) {
                    hideUserDropdown();
                }
            });
        }

        // Form Reset
        function resetForm() { // รีเซ็ตฟอร์มเมื่อปิด modal
            document.getElementById('task_updatetopicForm').reset();
            const form = document.getElementById('task_updatetopicForm');
            form.classList.remove('was-validated');

            // ลบ class validation (กรอบแดง/กรอบเขียว) ทั้งหมด เมื่อรีเซ็ตฟอร์ม
            form.querySelectorAll('input, textarea, select').forEach(el => {
                el.classList.remove('is-invalid');
                el.classList.remove('is-valid');
            });
            // เคลียร์ข้อมูลที่เก็บไว้
            filesToDelete = [];
            selectedUsers = [];
            mentionUsers = [];
            file_count_size = [];
            fileInputCounter = 1;
            updateUserTagsDisplay();
            resetFileAttachments();
            hideMentionDropdown();
            hideUserDropdown();
        }

        // User Management
        function populateUserDropdown() {
            const userSelect = document.getElementById('userSelect');
            userSelect.innerHTML = '<option value="">เลือกผู้ใช้</option>';

            users_list.forEach(user => {
                if (!selectedUsers.find(u => u.id === user.id)) {
                    const option = document.createElement('option');
                    option.value = user.id;
                    option.textContent = user.name;
                    userSelect.appendChild(option);
                }
            });
        }

        function showUserDropdown() {
            const userSelect = document.getElementById('userSelect');
            userSelect.classList.remove('d-none');
            userSelect.focus();

            // Add change event listener
            userSelect.onchange = function() {
                if (this.value) {
                    addUser(parseInt(this.value));
                    this.value = '';
                    hideUserDropdown();
                }
            };
        }

        function hideUserDropdown() {
            const userSelect = document.getElementById('userSelect');
            userSelect.classList.add('d-none');
        }

        function addUser(userId) {
            const user = users_list.find(u => u.id === userId);
            if (user && !selectedUsers.find(u => u.id === user.id)) {
                selectedUsers.push(user);
                updateUserTagsDisplay();
                populateUserDropdown();
            }
        }

        function removeUser(userId) {
            selectedUsers = selectedUsers.filter(user => user.id !== userId);
            updateUserTagsDisplay();
            populateUserDropdown();
        }

        function updateUserTagsDisplay() {
            const container = document.getElementById('userTagsContainer');
            container.innerHTML = '';
            console.log(selectedUsers);
            selectedUsers.forEach(user => {
                const userTag = document.createElement('span');
                userTag.className = 'user-tag';
                userTag.innerHTML = `
                    ${user.name}
                    <button type="button" class="btn-remove" onclick="removeUser(${user.id})" title="ลบ">
                        <i class="bi bi-x"></i>
                    </button>
                `;
                container.appendChild(userTag);
            });

            const addBtn = document.createElement('button');
            addBtn.type = 'button';
            addBtn.className = 'btn btn-add-user';
            addBtn.innerHTML = '<i class="bi bi-plus me-1"></i>เพิ่มผู้ใช้';
            addBtn.onclick = showUserDropdown;
            container.appendChild(addBtn);
        }

        // Mention System
        // ======================================================================
        // ระบบ mention (@) ใน textarea
        // คำอธิบาย: ตรวจการพิมพ์ @ เพื่อแสดง dropdown ของผู้ใช้ที่ตรงกับคำค้น
        // ฟังก์ชันหลัก: handleMentionInput, handleMentionKeydown, showMentionDropdown, selectMentionUser
        // ======================================================================
        function setupMentionSystem() { // ตั้งค่าระบบ mention textarea
            const textarea = document.getElementById('update_taskDescription');
            const dropdown = document.getElementById('mentionDropdown');

            textarea.addEventListener('input', function(e) {
                handleMentionInput(e);
            });

            textarea.addEventListener('keydown', function(e) {
                handleMentionKeydown(e);
            });
        }

        function handleMentionInput(e) { // ตรวจการพิมพ์ @
            const textarea = e.target;
            const cursorPos = textarea.selectionStart;
            const text = textarea.value;

            // Find @ symbol before cursor
            let atPos = text.lastIndexOf('@', cursorPos - 1);

            if (atPos !== -1) {
                const textAfterAt = text.substring(atPos + 1, cursorPos);

                // Check if there's a space before @, or if it's at start
                const charBeforeAt = atPos > 0 ? text.charAt(atPos - 1) : ' ';

                if ((charBeforeAt === ' ' || charBeforeAt === '\n' || atPos === 0) &&
                    !textAfterAt.includes(' ') && !textAfterAt.includes('\n')) {
                    currentMentionStart = atPos;
                    showMentionDropdown(textAfterAt, textarea);
                } else {
                    hideMentionDropdown();
                }
            } else {
                hideMentionDropdown();
            }
        }

        function handleMentionKeydown(e) { // จัดการปุ่มลูกศรใน dropdown
            const dropdown = document.getElementById('mentionDropdown');

            if (dropdown.style.display === 'block') {
                const items = dropdown.querySelectorAll('.mention-item');

                if (items.length > 0) {
                    if (e.key === 'ArrowDown') {
                        e.preventDefault();
                        selectedMentionIndex = Math.min(selectedMentionIndex + 1, items.length - 1);
                        updateMentionSelection(items);
                    } else if (e.key === 'ArrowUp') {
                        e.preventDefault();
                        selectedMentionIndex = Math.max(selectedMentionIndex - 1, 0);
                        updateMentionSelection(items);
                    } else if (e.key === 'Enter' || e.key === 'Tab') {
                        e.preventDefault();
                        if (selectedMentionIndex >= 0 && items[selectedMentionIndex]) {
                            const userId = parseInt(items[selectedMentionIndex].dataset.userId);
                            const user = users.find(u => u.id === userId);
                            if (user) {
                                selectMentionUser(user);
                            }
                        }
                    } else if (e.key === 'Escape') {
                        hideMentionDropdown();
                    }
                }
            }
        }

        function showMentionDropdown(query, textarea) { // แสดง dropdown
            const dropdown = document.getElementById('mentionDropdown');

            // Filter users based on query
            const filteredUsers = users_list.filter(user =>
                user.name.toLowerCase().includes(query.toLowerCase())
            );

            if (filteredUsers.length === 0) {
                hideMentionDropdown();
                return;
            }

            dropdown.innerHTML = '';
            filteredUsers.forEach((user, index) => {
                const item = document.createElement('div');
                item.className = 'mention-item';
                item.dataset.userId = user.id;
                item.innerHTML = `
                    <div class="mention-avatar">
                        <i class="bi bi-person"></i>
                    </div>
                    <div class="mention-info">
                        <div class="mention-name">${user.name}</div>
                        <!-- <div class="mention-username">@${user.username}</div> -->
                    </div>
                `;

                item.addEventListener('click', () => selectMentionUser(user));
                dropdown.appendChild(item);
            });

            // Position dropdown
            const rect = textarea.getBoundingClientRect();
            const containerRect = textarea.closest('.position-relative').getBoundingClientRect();

            dropdown.style.top = `${rect.bottom - containerRect.top + 5}px`;
            dropdown.style.left = `${rect.left - containerRect.left}px`;
            dropdown.style.display = 'block';

            selectedMentionIndex = 0;
            updateMentionSelection(dropdown.querySelectorAll('.mention-item'));
        }

        function updateMentionSelection(items) { // ไฮไลต์รายการที่เลือก
            items.forEach((item, index) => {
                item.classList.toggle('selected', index === selectedMentionIndex);
            });
        }

        function selectMentionUser(user) {
            const textarea = document.getElementById('update_taskDescription');
            const cursorPos = textarea.selectionStart;
            const text = textarea.value;

            // Find @ position
            const atPos = text.lastIndexOf('@', cursorPos - 1);

            // Replace @query with @username
            const beforeMention = text.substring(0, atPos);
            const afterMention = text.substring(cursorPos);
            // const mentionText = `@${user.username}`;
            const mentionText = `@${user.name}, `;
            //const mentionText = `@${user.name.replace(/\s+/g, ".")}`; //@ชื่อ.สกุล

            textarea.value = beforeMention + mentionText + afterMention;

            // Set cursor position after mention
            const newCursorPos = atPos + mentionText.length;
            textarea.setSelectionRange(newCursorPos, newCursorPos);

            // Add to mentioned users
            if (!mentionUsers.find(u => u.id === user.id)) {
                mentionUsers.push(user);
            }
            // const availableFriends = this.friends.filter(friend =>                  
            // !this.mentionedFriends.has(friend.id) &&
            //         friend.name.toLowerCase().includes(query.toLowerCase())
            //     );

            hideMentionDropdown();
            textarea.focus();
            updateMentionUsers();
        }

        function updateMentionUsers() { // อัปเดต mentionUsers ตามข้อความใน textarea
            const text = document.getElementById('update_taskDescription').value;

            // สร้าง array ใหม่จาก text ที่ตรงจริง ๆ
            const foundUsers = users_list.filter(user => {
                const pattern = new RegExp(`@\\${user.name}\\,`, "g");
                return pattern.test(text);
            });

            // อัปเดต mentionUsers ให้ตรงกับ foundUsers
            mentionUsers = foundUsers.map(u => ({
                id: u.id,
                name: u.name
            }));

            console.log("mentionUsers1366:", mentionUsers);
        }

        document.getElementById('update_taskDescription').addEventListener("input", updateMentionUsers);

        function hideMentionDropdown() {
            document.getElementById('mentionDropdown').style.display = 'none';
            selectedMentionIndex = -1;
        }

        // ======================================================================
        // การจัดการไฟล์แนบ (File inputs)
        // คำอธิบาย: ผูก event ให้กับ input type=file แต่ละตัว ตรวจขนาดไฟล์ต่อไฟล์และขนาดรวม
        // - จำกัดไฟล์ต่อไฟล์ ไม่เกิน 2MB
        // - จำกัดขนาดรวม ไม่เกิน 7MB (ปิดปุ่มเพิ่มไฟล์เมื่อเกิน)
        // ฟังก์ชันที่เกี่ยวข้อง: setupFileInput, displaySelectedFile, removeFileInput, resetFileAttachments
        // ======================================================================
        // File Management
        function setupFileInput(inputId) {
            const input = document.getElementById(inputId);
            if (!input) return;

            console.log('setupFileInput -> input:', input);

            // 🔎 เช็คว่าตอนนี้ input มีไฟล์อยู่ไหม
            if (input.files && input.files.length > 0) {
                console.log(`📂 input[${inputId}] มีไฟล์อยู่แล้ว:`, input.files[0].name, input.files[0].size, "bytes");
            } else {
                file_count_size = file_count_size.filter(item => item.id !== inputId);
                console.log('ขนาดไฟล์รวม', file_count_size);

                console.log(`📂 input[${inputId}] ไม่มีไฟล์`);
            }

            input.addEventListener('change', function() {
                if (this.files.length > 0) {
                    displaySelectedFile(this);
                } else {
                    console.log(`❌ input[${inputId}] ถูกล้าง ไม่มีไฟล์`);
                }
            });

            // รวมขนาดทั้งหมด
            let totalSize = file_count_size.reduce((sum, item) => sum + item.size, 0);
            let totalMB = (totalSize / (1024 * 1024)).toFixed(2);
            console.log('totalMB', totalMB);

            if (totalMB >= 7) {
                document.getElementById('btn_addFiles').disabled = true;
            } else {
                document.getElementById('btn_addFiles').disabled = false;
            }
        }

        function triggerFileInput(inputId) {
            document.getElementById(inputId).click();
        }

        function addFileInput() {
            fileInputCounter++;
            const container = document.getElementById('fileAttachments');

            const fileInputContainer = document.createElement('div');
            fileInputContainer.className = 'file-input-container';
            fileInputContainer.dataset.fileIndex = fileInputCounter;

            const inputId = `fileInput${fileInputCounter}`;
            fileInputContainer.innerHTML = `
                <input type="file" class="file-input-hidden" id="${inputId}" accept="*/*">
                <div class="btn-add-file" onclick="triggerFileInput('${inputId}')">
                    <i class="bi bi-cloud-upload me-2"></i>เลือกไฟล์
                </div>
            `;

            container.appendChild(fileInputContainer);
            setupFileInput(inputId);
        }

        // ======================================================================
        // แสดงไฟล์ที่เลือกและตรวจสอบขนาด
        // คำอธิบาย: เมื่อผู้ใช้เลือกไฟล์ ฟังก์ชันนี้จะตรวจขนาดไฟล์ (สูงสุด 2MB ต่อไฟล์)
        // และอัปเดตตัวแปร file_count_size เพื่อคำนวณขนาดรวม (จำกัดรวม 7MB)
        // ======================================================================
        // Enhanced file input validation
        function displaySelectedFile(input) {
            if (!input.files || input.files.length === 0) {
                console.warn('No file selected for input:', input.id);
                return;
            }

            const file = input.files[0];
            const container = input.parentElement;

            // Validate file
            if (file.size > 2 * 1024 * 1024) {
                showAlert(`ไฟล์ "${file.name}" มีขนาดใหญ่เกินไป (สูงสุด 2MB)`, 'danger');
                input.value = ''; // Clear the input
                return;
            } else {
                console.log('ก่อนinputId', input);
                // ลบข้อมูลเก่าออกก่อน (กันซ้ำ)
                file_count_size = file_count_size.filter(item => item.id !== input);

                // เพิ่มข้อมูลใหม่
                file_count_size.push({
                    id: input.id,
                    size: file.size
                });
                //file_count_size = file_count_size + file.size; //เก็บขนาดไฟล์
                console.log('ขนาดไฟล์รวม', file_count_size);
            }

            console.log(`📎 File selected: ${file.name} (${formatFileSize(file.size)})`);

            container.innerHTML = `
                <div class="file-item" data-file-attached="true">
                    <div class="file-info">
                        <div class="file-icon">
                            <i class="bi bi-file-earmark${getFileIcon(file.type)}"></i>
                        </div>
                        <div class="file-details">
                            <input type="file" class="file-input-send" name="${input.id}" id="${input.id}" hidden>
                            <div class="file-name" title="${file.name}">${truncateFileName(file.name, 30)}</div>
                            <div class="file-size">${formatFileSize(file.size)}</div>
                            <div class="file-type text-muted" style="font-size: 0.75rem;">${file.type || 'Unknown type'}</div>
                        </div>
                    </div>
                    <button type="button" class="btn-remove-file" onclick="removeFileInput(this)" title="ลบไฟล์">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            `;
            const fileInput_new = document.getElementById(input.id);
            fileInput_new.value = "";
            const dt = new DataTransfer();
            dt.items.add(input.files[0]);
            fileInput_new.files = dt.files;

            // รวมขนาดทั้งหมด
            let totalSize = file_count_size.reduce((sum, item) => sum + item.size, 0);
            let totalMB = (totalSize / (1024 * 1024)).toFixed(2);
            console.log('totalMB', totalMB);

            if (totalMB >= 7) {
                document.getElementById('btn_addFiles').disabled = true;
            } else {
                document.getElementById('btn_addFiles').disabled = false;
            }
        }

        function getFileIcon(mimeType) {
            if (!mimeType) return '';

            if (mimeType.startsWith('image/')) return '-image';
            if (mimeType.startsWith('video/')) return '-play';
            if (mimeType.startsWith('audio/')) return '-music';
            if (mimeType.includes('pdf')) return '-pdf';
            if (mimeType.includes('word')) return '-word';
            if (mimeType.includes('excel') || mimeType.includes('spreadsheet')) return '-excel';
            if (mimeType.includes('powerpoint') || mimeType.includes('presentation')) return '-ppt';
            if (mimeType.includes('zip') || mimeType.includes('rar') || mimeType.includes('archive')) return '-zip';
            if (mimeType.includes('text')) return '-text';

            return '';
        }

        function truncateFileName(fileName, maxLength) {
            if (fileName.length <= maxLength) return fileName;

            const extension = fileName.split('.').pop();
            const nameWithoutExt = fileName.substring(0, fileName.lastIndexOf('.'));
            const truncatedName = nameWithoutExt.substring(0, maxLength - extension.length - 4);

            return `${truncatedName}...${extension}`;
        }

        function removeFileInput(button) {
            const container = button.closest('.file-input-container');
            const fileItem = button.closest('.file-item');

            if (container && fileItem) {
                console.log('🗑️ Removing file input');

                // Find the hidden input and clear it
                const input = container.querySelector('.file-input-hidden');
                if (input) {
                    input.value = '';
                    console.log('✅ File input cleared:', input.id);
                }

                // Reset to upload state
                const fileIndex = container.dataset.fileIndex;
                const inputId = `fileInput${fileIndex}`;

                container.innerHTML = `
                    <input type="file" class="file-input-hidden" id="${inputId}" accept="*/*">
                    <div class="btn-add-file" onclick="triggerFileInput('${inputId}')">
                        <i class="bi bi-cloud-upload me-2"></i>เลือกไฟล์
                    </div>
                `;

                setupFileInput(inputId);
            }
        }

        function resetFileAttachments() {
            const container = document.getElementById('fileAttachments');
            container.innerHTML = `
                <div class="file-input-container" data-file-index="1">
                    <input type="file" class="file-input-hidden" id="fileInput1" accept="*/*">
                    <div class="btn-add-file" onclick="triggerFileInput('fileInput1')">
                        <i class="bi bi-cloud-upload me-2"></i>เลือกไฟล์
                    </div>
                </div>
            `;
            fileInputCounter = 1;
            setupFileInput('fileInput1');
            console.log('🔄 File attachments reset');
        }

        // ======================================================================
        // ตัวช่วยตรวจสอบไฟล์ทั้งหมด (validateAllFiles)
        // คำอธิบาย: ตรวจสอบ input แต่ละตัว และรวบรวมไฟล์ที่พร้อมส่งไปยัง API
        // ======================================================================
        // File validation helper
        function validateAllFiles() {
            const fileInputs = document.querySelectorAll('.file-input-hidden');
            const validFiles = [];

            fileInputs.forEach(input => {
                if (input.files && input.files.length > 0) {
                    const file = input.files[0];

                    if (file.size > 10 * 1024 * 1024) {
                        throw new Error(`ไฟล์ "${file.name}" มีขนาดใหญ่เกินไป`);
                    }

                    validFiles.push({
                        input: input,
                        file: file,
                        name: file.name,
                        size: file.size,
                        type: file.type
                    });
                }
            });

            return validFiles;
        }

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        // ======================================================================
        // ตรวจสอบฟอร์ม (validateForm)
        // คำอธิบาย: ตรวจ required fields ในฟอร์ม และแสดงสถานะ validation ด้วย Bootstrap classes
        // คืนค่า: true ถ้าฟอร์มผ่าน, false ถ้าไม่ผ่าน
        // ======================================================================
        // Form Validation & Save
        function validateForm() {
            const form = document.getElementById('task_updatetopicForm');
            let isValid = true;

            // รีเซ็ต validation เดิม
            form.classList.remove('was-validated');

            // หา element ทุกตัวใน form ที่มี required
            const requiredFields = form.querySelectorAll('[required]');

            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.classList.add('is-invalid'); // ถ้าไม่มีค่า → invalid
                    isValid = false;
                } else {
                    field.classList.remove('is-invalid'); // ถ้ามีค่า → เอา invalid ออก
                    field.classList.add('is-valid'); // optional: โชว์ valid (เขียว)
                }
            });

            // ใส่ class เพื่อให้ Bootstrap แสดงผล
            form.classList.add('was-validated');

            return isValid;
        }

        function showConfirm() {
            document.getElementById('confirmDialog').classList.add('show');
        }

        function hideConfirm() {
            document.getElementById('confirmDialog').classList.remove('show');
        }

        function confirmUpdate(click_value) { //confirm การแก้ไข
            hideConfirm(); //ปิด popup yes no
            if (click_value == "yes") {
                if (!validateForm()) { //เช็คค่าว่างในตัว form req
                    console.log('!validateForm');
                    return;
                }
                // ⬇️ ไป update
                updateTask();
            }
        }

        // ======================================================================
        // เตรียมข้อมูลและบันทึกงาน (updateTask)
        // คำอธิบาย: ตรวจขนาดไฟล์รวมก่อน แล้วรวบรวมข้อมูลจากฟอร์มเป็น object เพื่อนำไปส่ง
        // ======================================================================
        function updateTask() {
            if (!validateForm()) {
                console.log('!validateForm');
                return;
            }
            let totalSize = file_count_size.reduce((sum, item) => sum + item.size, 0); //ขนาดไฟล์รวม
            let totalMB = (totalSize / (1024 * 1024)).toFixed(2); //แปลงเป็น MB
            if (totalMB > 7) { //ถ้าเกิน 7MB
                showAlert(`ขนาดไฟล์รวมทั้งหมด มีขนาดใหญ่เกินไป (สูงสุด 7MB)`, 'danger');
                return;
            }

            const formData = {
                id: document.getElementById('update_taskID').value.trim(), //ไอดี หัวข้อ
                title: document.getElementById('update_taskTitle').value.trim(), //หัวข้อ
                category: document.getElementById('update_taskCategory').value, //หมวดหมู่
                description: document.getElementById('update_taskDescription').value.trim(), //รายละเอียด
                staus: document.getElementById('update_taskStatus').value, //สถานะ
                importance: document.getElementById('update_taskImportance').value, //ความสำคัญ
                relatedUsers: selectedUsers.map(user => user.id), //ไอดี ผู้ที่เกี่ยวข้อง
                mentionedUsers: mentionUsers.map(user => user.id), //ไอดี ที่ถูกกล่าวถึง
                filesToDelete: filesToDelete, //ไฟล์ที่ลบ
                files: []
            };

            // // Collect files
            const fileInputs = document.querySelectorAll('.file-input-send');
            // // const fileInputs = document.querySelectorAll('.file-input-hidden');
            fileInputs.forEach(input => { //input type=file ที่มีไฟล์
                if (input.files.length > 0) {
                    formData.files.push({
                        name: input.files[0].name,
                        size: input.files[0].size,
                        type: input.files[0].type,
                        file: input.files[0]
                    });
                }
            });

            console.log('Data to send:', formData);
            updateTaskToAPI(formData);
        }

        // ======================================================================
        // ส่งข้อมูลการอัปเดตไปยัง API (updateTaskToAPI)
        // คำอธิบาย: สร้าง FormData, แนบไฟล์ และเรียก endpoint เพื่อบันทึกการแก้ไข
        // ======================================================================
        // API Integration Functions
        function updateTaskToAPI(formData) {

            const apiFormData = new FormData();

            // // Basic form data
            apiFormData.append('id', formData.id);
            apiFormData.append('title', formData.title);
            apiFormData.append('category', formData.category);
            apiFormData.append('description', formData.description);
            apiFormData.append('taskStatus', formData.staus);
            apiFormData.append('taskImportance', formData.importance);
            apiFormData.append('related_users', JSON.stringify(formData.relatedUsers));
            apiFormData.append('mentioned_users', JSON.stringify(formData.mentionedUsers));
            apiFormData.append('filesToDelete', JSON.stringify(formData.filesToDelete));

            // Files
            formData.files.forEach((fileData, index) => {
                apiFormData.append(`files[${index}]`, fileData.file);
            });
            fetch('../topic_api/update_task.php', {
                    method: 'POST',
                    body: apiFormData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.status === "success") {
                        document.getElementById('tasksContainer').innerHTML = "";

                        showAlert('บันทึกการแก้ไข', 'success');
                        // showAlert('เกิดข้อผิดพลาด', 'danger');
                        const modal = bootstrap.Modal.getInstance(document.getElementById('task_updatetopicModal'));
                        modal.hide();
                        // ดึง query string จาก URL ปัจจุบัน
                        const urlParams = new URLSearchParams(window.location.search);
                        // ดึงค่า task_id
                        let taskId = urlParams.get("taskID"); // ถ้าไม่มีค่าจะได้ null
                        api_loadTasks(taskId);
                    } else {
                        showAlert('เกิดข้อผิดพลาด: ' + (data.message || 'ไม่ทราบสาเหตุ'), 'danger');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('เกิดข้อผิดพลาดในการเชื่อมต่อ: ' + error.message, 'danger');
                })
                .finally(() => {
                    // Reset button state
                    const saveBtn = document.querySelector('.modal-footer .btn-primary');
                    saveBtn.innerHTML = '<i class="bi bi-check-circle me-1"></i>บันทึก';
                    saveBtn.disabled = false;
                });
        }

        function loadUsersFromAPI() {
            fetch('api/get_users.php', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success && Array.isArray(data.data)) {
                        // Update global users array
                        users.length = 0;
                        showAlert('555', 'warning');
                        console.log(5555);
                        users.push(...data.data);

                        populateUserDropdown();
                    } else {
                        console.error('Invalid API response:', data);
                        showAlert('ไม่สามารถโหลดรายชื่อผู้ใช้ได้', 'warning');
                    }
                })
                .catch(error => {
                    console.error('Error loading users:', error);
                    showAlert('เกิดข้อผิดพลาดในการโหลดรายชื่อผู้ใช้', 'warning');
                });
        }

        // ======================================================================
        // แสดง Alert แบบ Bootstrap (showAlert)
        // คำอธิบาย: สร้าง alert ด้านบนมุมขวา ใช้แสดงข้อความสำคัญที่ต้องให้ผู้ใช้เห็น
        // การใช้งาน: showAlert('ข้อความ', 'success')
        // ======================================================================
        // Utility Functions
        function showAlert(message, type = 'info') {
            // Create alert container if it doesn't exist
            let alertContainer = document.getElementById('alertContainer');
            if (!alertContainer) {
                alertContainer = document.createElement('div');
                alertContainer.id = 'alertContainer';
                alertContainer.className = 'position-fixed top-0 end-0 p-3';
                alertContainer.style.zIndex = '9999';
                document.body.appendChild(alertContainer);
            }

            // Create alert element
            const alertId = 'alert-' + Date.now();
            const alertDiv = document.createElement('div');
            alertDiv.id = alertId;
            alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
            alertDiv.setAttribute('role', 'alert');
            alertDiv.innerHTML = `
                <i class="bi bi-${getAlertIcon(type)} me-2"></i>${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            `;

            alertContainer.appendChild(alertDiv);

            // Auto remove after 5 seconds
            setTimeout(() => {
                const alert = document.getElementById(alertId);
                if (alert) {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }
            }, 5000);
        }

        function getAlertIcon(type) {
            const icons = {
                success: 'check-circle-fill',
                danger: 'exclamation-triangle-fill',
                warning: 'exclamation-triangle-fill',
                info: 'info-circle-fill'
            };
            return icons[type] || 'info-circle-fill';
        }

        // CSS for spinning animation
        const style = document.createElement('style');
        style.textContent = `
            .spin {
                animation: spin 1s linear infinite;
            }
            
            @keyframes spin {
                from { transform: rotate(0deg); }
                to { transform: rotate(360deg); }
            }
            
            #alertContainer {
                max-width: 350px;
            }
            
            #alertContainer .alert {
                margin-bottom: 10px;
                box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
                border: none;
            }
        `;
        document.head.appendChild(style);

        // Load users when page loads (uncomment to use API)
        // document.addEventListener('DOMContentLoaded', function() {
        //     loadUsersFromAPI();
        // });
    </script>
    <script>
        function resetinput_Form() {
            // เลือก form
            const form = document.getElementById('task_updatetopicForm');
            if (!form) {
                console.warn('ไม่พบ form #taskForm');
                return;
            }

            // ล้างค่า input, textarea, select ภายใน form
            form.querySelectorAll('input, textarea, select').forEach(el => {
                switch (el.type) {
                    case 'checkbox':
                    case 'radio':
                        el.checked = false; // ล้าง checkbox / radio
                        break;
                    default:
                        el.value = ''; // ล้าง text, number, textarea, select
                }
            });
        }
    </script>
    <script>
        const starContainer = document.getElementById('update_taskImportance_stars');
        const stars = starContainer.querySelectorAll('.star');
        const hiddenInput = document.getElementById('update_taskImportance');
        const ratingLabel = document.getElementById('updateRatingLabel');

        const ratingLabels = {
            1: 'ไม่เร่งด่วน (1 ดาว)',
            2: 'ค่อนข้างน้อย (2 ดาว)',
            3: 'ระดับปานกลาง (3 ดาว)',
            4: 'ค่อนข้างเร่งด่วน (4 ดาว)',
            5: 'เร่งด่วนมาก! (5 ดาว)'
        };

        // ฟังก์ชันอัพเดทดาว
        function updateStars(value) {
            stars.forEach((star, index) => {
                if (index < value) {
                    star.classList.add('active');
                } else {
                    star.classList.remove('active');
                }
            });

            // อัพเดท label
            ratingLabel.textContent = ratingLabels[value];
            ratingLabel.className = 'rating-label level-' + value;

            // อัพเดท hidden input
            hiddenInput.value = value;
            starContainer.setAttribute('data-value', value);
        }

        // เพิ่ม event listeners สำหรับดาว
        stars.forEach(star => {
            star.addEventListener('click', function() {
                const value = parseInt(this.getAttribute('data-value'));
                updateStars(value);
            });

            // Hover effect
            star.addEventListener('mouseenter', function() {
                const value = parseInt(this.getAttribute('data-value'));
                stars.forEach((s, index) => {
                    s.style.color = ''; // Clear inline style
                    if (index < value) {
                        s.classList.add('hover-active');
                    } else {
                        s.classList.remove('hover-active');
                    }
                });
            });
        });

        // Reset เมื่อ mouse ออกจาก container
        starContainer.addEventListener('mouseleave', function() {
            // Clear hover effect
            stars.forEach(s => {
                s.style.color = '';
                s.classList.remove('hover-active');
            });
        });
    </script>
</body>

</html>