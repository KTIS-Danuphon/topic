 <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
        <div class="container-fluid px-3">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <i class="bi bi-kanban-fill me-2"></i>
                TaskManager Pro
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto ms-3">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">
                            <i class="bi bi-house-fill me-1"></i>หน้าหลัก
                        </a>
                    </li>
                    <li class="nav-item" data-bs-toggle="modal" data-bs-target="#task_newtopicModal">
                        <a class="nav-link" href="#">
                            <i class="bi bi-plus-circle-fill me-1"></i>สร้างงาน
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-graph-up me-1"></i>รายงาน
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav">
                    <li class="nav-item dropdown me-2">
                        <a class="nav-link position-relative" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-bell-fill me-1"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                3
                            </span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" style="min-width: 300px;">
                            <li>
                                <h6 class="dropdown-header"><i class="bi bi-bell me-2"></i>การแจ้งเตือน</h6>
                            </li>
                            <li><a class="dropdown-item py-2" href="#">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-exclamation-triangle-fill text-warning me-3"></i>
                                        <div>
                                            <div class="fw-bold">งานใหม่ถูกมอบหมายให้คุณ</div>
                                            <small class="text-muted">5 นาทีที่แล้ว</small>
                                        </div>
                                    </div>
                                </a></li>
                            <li><a class="dropdown-item py-2" href="#">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-chat-dots-fill text-info me-3"></i>
                                        <div>
                                            <div class="fw-bold">มีความคิดเห็นใหม่</div>
                                            <small class="text-muted">15 นาทีที่แล้ว</small>
                                        </div>
                                    </div>
                                </a></li>
                            <li><a class="dropdown-item py-2" href="#">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-calendar-check-fill text-success me-3"></i>
                                        <div>
                                            <div class="fw-bold">งานครบกำหนดวันนี้</div>
                                            <small class="text-muted">1 ชั่วโมงที่แล้ว</small>
                                        </div>
                                    </div>
                                </a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item text-center fw-bold" href="#">ดูทั้งหมด</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                            <div class="bi bi-person-circle me-2"></div>
                            <span class="d-none d-md-inline">เกม เดอะแอดมิน</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <h6 class="dropdown-header"><i class="bi bi-person-circle me-2"></i>จัดการบัญชี</h6>
                            </li>
                            <li><a class="dropdown-item" href="#">
                                    <i class="bi bi-person-fill me-2"></i>โปรไฟล์
                                </a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>