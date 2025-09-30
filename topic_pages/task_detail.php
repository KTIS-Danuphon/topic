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
        .btn-edit-header {
            position: absolute;
            top: 20px;
            right: 20px;
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
                <div id="tasksContainer_real" class="page-header fade-in" hidden>
                    <div class="task-container">
                        <div class="task-card">
                            <!-- Task Header -->
                            <div class="task-header">
                                <h1 class="task-title">พัฒนาระบบจัดการงานใหม่สำหรับบริษัท</h1>
                                <div class="task-meta">
                                    <span class="category-badge">
                                        <i class="bi bi-code-slash me-1"></i>พัฒนาระบบ
                                    </span>
                                    <span class="task-id">
                                        <i class="bi bi-hash me-1"></i>TASK-2025-001
                                    </span>
                                    <span class="created-date">
                                        <i class="bi bi-calendar3 me-1"></i>15 ก.ย. 2567 14:30
                                    </span>
                                    <span class="status-badge ">
                                        <i class="bi bi-clock me-1"></i>รอดำเนินการ
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
                                    <div class="description-box">ต้องการพัฒนาระบบจัดการงานใหม่ที่มีฟีเจอร์ครบครัน สามารถ mention ผู้ใช้ได้โปรดให้
                                        <span class="mention-highlight">@[สมชาย จันทร์เพ็ญ]</span> ดูแลส่วน Backend และ <span class="mention-highlight">@[สุดา ใจดี]</span> ดูแลส่วน Frontend

                                        ความต้องการหลัก:
                                        • ระบบ Authentication และ Authorization
                                        • ระบบจัดการงานและโปรเจค
                                        • ระบบแจ้งเตือน Real-time
                                        • ระบบรายงานและสถิติ
                                        • API สำหรับ Mobile App

                                        กำหนดส่ง: ภายใน 3 เดือน
                                        งบประมาณ: 500,000 บาท

                                        หมายเหตุ: โปรดประสานงานกับ
                                        <span class="mention-highlight">@[วิชัย สมบูรณ์]</span> เรื่องการออกแบบ Database
                                    </div>
                                </div>

                                <!-- Users Section -->
                                <div class="section">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3 class="section-title">
                                                <i class="bi bi-at text-warning"></i>ผู้สร้างรายการ
                                            </h3>
                                            <div class="user-badges">
                                                <div class="user-badge mentioned">
                                                    <i class="bi bi-person-fill-check"></i>สมชาย จันทร์เพ็ญ
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <h3 class="section-title">
                                                <i class="bi bi-people text-info"></i>ผู้เกี่ยวข้อง
                                            </h3>
                                            <div class="user-badges">
                                                <div class="user-badge">
                                                    <i class="bi bi-person-circle"></i>นิรันดร์ วงศ์ดี
                                                </div>
                                                <div class="user-badge">
                                                    <i class="bi bi-person-circle"></i>อรทัย บุญมี
                                                </div>
                                                <div class="user-badge">
                                                    <i class="bi bi-person-circle"></i>ธนา กิจดี
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Files Section -->
                                <div class="section">
                                    <h3 class="section-title">
                                        <i class="bi bi-paperclip text-success"></i>ไฟล์แนบ (5 ไฟล์)
                                    </h3>
                                    <div class="files-grid">
                                        <div class="file-card">
                                            <div class="file-icon document">
                                                <i class="bi bi-file-word"></i>
                                            </div>
                                            <div class="file-info">
                                                <div class="file-name">ความต้องการระบบ.docx</div>
                                                <!-- <div class="file-meta">
                                                    <span>2.4 MB</span>
                                                    <span>Word Document</span>
                                                </div> -->
                                            </div>
                                        </div>

                                        <div class="file-card">
                                            <div class="file-icon pdf">
                                                <i class="bi bi-file-pdf"></i>
                                            </div>
                                            <div class="file-info">
                                                <div class="file-name">แผนผังฐานข้อมูล.pdf</div>
                                                <!-- <div class="file-meta">
                                                    <span>1.8 MB</span>
                                                    <span>PDF Document</span>
                                                </div> -->
                                            </div>
                                        </div>

                                        <div class="file-card">
                                            <div class="file-icon image">
                                                <i class="bi bi-file-image"></i>
                                            </div>
                                            <div class="file-info">
                                                <div class="file-name">mockup-homepage.png</div>
                                                <!-- <div class="file-meta">
                                                    <span>856 KB</span>
                                                    <span>PNG Image</span>
                                                </div> -->
                                            </div>
                                        </div>

                                        <div class="file-card">
                                            <div class="file-icon archive">
                                                <i class="bi bi-file-zip"></i>
                                            </div>
                                            <div class="file-info">
                                                <div class="file-name">wireframes-complete.zip</div>
                                                <!-- <div class="file-meta">
                                                    <span>12.3 MB</span>
                                                    <span>ZIP Archive</span>
                                                </div> -->
                                            </div>
                                        </div>

                                        <div class="file-card">
                                            <div class="file-icon document">
                                                <i class="bi bi-file-excel"></i>
                                            </div>
                                            <div class="file-info">
                                                <div class="file-name">งบประมาณโครงการ.xlsx</div>
                                                <!-- <div class="file-meta">
                                                    <span>445 KB</span>
                                                    <span>Excel Spreadsheet</span>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Statistics -->
                                <div class="section">
                                    <h3 class="section-title">
                                        <i class="bi bi-bar-chart text-primary"></i>สถิติงาน
                                    </h3>
                                    <div class="stats-grid">
                                        <div class="stat-card">
                                            <div class="stat-number">6</div>
                                            <div class="stat-label">ผู้ร่วมงานทั้งหมด</div>
                                        </div>
                                        <div class="stat-card">
                                            <div class="stat-number">5</div>
                                            <div class="stat-label">ไฟล์แนบ</div>
                                        </div>
                                        <div class="stat-card">
                                            <div class="stat-number">17.8 MB</div>
                                            <div class="stat-label">ขนาดไฟล์รวม</div>
                                        </div>
                                        <div class="stat-card">
                                            <div class="stat-number">3</div>
                                            <div class="stat-label">ผู้ถูก Mention</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                        <input type="text" id="update_task_id">
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
                        <div class="mb-3">
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
                        </div>

                        <!-- สถานะ -->
                        <div class="mb-3">
                            <label for="taskStatus" class="form-label">
                                <i class="bi bi-bookmark-star me-1"></i>สถานะการทำงาน
                            </label>
                            <select class="form-select" id="taskStatus" required>
                                <option value="" selected disabled>เลือกสถานะการทำงาน</option>
                                <option value="pending">รอดำเนินการ</option>
                                <option value="in-progress">กำลังดำเนินการ</option>
                                <option value="completed">เสร็จสิ้น</option>
                            </select>
                        </div>

                        <!-- ไฟล์แนบ -->
                        <div class="mb-3">
                            <label class="form-label">
                                <i class="bi bi-paperclip me-1"></i>ไฟล์แนบ
                            </label>
                            <div class="file-attachments" id="fileAttachments">
                                <div class="file-input-container" data-file-index="1">
                                    <input type="file" class="file-input-hidden" id="fileInput1" accept="*/*">
                                    <div class="btn-add-file" onclick="triggerFileInput('fileInput1')">
                                        <i class="bi bi-cloud-upload me-2"></i>เลือกไฟล์
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-outline-secondary btn-sm mt-2" onclick="addFileInput()">
                                <i class="bi bi-plus me-1"></i>เพิ่มไฟล์แนบ
                            </button>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i>ยกเลิก
                    </button>
                    <button id="saveBtn" type="button" class="btn btn-primary" onclick="saveTask()">
                        <i class="bi bi-check-circle me-1"></i>บันทึก
                    </button>
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

        // ความสำคัญ
        function importance_score(importance) {
            const importances = {
                '1': 'ต่ำ',
                '2': 'ปานกลาง',
                '3': 'สูง',
                '4': 'สำคัญมาก',
                '5': 'อื่นๆ'
            };
            return importances[importance] || 'อื่นๆ';
        }

        // Global variables
        // let currentPage = 1;
        // let itemsPerPage = 10;
        // let totalItems = 0;
        // let totalPages = 0;
        // let currentFilter = 'all';
        // let currentSort = 'date_desc';
        // let currentSearch = '';
        // let isLoading = false;
        // let allTasks = [];
        // let filteredTasks = [];
        // let viewMode = 'grid';
        let users_list = []; //เก็บ id user ไว้โชว์ให้เลือก ผู้ใช้ ที่เกี่ยวข้อง
        let mockTasks = [];
    </script>

    <script>
        // โชว์แจ้งเตือน มุมขวาบน 
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

        // ปุ่มแก้ไข 
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
                const tasks = data.tasks[0];
                const tasks_file = data.tasks_file;
                const task_participant = data.task_participant;
                console.log('data535:', tasks);
                updateModalBody.hidden = false;
                updateModalBody_load.hidden = true;


                document.getElementById('update_task_id').value = tasks.id; //id งาน
                document.getElementById('update_taskTitle').value = tasks.title; // หัวข้อ
                const select = document.getElementById("update_taskCategory"); //หมวดหมู่
                if (select) {
                    select.value = tasks.category; // ตั้งค่าตรงๆ
                }
                document.getElementById('update_taskDescription').value = tasks.task_detail; // รายละเอียด
                mentionUsers = JSON.parse(tasks.task_mentioned);

                //ผู้ที่เกี่ยวข้อง
                selectedUsers = JSON.parse(tasks.task_participant);
                updateUserTagsDisplay();
                populateUserDropdown();
                // const userSelect = document.getElementById('userSelect');
                // userSelect.classList.remove('d-none');
                // userSelect.focus();

                // Add change event listener
                userSelect.onchange = function() {
                    if (this.value) {
                        addUser(parseInt(this.value));
                        this.value = '';
                        hideUserDropdown();
                    }
                };
                // แสดงผลข้อมูลที่ได้แทนข้อความโหลด

            } catch (err) {
                console.error("โหลดข้อมูลผิดพลาด:", err);
                document.getElementById("updateModalBody").innerHTML = `
                <div class="text-danger">โหลดข้อมูลไม่สำเร็จ</div>
            `;
            }

            // showToast('เปิดหน้าแก้ไขงาน...', 'info');
            // console.log('Edit task');
        }
    </script>

    <!-- สคริปฟิลเตอร์ -->
    <script>
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
                const container_real = document.getElementById('tasksContainer_real');
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
                    container_real.hidden = true;
                    return;
                } else {
                    container_real.hidden = true;

                    // container.hidden = true;
                    // container_real.hidden = false;
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
                                <button class="btn-edit-header" onclick="handleEdit('${taskId}')">
                                    <i class="bi bi-pencil-square"></i>
                                    <span>แก้ไข</span>
                                </button>
                                <h1 class="task-title">${task.title}</h1>
                                <div class="task-meta">
                                    <span class="category-badge">
                                        <i class="bi bi-code-slash me-1"></i>${task.category}
                                    </span>
                                    <span class="task-id">
                                        <i class="bi bi-hash me-1"></i>TASK-2025-001
                                    </span>
                                    <span class="created-date">
                                        <i class="bi bi-calendar3 me-1"></i>${formatDate(task.created_at)}
                                    </span>
                                    <span class="priority-badge">
                                        <i class="bi bi-card-list me-1"></i>ความสำคัญ ${importance_score(task.importance)}
                                    </span>
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

        //  <div class="section">
        //                             <h3 class="section-title">
        //                                 <i class="bi bi-paperclip text-success"></i>ไฟล์แนบ (5 ไฟล์)
        //                             </h3>
        //                             <div class="files-grid">
        //                                 <div class="file-card">
        //                                     <div class="file-icon document">
        //                                         <i class="bi bi-file-word"></i>
        //                                     </div>
        //                                     <div class="file-info">
        //                                         <div class="file-name">ความต้องการระบบ.docx</div>
        //                                         <!-- <div class="file-meta">
        //                                             <span>2.4 MB</span>
        //                                             <span>Word Document</span>
        //                                         </div> -->
        //                                     </div>
        //                                 </div>

        //                                 <div class="file-card">
        //                                     <div class="file-icon pdf">
        //                                         <i class="bi bi-file-pdf"></i>
        //                                     </div>
        //                                     <div class="file-info">
        //                                         <div class="file-name">แผนผังฐานข้อมูล.pdf</div>
        //                                         <!-- <div class="file-meta">
        //                                             <span>1.8 MB</span>
        //                                             <span>PDF Document</span>
        //                                         </div> -->
        //                                     </div>
        //                                 </div>

        //                                 <div class="file-card">
        //                                     <div class="file-icon image">
        //                                         <i class="bi bi-file-image"></i>
        //                                     </div>
        //                                     <div class="file-info">
        //                                         <div class="file-name">mockup-homepage.png</div>
        //                                         <!-- <div class="file-meta">
        //                                             <span>856 KB</span>
        //                                             <span>PNG Image</span>
        //                                         </div> -->
        //                                     </div>
        //                                 </div>

        //                                 <div class="file-card">
        //                                     <div class="file-icon archive">
        //                                         <i class="bi bi-file-zip"></i>
        //                                     </div>
        //                                     <div class="file-info">
        //                                         <div class="file-name">wireframes-complete.zip</div>
        //                                         <!-- <div class="file-meta">
        //                                             <span>12.3 MB</span>
        //                                             <span>ZIP Archive</span>
        //                                         </div> -->
        //                                     </div>
        //                                 </div>

        //                                 <div class="file-card">
        //                                     <div class="file-icon document">
        //                                         <i class="bi bi-file-excel"></i>
        //                                     </div>
        //                                     <div class="file-info">
        //                                         <div class="file-name">งบประมาณโครงการ.xlsx</div>
        //                                         <!-- <div class="file-meta">
        //                                             <span>445 KB</span>
        //                                             <span>Excel Spreadsheet</span>
        //                                         </div> -->
        //                                     </div>
        //                                 </div>
        //                             </div>
        //                         </div>

        //                         <!-- Statistics -->
        //                         <div class="section">
        //                             <h3 class="section-title">
        //                                 <i class="bi bi-bar-chart text-primary"></i>สถิติงาน
        //                             </h3>
        //                             <div class="stats-grid">
        //                                 <div class="stat-card">
        //                                     <div class="stat-number">6</div>
        //                                     <div class="stat-label">ผู้ร่วมงานทั้งหมด</div>
        //                                 </div>
        //                                 <div class="stat-card">
        //                                     <div class="stat-number">5</div>
        //                                     <div class="stat-label">ไฟล์แนบ</div>
        //                                 </div>
        //                                 <div class="stat-card">
        //                                     <div class="stat-number">17.8 MB</div>
        //                                     <div class="stat-label">ขนาดไฟล์รวม</div>
        //                                 </div>
        //                                 <div class="stat-card">
        //                                     <div class="stat-number">3</div>
        //                                     <div class="stat-label">ผู้ถูก Mention</div>
        //                                 </div>
        //                             </div>
        //                         </div>

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
            // updateSidebarCounts();
        });

        // Toggle sidebar for mobile
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');

            sidebar.classList.toggle('show');
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('sidebar-collapsed');
        }

        // Load tasks by status
        function loadTasks(status) {
            currentFilter = status;
            currentPage = 1;

            // Update active nav link
            document.querySelectorAll('.nav-link-custom').forEach(link => {
                link.classList.remove('active');
            });

            // Update page title
            const titles = {
                'all': 'งานทั้งหมด',
                'pending': 'งานรอดำเนินการ',
                'in-progress': 'งานกำลังดำเนินการ',
                'completed': 'งานเสร็จสิ้น'
            };

            document.getElementById('pageTitle').textContent = titles[status] || 'งานทั้งหมด';

            applyFiltersAndSort();
        }

        // Filter tasks by date range
        function filterTasks(dateFilter) {
            console.log(dateFilter);

            const now = new Date();
            const today = new Date(now.getFullYear(), now.getMonth(), now.getDate());

            let filteredByDate = allTasks;

            if (dateFilter === 'today') {
                filteredByDate = allTasks.filter(task => {
                    const taskDate = new Date(task.created_at);
                    const taskDay = new Date(taskDate.getFullYear(), taskDate.getMonth(), taskDate.getDate());
                    console.log(taskDay);
                    return taskDay.getTime() === today.getTime();
                });
            } else if (dateFilter === 'week') {
                const weekAgo = new Date(today.getTime() - (7 * 24 * 60 * 60 * 1000));
                filteredByDate = allTasks.filter(task => {
                    const taskDate = new Date(task.created_at);
                    console.log(taskDate + '>=' + weekAgo);

                    return taskDate >= weekAgo;
                });
            } else if (dateFilter === 'month') {
                const monthAgo = new Date(today.getTime() - (30 * 24 * 60 * 60 * 1000));
                filteredByDate = allTasks.filter(task => {
                    const taskDate = new Date(task.created_at);
                    console.log(taskDate + '>=' + monthAgo);

                    return taskDate >= monthAgo;
                });
            }

            allTasks = filteredByDate;
            currentPage = 1;
            applyFiltersAndSort();
        }

        // Sort tasks
        function sortTasks(sortType) {
            currentSort = sortType;
            applyFiltersAndSort();
        }

        // Search tasks
        function searchTasks(query) {
            console.log(query);
            currentSearch = query.toLowerCase();
            console.log('currentSearch', currentSearch);
            currentPage = 1;
            applyFiltersAndSort();
        }

        // Apply all filters and sorting
        function applyFiltersAndSort() {
            showLoading();

            setTimeout(() => {
                // Start with all tasks
                let tasks = [...allTasks];

                // Apply status filter
                if (currentFilter !== 'all') {
                    tasks = tasks.filter(task => task.status === currentFilter);
                }

                // Apply search filter
                // if (currentSearch) {
                //     tasks = tasks.filter(task =>
                //         task.title.toLowerCase().includes(currentSearch)
                //     );
                // }
                if (currentSearch) {
                    const searchLower = currentSearch.toLowerCase();

                    tasks = tasks.filter(task => {
                        const title = task.title.toLowerCase();

                        // ปีจาก created_at
                        const year = new Date(task.created_at).getFullYear().toString();

                        // task code
                        const taskCode = '1TASK-' + year + '-' + task.id.toString().padStart(4, '0');

                        const status = getStatusName(task.status.toLowerCase());

                        return (
                            title.includes(searchLower) ||
                            year.includes(searchLower) ||
                            taskCode.toLowerCase().includes(searchLower) ||
                            status.includes(searchLower)
                        );
                    });
                }


                // Apply sorting
                tasks.sort((a, b) => {
                    switch (currentSort) {
                        case 'date_desc':
                            console.log('date_desc');
                            return new Date(b.created_at) - new Date(a.created_at);
                        case 'date_asc':
                            console.log('date_asc');
                            return new Date(a.created_at) - new Date(b.created_at);
                        case 'title':
                            console.log('title');
                            return a.title.localeCompare(b.title, 'th');
                        case 'priority':
                            console.log('priority');
                            return b.priority - a.priority;
                        default:
                            console.log('00');
                            return 0;
                    }
                });

                filteredTasks = tasks;
                totalItems = filteredTasks.length;
                totalPages = Math.ceil(totalItems / itemsPerPage);

                renderTasks();
                renderPagination();
                updateCounts();
                hideLoading();
            }, 300);
        }

        // Render tasks
        function renderTasks() {
            const container = document.getElementById('tasksContainer');
            const startIndex = (currentPage - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            const tasksToShow = filteredTasks.slice(startIndex, endIndex);

            if (tasksToShow.length === 0) {
                container.innerHTML = `
                    <div class="text-center py-5">
                        <i class="bi bi-inbox display-1 text-muted"></i>
                        <h4 class="mt-3 text-muted">ไม่พบงานที่ค้นหา</h4>
                        <p class="text-muted">ลองเปลี่ยนคำค้นหาหรือกรองข้อมูลใหม่</p>
                    </div>
                `;
                return;
            }

            const tasksHtml = tasksToShow.map(task => `
                <div class="col-12 col-lg-12 col-xl-12 task-container">
                    <div class="task-card">
                        <div class="task-header ${task.category}">
                            <h3 class="task-title">${task.title}</h3>
                            <div class="task-meta">
                                <span class="task-id"><i class="bi bi-hash me-1"></i>TASK-${new Date(task.created_at).getFullYear()}-${(task.id).toString().padStart(4, '0')}</span>
                                <span class="category-badge"><i class="bi bi-code-slash me-1"></i>${getCategoryName(task.category)}</span>
                                <span class="created-date"><i class="bi bi-calendar3 me-1"></i>${formatDate(task.created_at)}</span>
                                <!-- <span class="priority-badge"><i class="bi bi-card-list me-1"></i>ความสำคัญ ${task.priority}</span> -->
                            </div>
                        </div>
                        <div class="card-body p-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="status-badge ${task.status}">${getStatusName(task.status)}</span>
                                <div class="dropdown">
                                <a class="dropdown-item" href="task_detail.php?taskID=${task.encrypt_id}"><i class="bi bi-eye me-2"></i>ดูรายละเอียด</a>

                                  <!--   <button class="btn btn-link text-muted" type="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#"><i class="bi bi-eye me-2"></i>ดูรายละเอียด</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="bi bi-pencil me-2"></i>แก้ไข</a></li>
                                        <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-trash me-2"></i>ลบ</a></li>
                                    </ul> -->
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            `).join('');

            container.innerHTML = `<div class="row g-3">${tasksHtml}</div>`;
        }

        // Render pagination
        function renderPagination() {
            const container = document.getElementById('pageNumbers');
            const prevBtn = document.getElementById('prevPage');
            const nextBtn = document.getElementById('nextPage');

            // Update prev/next buttons
            prevBtn.disabled = currentPage === 1;
            nextBtn.disabled = currentPage === totalPages || totalPages === 0;

            // Generate page numbers
            let pagesHtml = '';
            const maxVisiblePages = 5;
            let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
            let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

            if (endPage - startPage + 1 < maxVisiblePages) {
                startPage = Math.max(1, endPage - maxVisiblePages + 1);
            }

            for (let i = startPage; i <= endPage; i++) {
                pagesHtml += `
                    <button class="page-btn ${i === currentPage ? 'active' : ''}" onclick="goToPage(${i})">
                        ${i}
                    </button>
                `;
            }

            container.innerHTML = pagesHtml;
        }

        // Go to specific page
        function goToPage(page) {
            if (page < 1 || page > totalPages) return;
            currentPage = page;
            renderTasks();
            renderPagination();
            updateCounts();
        }

        // Change items per page
        function changeItemsPerPage(newValue) {
            itemsPerPage = parseInt(newValue);
            currentPage = 1;
            totalPages = Math.ceil(totalItems / itemsPerPage);
            renderTasks();
            renderPagination();
            updateCounts();
        }

        // Set view mode
        function setViewMode(mode) {
            viewMode = mode;
            // Could implement different view modes here
            renderTasks();
        }

        // Update counts display
        function updateCounts() {
            const startIndex = (currentPage - 1) * itemsPerPage;
            const endIndex = Math.min(startIndex + itemsPerPage, totalItems);
            const currentCount = totalItems === 0 ? 0 : endIndex;

            document.getElementById('currentCount').textContent = currentCount;
            document.getElementById('totalCount').textContent = totalItems;
        }

        // Update sidebar counts
        function updateSidebarCounts() {
            const total = allTasks.length;
            const pending = allTasks.filter(t => t.status === 'pending').length;
            const inProgress = allTasks.filter(t => t.status === 'in-progress').length;
            const completed = allTasks.filter(t => t.status === 'completed').length;

            document.getElementById('totalTaskCount').textContent = total;
            document.getElementById('pendingTaskCount').textContent = pending;
            document.getElementById('progressTaskCount').textContent = inProgress;
            document.getElementById('completedTaskCount').textContent = completed;
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
        // [{
        //         id: 1,
        //         name: 'สมชาย จันทร์เพ็ญ',
        //         username: 'somchai'
        //     },
        //     {
        //         id: 2,
        //         name: 'สุดา ใจดี',
        //         username: 'suda'
        //     },
        //     {
        //         id: 3,
        //         name: 'วิชัย สมบูรณ์',
        //         username: 'wichai'
        //     },
        //     {
        //         id: 4,
        //         name: 'นิรันดร์ วงศ์ดี',
        //         username: 'niran'
        //     },
        //     {
        //         id: 5,
        //         name: 'อรทัย บุญมี',
        //         username: 'orathai'
        //     },
        //     {
        //         id: 6,
        //         name: 'ธนา กิจดี',
        //         username: 'thana'
        //     },
        //     {
        //         id: 7,
        //         name: 'รัชนี สุขใส',
        //         username: 'rachani'
        //     },
        //     {
        //         id: 8,
        //         name: 'ประวิทย์ เก่งกาจ',
        //         username: 'prawit'
        //     }
        // ];

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
        function resetForm() {
            document.getElementById('task_updatetopicForm').reset();
            document.getElementById('task_updatetopicForm').classList.remove('was-validated');
            selectedUsers = [];
            mentionUsers = [];
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
            const user = users.find(u => u.id === userId);
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
        function setupMentionSystem() {
            const textarea = document.getElementById('update_taskDescription');
            const dropdown = document.getElementById('mentionDropdown');

            textarea.addEventListener('input', function(e) {
                handleMentionInput(e);
            });

            textarea.addEventListener('keydown', function(e) {
                handleMentionKeydown(e);
            });
        }

        function handleMentionInput(e) {
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

        function handleMentionKeydown(e) {
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

        function showMentionDropdown(query, textarea) {
            const dropdown = document.getElementById('mentionDropdown');

            // Filter users based on query
            const filteredUsers = users_list.filter(user =>
                user.name.toLowerCase().includes(query.toLowerCase()) ||
                user.username.toLowerCase().includes(query.toLowerCase())
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

        function updateMentionSelection(items) {
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

        function updateMentionUsers() {
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

            console.log("mentionUsers:", mentionUsers);
        }

        document.getElementById('update_taskDescription').addEventListener("input", updateMentionUsers);

        function hideMentionDropdown() {
            document.getElementById('mentionDropdown').style.display = 'none';
            selectedMentionIndex = -1;
        }

        // File Management
        function setupFileInput(inputId) {
            const input = document.getElementById(inputId);
            if (!input) return;

            input.addEventListener('change', function() {
                if (this.files.length > 0) {
                    displaySelectedFile(this);
                }
            });
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

        // Enhanced file input validation
        function displaySelectedFile(input) {
            if (!input.files || input.files.length === 0) {
                console.warn('No file selected for input:', input.id);
                return;
            }

            const file = input.files[0];
            const container = input.parentElement;

            // Validate file
            if (file.size > 4 * 1024 * 1024) {
                showAlert(`ไฟล์ "${file.name}" มีขนาดใหญ่เกินไป (สูงสุด 4MB)`, 'danger');
                input.value = ''; // Clear the input
                return;
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

        // Form Validation & Save
        function validateForm() {
            const form = document.getElementById('task_updatetopicForm');
            const title = document.getElementById('taskTitle');

            let isValid = true;

            // Reset validation
            form.classList.remove('was-validated');

            // Check title
            if (!title.value.trim()) {
                title.classList.add('is-invalid');
                isValid = false;
            } else {
                title.classList.remove('is-invalid');
            }

            form.classList.add('was-validated');
            return isValid;
        }

        function saveTask() {
            if (!validateForm()) {
                console.log('!validateForm');
                return;
            }
            // const btn = document.getElementById("saveBtn");
            // // ปิดการกดซ้ำ
            // btn.disabled = true;
            // // เปลี่ยนข้อความ
            // btn.innerHTML = `<span class="spinner-border spinner-border-sm me-1"></span> กำลังบันทึก...`;
            // // จำลองการบันทึก (เช่น เรียก API)
            // setTimeout(() => {
            //     // ตัวอย่าง: บันทึกเสร็จแล้ว
            //     btn.innerHTML = `<i class="bi bi-check-circle me-1"></i>บันทึก`;
            //     // ถ้าต้องการกดใหม่ภายหลัง ให้เปิดใช้งานอีกครั้ง:
            //     // btn.disabled = false;
            // }, 3000);

            const formData = {
                title: document.getElementById('taskTitle').value.trim(),
                category: document.getElementById('taskCategory').value,
                description: document.getElementById('update_taskDescription').value.trim(),
                staus: document.getElementById('taskStatus').value,
                relatedUsers: selectedUsers.map(user => user.id),
                mentionedUsers: mentionUsers.map(user => user.id),
                files: []
            };

            // Collect files
            const fileInputs = document.querySelectorAll('.file-input-send');
            // const fileInputs = document.querySelectorAll('.file-input-hidden');
            fileInputs.forEach(input => {
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

            // Show loading state
            const saveBtn = document.querySelector('.modal-footer .btn-primary');
            const originalHtml = saveBtn.innerHTML;
            saveBtn.innerHTML = '<i class="bi bi-arrow-repeat spin me-1"></i>กำลังบันทึก...';
            saveBtn.disabled = true;

            // Simulate API call
            setTimeout(() => {
                // Reset button
                // saveBtn.innerHTML = originalHtml;
                // saveBtn.disabled = false;

                // Show success message
                // showAlert('บันทึกงานสำเร็จ!', 'success');

                // Close modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('task_updatetopicModal'));
                modal.hide();

                // In real implementation, call API here:
                saveTaskToAPI(formData);
            }, 1500);
        }

        // API Integration Functions
        function saveTaskToAPI(formData) {
            const apiFormData = new FormData();

            // Basic form data
            apiFormData.append('title', formData.title);
            apiFormData.append('category', formData.category);
            apiFormData.append('description', formData.description);
            apiFormData.append('taskStatus', formData.staus);
            apiFormData.append('related_users', JSON.stringify(formData.relatedUsers));
            apiFormData.append('mentioned_users', JSON.stringify(formData.mentionedUsers));

            // Files
            formData.files.forEach((fileData, index) => {
                apiFormData.append(`files[${index}]`, fileData.file);
            });
            fetch('../topic_api/save_task.php', {
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
                        showAlert('บันทึกงานสำเร็จ!', 'success');
                        // const modal = bootstrap.Modal.getInstance(document.getElementById('task_updatetopicModal'));
                        // modal.hide();
                        // Optionally reload page or update UI
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
</body>

</html>