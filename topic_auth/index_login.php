<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Topic Tracking System - เข้าสู่ระบบ</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Minimal custom CSS - mostly using Bootstrap classes */
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: none;
            z-index: 10;
        }
    </style>
</head>

<body class="d-flex align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <!-- Login Card -->
                <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                    <!-- Header -->
                    <div class="card-header bg-primary text-white text-center py-4 border-0">
                        <i class="fas fa-tasks fa-3x mb-3 opacity-75"></i>
                        <h2 class="fw-bold mb-1">Topic Tracking</h2>
                        <p class="mb-0 opacity-75">ระบบติดตามงาน</p>
                    </div>

                    <!-- Body -->
                    <div class="card-body p-4">
                        <form id="loginForm">
                            <!-- Username -->
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control rounded-3 border-2" id="username" placeholder="ชื่อผู้ใช้" required>
                                <label for="username"><i class="fas fa-user me-2"></i>ชื่อผู้ใช้</label>
                            </div>

                            <!-- Password -->
                            <div class="form-floating mb-3 position-relative">
                                <input type="password" class="form-control rounded-3 border-2" id="password" placeholder="รหัสผ่าน" required>
                                <label for="password"><i class="fas fa-lock me-2"></i>รหัสผ่าน</label>
                                <button type="button" class="password-toggle btn text-muted" id="togglePassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>

                            <!-- Remember Me -->
                            <!-- <?php echo !empty($_SESSION["Alert_login"]) ? $_SESSION["Alert_login"] : '';
                                    unset($_SESSION["Alert_login"]); ?> -->
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" value="" id="rememberMe">
                                <label class="form-check-label" for="rememberMe">
                                    <i class="fas fa-check-circle me-2 text-primary"></i>จำรหัสผ่าน
                                </label>
                            </div>

                            <!-- Login Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg rounded-3 fw-bold py-3">
                                    <span class="btn-text">
                                        <i class="fas fa-sign-in-alt me-2"></i>เข้าสู่ระบบ
                                    </span>
                                    <span class="loading-spinner d-none">
                                        <i class="fas fa-spinner fa-spin me-2"></i>กำลังเข้าสู่ระบบ...
                                    </span>
                                </button>
                            </div>
                        </form>

                        <!-- Forgot Password -->
                        <div class="text-center mt-4">
                            <a href="#" id="forgotPasswordLink" class="text-decoration-none text-primary">
                                <i class="fas fa-question-circle me-1"></i>ลืมรหัสผ่าน?
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Container -->
    <div id="toastContainer" class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999;"></div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle password visibility
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const toggleIcon = togglePassword.querySelector('i');

        togglePassword.addEventListener('click', function() {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
                toggleIcon.classList.add('text-primary');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
                toggleIcon.classList.remove('text-primary');
            }
        });

        // Remember password functionality
        const rememberCheckbox = document.getElementById('rememberMe');
        const usernameInput = document.getElementById('username');

        // Load saved credentials on page load
        window.addEventListener('load', function() {
            const savedUsername = getCookie('rememberedUsername');
            const savedPassword = getCookie('rememberedPassword');

            if (savedUsername) {
                usernameInput.value = savedUsername;
                rememberCheckbox.checked = true;
            }

            if (savedPassword) {
                passwordInput.value = atob(savedPassword);
            }
        });

        // Form submission
        const loginForm = document.getElementById('loginForm');
        const loginButton = loginForm.querySelector('button[type="submit"]');
        const btnText = loginButton.querySelector('.btn-text');
        const loadingSpinner = loginButton.querySelector('.loading-spinner');

        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // Show loading state using Bootstrap classes
            btnText.classList.add('d-none');
            loadingSpinner.classList.remove('d-none');
            loginButton.disabled = true;

            const username = usernameInput.value;
            const password = passwordInput.value;

            // Handle remember password
            if (rememberCheckbox.checked) {
                setCookie('rememberedUsername', username, 30);
                setCookie('rememberedPassword', btoa(password), 30);
            } else {
                deleteCookie('rememberedUsername');
                deleteCookie('rememberedPassword');
            }

            // Simulate login process
            setTimeout(function() {
                // Reset loading state
                btnText.classList.remove('d-none');
                loadingSpinner.classList.add('d-none');
                loginButton.disabled = false;

                if (username && password) {
                    check_login();
                    // showToast('เข้าสู่ระบบสำเร็จ!', 'success');
                    // window.location.href = 'dashboard.html';
                } else {
                    showToast('กรุณากรอกข้อมูลให้ครบถ้วน', 'danger');
                }
            }, 1500);
        });

        // Forgot password link
        document.getElementById('forgotPasswordLink').addEventListener('click', function(e) {
            e.preventDefault();
            showToast('กรุณาติดต่อผู้ดูแลระบบเพื่อรีเซ็ตรหัสผ่าน', 'info');
        });

        // Cookie functions
        function setCookie(name, value, days) {
            const expires = new Date();
            expires.setTime(expires.getTime() + (days * 24 * 60 * 60 * 1000));
            document.cookie = name + '=' + value + ';expires=' + expires.toUTCString() + ';path=/';
        }

        function getCookie(name) {
            const nameEQ = name + '=';
            const ca = document.cookie.split(';');
            for (let i = 0; i < ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) === ' ') c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        }

        function deleteCookie(name) {
            document.cookie = name + '=; Max-Age=-99999999;';
        }

        // Toast notification using Bootstrap Toast
        function showToast(message, type = 'info') {
            const toastContainer = document.getElementById('toastContainer');
            const toastId = 'toast-' + Date.now();

            let bgClass, textClass;
            switch (type) {
                case 'success':
                    bgClass = 'bg-success';
                    textClass = 'text-white';
                    break;
                case 'danger':
                    bgClass = 'bg-danger';
                    textClass = 'text-white';
                    break;
                default:
                    bgClass = 'bg-info';
                    textClass = 'text-white';
            }

            const toastHTML = `
                <div id="${toastId}" class="toast align-items-center ${textClass} ${bgClass} border-0" role="alert">
                    <div class="d-flex">
                        <div class="toast-body fw-bold">
                            <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'danger' ? 'exclamation-circle' : 'info-circle'} me-2"></i>
                            ${message}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                    </div>
                </div>
            `;

            toastContainer.insertAdjacentHTML('beforeend', toastHTML);
            const toastElement = document.getElementById(toastId);
            const toast = new bootstrap.Toast(toastElement, {
                autohide: true,
                delay: 3000
            });

            toast.show();

            toastElement.addEventListener('hidden.bs.toast', function() {
                toastElement.remove();
            });
        }

        // Add hover effects using Bootstrap classes
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('focus', function() {
                this.classList.add('border-primary');
            });

            input.addEventListener('blur', function() {
                if (!this.value) {
                    this.classList.remove('border-primary');
                }
            });
        });

        // Add subtle animation to login button
        loginButton.addEventListener('mouseenter', function() {
            this.classList.add('shadow');
        });

        loginButton.addEventListener('mouseleave', function() {
            this.classList.remove('shadow');
        });
    </script>
    <script>
        async function check_login(retryCount = 1) {
            const formData = {
                user_name: document.getElementById('username').value.trim(),
                password: document.getElementById('password').value.trim(),
            };

            fetch('../topic_api/check_login.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json', // ระบุเป็น JSON
                    },
                    body: JSON.stringify(formData) // แปลง object → JSON
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.status === "success") {
                        if (data.login_status === true) {
                            showToast('เข้าสู่ระบบสำเร็จ!', 'success');
                            // ✅ ไปยังหน้าถัดไป (เช่น dashboard.php)
                            setTimeout(() => {
                                window.location.href = "../topic_pages/index_page.php";
                                // หรือใช้ replace ถ้าไม่อยากให้กด Back กลับมาได้
                            }, 500); // รอ 0.5 วิ ให้ user เห็น Toast ก่อน
                        } else {
                            showToast('กรอกข้อมูลให้ถูกต้อง!', 'danger');

                        }

                        // showAlert('เข้าระบบสำเร็จ!', 'success');
                        // api_loadTasks();
                        document.getElementById('username').value = "";
                        document.getElementById('password').value = "";
                    } else {
                        showToast('เกิดข้อผิดพลาด', 'danger');

                        // showAlert('เกิดข้อผิดพลาด: ' + (data.message || 'ไม่ทราบสาเหตุ'), 'danger');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('เกิดข้อผิดพลาดในการเชื่อมต่อ', 'danger');
                    // showAlert('เกิดข้อผิดพลาดในการเชื่อมต่อ: ' + error.message, 'danger');
                });
        }
    </script>
    <?php
    if (isset($_GET['expired']) && $_GET['expired'] == "1") {
        echo "<script>showToast('เซสชันหมดอายุ', 'danger');</script>";
    }
    ?>
</body>

</html>