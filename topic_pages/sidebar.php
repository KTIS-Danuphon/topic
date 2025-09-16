    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h5 class="sidebar-title">เมนูจัดการ</h5>
        </div>

        <div class="sidebar-nav">
            <!-- Dashboard Section -->
            <div class="nav-section">
                <div class="nav-section-title">Dashboard</div>
                <div class="nav-item">
                    <a href="#" class="nav-link-custom">
                        <div class="nav-link-left">
                            <i class="bi bi-speedometer2"></i>
                            ภาพรวม
                        </div>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link-custom">
                        <div class="nav-link-left">
                            <i class="bi bi-bar-chart-fill"></i>
                            สถิติ & รายงาน
                        </div>
                    </a>
                </div>
            </div>

            <!-- Tasks Section -->
            <div class="nav-section">
                <div class="nav-section-title">งาน</div>
                <div class="nav-item">
                    <a href="#" class="nav-link-custom active" onclick="loadTasks('all')">
                        <div class="nav-link-left">
                            <i class="bi bi-list-task"></i>
                            งานทั้งหมด
                        </div>
                        <span class="badge-custom" id="totalTaskCount">156</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link-custom" onclick="loadTasks('pending')">
                        <div class="nav-link-left">
                            <i class="bi bi-clock-fill"></i>
                            รอดำเนินการ
                        </div>
                        <span class="badge-custom" id="pendingTaskCount">24</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link-custom" onclick="loadTasks('progress')">
                        <div class="nav-link-left">
                            <i class="bi bi-play-circle-fill"></i>
                            กำลังดำเนินการ
                        </div>
                        <span class="badge-custom" id="progressTaskCount">18</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link-custom" onclick="loadTasks('completed')">
                        <div class="nav-link-left">
                            <i class="bi bi-check-circle-fill"></i>
                            เสร็จสิ้น
                        </div>
                        <span class="badge-custom" id="completedTaskCount">114</span>
                    </a>
                </div>
            </div>

            <!-- Projects Section -->
            <div class="nav-section">
                <div class="nav-section-title">โปรเจค</div>
                <div class="nav-item">
                    <a href="#" class="nav-link-custom">
                        <div class="nav-link-left">
                            <i class="bi bi-folder-fill"></i>
                            โปรเจคทั้งหมด
                        </div>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link-custom">
                        <div class="nav-link-left">
                            <i class="bi bi-star-fill"></i>
                            โปรเจคสำคัญ
                        </div>
                    </a>
                </div>
            </div>

            <!-- Team Section -->
            <div class="nav-section">
                <div class="nav-section-title">ทีม</div>
                <div class="nav-item">
                    <a href="#" class="nav-link-custom">
                        <div class="nav-link-left">
                            <i class="bi bi-people-fill"></i>
                            สมาชิกทีม
                        </div>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link-custom">
                        <div class="nav-link-left">
                            <i class="bi bi-calendar3"></i>
                            ปฏิทินทีม
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>