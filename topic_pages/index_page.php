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
                <div class="page-header fade-in">
                    <div class="row g-2 align-items-center">
                        <div class="col-12 col-lg-6">
                            <h1 class="page-title">งานทั้งหมด</h1>
                            <p class="page-subtitle">จัดการและติดตามงานของคุณ</p>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="d-flex flex-wrap justify-content-lg-end gap-2">

                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary dropdown-toggle w-100 w-sm-auto" type="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-funnel me-1"></i> กรองข้อมูล
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a id="filter_all" class="dropdown-item" href="#" onclick="onFilterClick('all')">ทั้งหมด</a></li>
                                        <li><a id="filter_today" class="dropdown-item" href="#" onclick="onFilterClick('today')">วันนี้</a></li>
                                        <li><a id="filter_week" class="dropdown-item" href="#" onclick="onFilterClick('week')">สัปดาห์นี้</a></li>
                                        <li><a id="filter_month" class="dropdown-item" href="#" onclick="onFilterClick('month')">เดือนนี้</a></li>
                                    </ul>
                                </div>
                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary dropdown-toggle w-100 w-sm-auto" type="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-sort-down me-1"></i> เรียงตาม
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#" onclick="sortTasks('date_desc')">วันที่สร้าง (ใหม่-เก่า)</a></li>
                                        <li><a class="dropdown-item" href="#" onclick="sortTasks('date_asc')">วันที่สร้าง (เก่า-ใหม่)</a></li>
                                        <li><a class="dropdown-item" href="#" onclick="sortTasks('title')">ชื่องาน (A-Z)</a></li>
                                        <!-- <li><a class="dropdown-item" href="#" onclick="sortTasks('priority')">ความสำคัญ</a></li> -->
                                    </ul>
                                </div>
                                <button class="btn btn-primary w-sm-auto" data-bs-toggle="modal" data-bs-target="#task_newtopicModal">
                                    <i class="bi bi-plus-lg me-1"></i> สร้างงานใหม่
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Search and Stats -->
                    <div class="row mt-4 g-3">
                        <div class="col-12 col-md-6">
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-search"></i></span>
                                <input type="text" class="form-control" placeholder="ค้นหางาน..." id="searchInput" onkeyup="searchTasks(this.value)">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="d-flex flex-wrap justify-content-md-end align-items-center gap-3">
                                <span class="text-muted small">
                                    แสดง <span id="currentCount">0</span> จาก <span id="totalCount">0</span> งาน
                                </span>
                                <div class="btn-group btn-group-sm" role="group">
                                    <input type="radio" class="btn-check" name="viewMode" id="gridView" checked onchange="setViewMode('grid')">
                                    <label class="btn btn-outline-secondary" for="gridView"><i class="bi bi-grid-3x3-gap"></i></label>

                                    <input type="radio" class="btn-check" name="viewMode" id="listView" onchange="setViewMode('list')">
                                    <label class="btn btn-outline-secondary" for="listView"><i class="bi bi-list"></i></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Loading Indicator -->
                <div id="loadingIndicator" class="text-center py-4 d-none">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">กำลังโหลด...</span>
                    </div>
                    <div class="mt-2">กำลังโหลดข้อมูล...</div>
                </div>

                <!-- Tasks Container -->
                <div id="tasksContainer" class="fade-in">
                    <!-- Tasks will be loaded here -->
                </div>

                <!-- Pagination Controls -->
                <div id="paginationControls" class="d-flex flex-wrap justify-content-center align-items-center mt-4 gap-3">
                    <button class="btn btn-outline-primary" id="prevPage" onclick="goToPage(currentPage - 1)" disabled>
                        <i class="bi bi-chevron-left me-1"></i> ก่อนหน้า
                    </button>

                    <div id="pageNumbers" class="d-flex gap-1"></div>

                    <button class="btn btn-outline-primary" id="nextPage" onclick="goToPage(currentPage + 1)">
                        ถัดไป <i class="bi bi-chevron-right ms-1"></i>
                    </button>

                    <div class="ms-0 ms-md-3">
                        <select class="form-select form-select-sm" id="itemsPerPage" onchange="changeItemsPerPage(this.value)">
                            <option value="5">5 รายการต่อหน้า</option>
                            <option value="10" selected>10 รายการต่อหน้า</option>
                            <option value="20">20 รายการต่อหน้า</option>
                            <option value="50">50 รายการต่อหน้า</option>
                        </select>
                    </div>
                </div>

                <p></p>

                <!-- Infinite Scroll Trigger -->
                <div id="infiniteScrollTrigger" style="height: 1px;"></div>
            </div>
        </div>
    </div>

    <!-- Task Modal -->
    <div class="modal fade" id="task_newtopicModal" tabindex="-1" aria-labelledby="taskModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="taskModalLabel">
                        <i class="bi bi-clipboard-plus me-2"></i>สร้างงานใหม่
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form id="task_newtopicForm">
                        <!-- หัวข้อ -->
                        <div class="mb-3">
                            <label for="taskTitle" class="form-label">
                                <i class="bi bi-card-text me-1"></i>หัวข้อ <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="taskTitle" placeholder="กรุณาใส่หัวข้องาน" required>
                            <div class="invalid-feedback">
                                กรุณาใส่หัวข้องาน
                            </div>
                        </div>

                        <!-- หมวดหมู่ -->
                        <div class="mb-3">
                            <label for="taskCategory" class="form-label">
                                <i class="bi bi-tags me-1"></i>หมวดหมู่
                            </label>
                            <select class="form-select" id="taskCategory" required>
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
                            <label for="taskDescription" class="form-label">
                                <i class="bi bi-file-text me-1"></i>รายละเอียด
                            </label>
                            <div class="position-relative">
                                <textarea class="form-control" id="taskDescription" rows="4"
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

                        <!-- ความสำคัญ -->
                        <div class="mb-3">
                            <label for="taskImportance" class="form-label">
                                <i class="bi bi-stars me-1"></i>ความสำคัญของงาน
                            </label>
                            <select class="form-select" id="taskImportance" required>
                                <option value="" selected disabled>เลือกความสำคัญ</option>
                                <option value="1">ต่ำ</option>
                                <option value="2">ปานกลาง</option>
                                <option value="3">สูง</option>
                                <option value="4">สำคัญมาก</option>
                            </select>
                        </div>

                        <!-- ไฟล์แนบ -->
                        <div class="mb-3">
                            <label class="form-label">
                                <i class="bi bi-paperclip me-1"></i>ไฟล์แนบ <code>*แต่ละไฟล์ต้องมีขนาดไม่เกิน 2MB และขนาดไฟล์แนบทั้งหมดรวมกันต้องไม่เกิน 7MB</code>
                            </label>
                            <div class="file-attachments" id="fileAttachments">
                                <div class="file-input-container" data-file-index="1">
                                    <input type="file" class="file-input-hidden" id="fileInput1" accept="*/*">
                                    <div class="btn-add-file" onclick="triggerFileInput('fileInput1')">
                                        <i class="bi bi-cloud-upload me-2"></i>เลือกไฟล์
                                    </div>
                                </div>
                            </div>
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
                    <button id="saveBtn" type="button" class="btn btn-primary" onclick="saveTask()">
                        <i class="bi bi-check-circle me-1"></i>บันทึก
                    </button>
                </div>
            </div>
        </div>
    </div>

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
    </script>

    <!-- สคริปฟิลเตอร์ -->
    <script>
        // =============================
        // ตัวแปรหลักสำหรับการจัดการงาน
        // =============================
        let currentPage = 1; // หน้าปัจจุบัน
        let itemsPerPage = 10; // จำนวนงานต่อหน้า
        let totalItems = 0; // งานทั้งหมด
        let totalPages = 0; // จำนวนหน้าทั้งหมด
        let currentFilter = 'all'; // ฟิลเตอร์สถานะ
        let currentSort = 'date_desc'; // การเรียงลำดับ
        let currentSearch = '';
        let isLoading = false;
        let allTasks = []; // งานทั้งหมด (จาก API)
        let filteredTasks = []; // งานที่ผ่านการฟิลเตอร์
        let viewMode = 'grid'; // โหมดแสดงผล
        let users_list = []; // รายชื่อผู้ใช้
        let file_count_size = []; // ขนาดไฟล์แนบ
        let allTasksBackup = null; // สำรองข้อมูลงานก่อนใช้ฟิลเตอร์ (เพื่อให้สามารถคืนค่าได้)

        // =============================
        // โหลดรายชื่อผู้ใช้จาก API
        // =============================
        async function api_loadUsers() {
            try {
                const response = await fetch(`../topic_api/get_user.php`);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                const data = await response.json();
                if (Array.isArray(data.users)) {
                    users_list = [...data.users]; // กำหนด users_list ใหม่
                } else {
                    console.warn("API response ไม่มี users array", data);
                }
            } catch (error) {
                console.error('เกิดข้อผิดพลาดในการโหลดผู้ใช้:', error);
            }
        }
        // =============================
        // โหลดข้อมูลงานจาก API
        // =============================
        let mockTasks = [];
        async function api_loadTasks() {
            try {
                const response = await fetch('../topic_api/get_task.php');
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                const data = await response.json();
                // mockTasks จะเก็บข้อมูลงานทั้งหมด
                mockTasks = [...data.tasks];
                allTasks = [...mockTasks];
                applyFiltersAndSort(); // ฟิลเตอร์และเรียงลำดับทันทีหลังโหลด
                updateSidebarCounts();
                return data;
            } catch (error) {
                console.error('เกิดข้อผิดพลาดในการโหลดงาน:', error);
            }
        }
        // =============================
        // โหลดข้อมูลเมื่อหน้าเว็บพร้อมใช้งาน
        // =============================
        document.addEventListener("DOMContentLoaded", function() {
            api_loadUsers();
            api_loadTasks();
            // ตั้งค่าเมนูกรองให้ active ที่ 'ทั้งหมด' ตั้งต้น
            setFilterActive('all');
        });

        // ช่วยตั้งค่า active class ในเมนูกรอง
        function setFilterActive(filterKey) {
            ['all', 'today', 'week', 'month'].forEach(key => {
                const el = document.getElementById('filter_' + key);
                if (!el) return;
                if (key === filterKey) {
                    el.classList.add('active');
                } else {
                    el.classList.remove('active');
                }
            });
        }

        // เมื่อคลิกเลือกฟิลเตอร์ในเมนู ให้ตั้ง active และเรียก filterTasks
        function onFilterClick(filterKey) {
            setFilterActive(filterKey);
            filterTasks(filterKey);
        }

        // =============================
        // ฟังก์ชันสลับ sidebar (มือถือ/เดสก์ท็อป)
        // =============================
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            sidebar.classList.toggle('show');
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('sidebar-collapsed');
        }

        // =============================
        // ฟิลเตอร์งานตามสถานะ (ทั้งหมด/รอดำเนินการ/กำลังดำเนินการ/เสร็จสิ้น)
        // =============================
        function loadTasks(status) {
            currentFilter = status;
            currentPage = 1;
            // ลบ active เดิมในเมนู
            document.querySelectorAll('.nav-link-custom').forEach(link => {
                link.classList.remove('active');
            });
            // เปลี่ยนชื่อหัวข้อหน้าตามสถานะ
            const titles = {
                'all': 'งานทั้งหมด',
                'pending': 'งานรอดำเนินการ',
                'in-progress': 'งานกำลังดำเนินการ',
                'completed': 'งานเสร็จสิ้น'
            };
            document.getElementById('pageTitle').textContent = titles[status] || 'งานทั้งหมด';
            applyFiltersAndSort();
        }

        // =============================
        // ฟิลเตอร์งานตามช่วงวันที่ (วันนี้/สัปดาห์นี้/เดือนนี้)
        // =============================
        function filterTasks(dateFilter) {
            // ถ้าผู้ใช้เลือก 'all' ให้คืนค่ากลับไปยังข้อมูลต้นฉบับ (ถ้ามีสำรอง)
            if (dateFilter === 'all') {
                if (allTasksBackup) {
                    allTasks = [...allTasksBackup];
                    allTasksBackup = null; // ล้างสำรองเมื่อคืนค่าแล้ว
                }
                currentPage = 1;
                applyFiltersAndSort();
                return;
            }

            // สำรองข้อมูลต้นฉบับก่อนกรองครั้งแรก (ถ้ายังไม่มีสำรอง)
            if (!allTasksBackup) {
                allTasksBackup = [...allTasks];
            }

            const now = new Date();
            const today = new Date(now.getFullYear(), now.getMonth(), now.getDate());

            // ใช้ข้อมูลจากสำรองเป็นฐานในการกรอง เพื่อหลีกเลี่ยงการซ้อนกรองบนข้อมูลที่ถูกกรองแล้ว
            let sourceTasks = allTasksBackup ? [...allTasksBackup] : [...allTasks];
            let filteredByDate = sourceTasks;

            if (dateFilter === 'today') {
                filteredByDate = sourceTasks.filter(task => {
                    const taskDate = new Date(task.created_at);
                    const taskDay = new Date(taskDate.getFullYear(), taskDate.getMonth(), taskDate.getDate());
                    return taskDay.getTime() === today.getTime();
                });
            } else if (dateFilter === 'week') {
                // นับเป็น "สัปดาห์นี้" โดยให้สัปดาห์เริ่มวันอาทิตย์ และสิ้นสุดวันเสาร์
                // (ตัวอย่าง: ถ้าวันนี้เป็นวันพุธ จะนับตั้งแต่วันอาทิตย์ของสัปดาห์นั้น ถึงวันเสาร์)
                // หาวันเริ่มต้นของสัปดาห์ (Sunday)
                const dayOfWeek = today.getDay(); // Sunday=0, Monday=1, ... Saturday=6
                const weekStart = new Date(today);
                weekStart.setDate(today.getDate() - dayOfWeek); // ย้อนกลับไปยังวันอาทิตย์
                weekStart.setHours(0, 0, 0, 0);

                // วันสิ้นสุดของสัปดาห์ คือวันเสาร์ เวลา 23:59:59.999
                const weekEnd = new Date(weekStart);
                weekEnd.setDate(weekStart.getDate() + 6);
                weekEnd.setHours(23, 59, 59, 999);

                filteredByDate = sourceTasks.filter(task => {
                    const taskDate = new Date(task.created_at);
                    return taskDate >= weekStart && taskDate <= weekEnd;
                });
            } else if (dateFilter === 'month') {
                // นับเป็น "เดือนนี้" ตามเดือนปฏิทิน (วันแรกของเดือน ถึง วันสุดท้ายของเดือน)
                // ป้องกันการแสดงผลจากเดือนอื่น ๆ
                const monthStart = new Date(today.getFullYear(), today.getMonth(), 1);
                const month = today.getMonth();
                const year = today.getFullYear();

                filteredByDate = sourceTasks.filter(task => {
                    const taskDate = new Date(task.created_at);
                    return taskDate.getFullYear() === year && taskDate.getMonth() === month;
                });
            }

            // กำหนดผลลัพธ์การกรองเป็น allTasks (UI จะอ่านจาก allTasks)
            allTasks = filteredByDate;
            currentPage = 1;
            applyFiltersAndSort();
        }

        // =============================
        // ฟังก์ชันเรียงลำดับงาน (วันที่/ชื่อ/ความสำคัญ)
        // =============================
        function sortTasks(sortType) {
            currentSort = sortType;
            applyFiltersAndSort();
        }

        // =============================
        // ฟังก์ชันค้นหางาน
        // =============================
        function searchTasks(query) {
            currentSearch = query.toLowerCase();
            currentPage = 1;
            applyFiltersAndSort();
        }

        // =============================
        // ฟังก์ชันรวม: ฟิลเตอร์ + เรียงลำดับ + อัปเดตหน้าจอ
        // =============================
        function applyFiltersAndSort() {
            showLoading();
            setTimeout(() => {
                // 1. เริ่มจากงานทั้งหมด
                let tasks = [...allTasks];
                // 2. ฟิลเตอร์ตามสถานะ
                if (currentFilter !== 'all') {
                    tasks = tasks.filter(task => task.status === currentFilter);
                }
                // 3. ฟิลเตอร์ตามคำค้นหา
                if (currentSearch) {
                    const searchLower = currentSearch.toLowerCase();
                    tasks = tasks.filter(task => {
                        const title = task.title.toLowerCase();
                        const year = new Date(task.created_at).getFullYear().toString();
                        const taskCode = 'TASK-' + year + '-' + task.id.toString().padStart(4, '0');
                        const status = getStatusName(task.status.toLowerCase());
                        return (
                            title.includes(searchLower) ||
                            year.includes(searchLower) ||
                            taskCode.toLowerCase().includes(searchLower) ||
                            status.includes(searchLower)
                        );
                    });
                }
                // 4. เรียงลำดับ
                tasks.sort((a, b) => {
                    switch (currentSort) {
                        case 'date_desc':
                            return new Date(b.created_at) - new Date(a.created_at);
                        case 'date_asc':
                            return new Date(a.created_at) - new Date(b.created_at);
                        case 'title':
                            return a.title.localeCompare(b.title, 'th');
                        case 'priority':
                            return b.priority - a.priority;
                        default:
                            return 0;
                    }
                });
                // 5. อัปเดตตัวแปรและหน้าจอ
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
                <div class="col-12 col-lg-12 col-xl-12 task-container" onclick="window.location.href='task_detail.php?taskID=${task.encrypt_id}'" style="cursor: pointer;">
                    <div class="task-card">
                        <div class="task-header ${task.category}">
                            <h3 class="task-title">${task.title}</h3>
                            <div class="task-meta">
                                <span class="task-id"><i class="bi bi-hash me-1"></i>TASK-${new Date(task.created_at).getFullYear()}-${(task.id).toString().padStart(4, '0')}</span>
                                <span class="category-badge"><i class="bi bi-code-slash me-1"></i>${getCategoryName(task.category)}</span>
                                <span class="created-date"><i class="bi bi-calendar3 me-1"></i>${formatDate(task.created_at)}</span>
                                <span class="priority-badge"><i class="bi bi-card-list me-1"></i>ความสำคัญ ${importance_score(task.importance)}</span>
                            </div>
                        </div>
                        <div class="card-body p-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="status-badge ${task.status}">สถานะ : ${getStatusName(task.status)}</span>
                              <!--   <div class="dropdown">
                                <a class="dropdown-item" href="task_detail.php?taskID=${task.encrypt_id}"><i class="bi bi-eye me-2"></i>ดูรายละเอียด</a>

                                    <button class="btn btn-link text-muted" type="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#"><i class="bi bi-eye me-2"></i>ดูรายละเอียด</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="bi bi-pencil me-2"></i>แก้ไข</a></li>
                                        <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-trash me-2"></i>ลบ</a></li>
                                    </ul> 
                                </div> -->
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
                    <button class="btn btn-outline-primary page-btn ${i === currentPage ? 'active' : ''}" onclick="goToPage(${i})">
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
    </script>
    <!-- สคริปฟิลเตอร์ -->

    <script>
        // Mock data - normally from API

        // Global variables
        let selectedUsers = [];
        let mentionUsers = [];
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
            const modal = document.getElementById('task_newtopicModal');

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
        function resetForm() { // รีเซ็ตฟอร์มทั้งหมด
            document.getElementById('task_newtopicForm').reset();
            const form = document.getElementById('task_newtopicForm');
            form.classList.remove('was-validated');

            // ลบ class validation (กรอบแดง/กรอบเขียว) ทั้งหมด เมื่อรีเซ็ตฟอร์ม
            form.querySelectorAll('input, textarea, select').forEach(el => {
                el.classList.remove('is-invalid');
                el.classList.remove('is-valid');
            });
            // รีเซ็ตตัวแปรและ UI ที่เกี่ยวข้อง
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
            //console.log(selectedUsers);

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
            const textarea = document.getElementById('taskDescription');
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
                            const user = users_list.find(u => u.id === userId);
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

        function updateMentionSelection(items) {
            items.forEach((item, index) => {
                item.classList.toggle('selected', index === selectedMentionIndex);
            });
        }

        function selectMentionUser(user) {
            const textarea = document.getElementById('taskDescription');
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
            const text = document.getElementById("taskDescription").value;

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

            //console.log("mentionUsers:", mentionUsers);
        }

        document.getElementById("taskDescription").addEventListener("input", updateMentionUsers);

        function hideMentionDropdown() {
            document.getElementById('mentionDropdown').style.display = 'none';
            selectedMentionIndex = -1;
        }

        // File Management
        function setupFileInput(inputId) {
            const input = document.getElementById(inputId);
            if (!input) return;

            //console.log('setupFileInput -> input:', input);

            // 🔎 เช็คว่าตอนนี้ input มีไฟล์อยู่ไหม
            if (input.files && input.files.length > 0) {
                //console.log(`📂 input[${inputId}] มีไฟล์อยู่แล้ว:`, input.files[0].name, input.files[0].size, "bytes");
            } else {
                file_count_size = file_count_size.filter(item => item.id !== inputId);
                //console.log('ขนาดไฟล์รวม', file_count_size);

                //console.log(`📂 input[${inputId}] ไม่มีไฟล์`);
            }

            input.addEventListener('change', function() {
                if (this.files.length > 0) {
                    displaySelectedFile(this);
                } else {
                    //console.log(`❌ input[${inputId}] ถูกล้าง ไม่มีไฟล์`);
                }
            });

            // รวมขนาดทั้งหมด
            let totalSize = file_count_size.reduce((sum, item) => sum + item.size, 0);
            let totalMB = (totalSize / (1024 * 1024)).toFixed(2);
            //console.log('totalMB', totalMB);

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
                //console.log('ก่อนinputId', input);
                // ลบข้อมูลเก่าออกก่อน (กันซ้ำ)
                file_count_size = file_count_size.filter(item => item.id !== input);

                // เพิ่มข้อมูลใหม่
                file_count_size.push({
                    id: input.id,
                    size: file.size
                });
                //file_count_size = file_count_size + file.size; //เก็บขนาดไฟล์
                //console.log('ขนาดไฟล์รวม', file_count_size);
            }

            //console.log(`📎 File selected: ${file.name} (${formatFileSize(file.size)})`);

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
            //console.log('totalMB', totalMB);

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
                //console.log('🗑️ Removing file input');

                // Find the hidden input and clear it
                const input = container.querySelector('.file-input-hidden');
                if (input) {
                    input.value = '';
                    //console.log('✅ File input cleared:', input);
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
            //console.log('🔄 File attachments reset');
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
            const form = document.getElementById('task_newtopicForm');
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

        function saveTask() {
            if (!validateForm()) {
                //console.log('!validateForm');
                return;
            }
            let totalSize = file_count_size.reduce((sum, item) => sum + item.size, 0); // รวมขนาดไฟล์
            let totalMB = (totalSize / (1024 * 1024)).toFixed(2); // แปลงเป็น MB
            if (totalMB > 7) { // ถ้าเกิน 7MB
                showAlert(`ขนาดไฟล์รวมทั้งหมด มีขนาดใหญ่เกินไป (สูงสุด 7MB)`, 'danger');
                return;
            }

            const formData = {
                title: document.getElementById('taskTitle').value.trim(),
                category: document.getElementById('taskCategory').value,
                description: document.getElementById('taskDescription').value.trim(),
                staus: document.getElementById('taskStatus').value,
                importance: document.getElementById('taskImportance').value,
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

            //console.log('Data to send:', formData);

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
                const modal = bootstrap.Modal.getInstance(document.getElementById('task_newtopicModal'));
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
            apiFormData.append('taskImportance', formData.importance);
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
                        api_loadTasks();
                        // const modal = bootstrap.Modal.getInstance(document.getElementById('task_newtopicModal'));
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
                        users_list.length = 0;
                        users_list.push(...data.data);
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
            const form = document.getElementById('task_newtopicForm');
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